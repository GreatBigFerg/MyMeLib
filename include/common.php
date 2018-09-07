<?php
include_once('../include/config.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

// Manages the user-interface, including hiding/showing content areas //
class gui {
	public $view = "audio";
	public $upload_filetype = "audio";
	// Switch between browsing audio & video content //
	function set_view($str) {
		$this->view = $str;
		$this->upload_filetype = $str;
		return $this->view;
	}
}

// Handles the file uploading/moving of temporary file & gets file info to store in DB //
class upload {
    public $file;
    public $filename;
    public $filepath;
    public $dir;
    public $ext;
    // Retrieve file details (Return the file's absolute path & file-extension) //
    function file_info() {
        $finfo = pathinfo($this->filepath);
	    $this->dir = $finfo['dirname'];
	    $this->ext = $finfo['extension'];
    }
    // Moves the file from temporary upload location to specified directory (Return boolean for pass/failed to move file to new location) //
    function move_upload() {
		global $upload_dir;
        $this->filename = preg_replace("/[^A-Z0-9._-]/i", "_", $this->file["name"]);
        $this->filepath = $upload_dir . $this->filename;
        $success = move_uploaded_file($this->file["tmp_name"], $this->filepath);
        return $success;
    }
}

// Handles video-specific operations //
class video {
    // Return multi-dementianal array of only movies in the DB  //
    function get_movie_list() {   
	    global $conn;
        $records = array();
        $query = mysqli_query($conn, "SELECT * FROM video_data WHERE FileExists = 'true'");
        if (!$query) {
		    return false;
	    } else {
		    while ($rows = mysqli_fetch_array($query)) {
			    $info = array();
				$info['title'] = $rows['Title'];
				$info['length'] = $rows['Length'];
			    $info['genre'] = $rows['Genre'];
			    $records[$rows['id']] = $info;
		    }
	    }
	    return $records;
    }
    // Return multi-dementianal array of only TV-shows/series in the DB //
    function get_series_list() {
	    global $conn;
        $records = array();
        $query = mysqli_query($conn, "SELECT id, Title, ProgramName, SeasonNumber, EpisodeNumber, Genre FROM video_data WHERE ProgramName IS NOT NULL AND FileExists = 'true'");
        if (!$query) {
		    return false;
	    } else {
		    while ($rows = mysqli_fetch_array($query)) {
			    $info = array();
			    $info['title'] = $rows['Title'];
			    $info['show'] = $rows['ProgramName'];
			    $info['season'] = $rows['SeasonNumber'];
			    $info['episode'] = $rows['EpisodeNumber'];
			    $info['genre'] = $rows['Genre'];
			    $records[$rows['id']] = $info;
		    }
	    }
	    return $records;
    }
    // Return multi-dementianal array of all videos in the DB //
    function get_video_list() {
	    global $conn;
        $records = array();
        $query = mysqli_query($conn, "SELECT * FROM video_data WHERE FileExists = 'true'");
	    if (!$query) {
		    return false;
	    } else {
		    while ($rows = mysqli_fetch_array($query)) {
			    $info = array();
			    $info['title'] = $rows['Title'];
			    $info['show'] = $rows['ProgramName'];
			    $info['season'] = $rows['SeasonNumber'];
			    $info['episode'] = $rows['EpisodeNumber'];
			    $info['genre'] = $rows['Genre'];
			    $records[$rows['id']] = $info;
		    }
	    }
	    return $records;
    }
    // Return array of existing genres for videos in the DB //
    function get_genre_list() {
	    global $conn;
        $records = array();
		$query = mysqli_query($conn, "SELECT Genre FROM video_data WHERE FileExists = 'true'");			    
	    while ($rows = mysqli_fetch_array($query)) {
		    $records[$rows['Genre']];
	    }
	    return $records;
	}
	// Get input from user and handle new file upload, creating new record in the DB //
    function new_upload() {
		global $conn;
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);	
		$isseries = filter_var($_POST['isseries'], FILTER_SANITIZE_STRING);
		if ($isseries == 1) {
			$seriestitle = filter_var($_POST['seriestitle'], FILTER_SANITIZE_STRING);
			$season = filter_var($_POST['season'], FILTER_SANITIZE_NUMBER_INT);
			$episode = filter_var($_POST['episode'], FILTER_SANITIZE_NUMBER_INT);
			$season_episode = $season."-".$episode;
		} else {
			$seriestitle = " ";
			$season = " ";
			$episode = " ";
			$season_episode = " ";
		}
	    $genre = filter_var($_POST['genre'], FILTER_SANITIZE_STRING);
	    $upload = $_FILES["video_uploaded_file"];
        $fu = new upload();
        $fu->file = $upload;
        if ($fu->move_upload()) {
            $fu->file_info();
            $fname = $fu->filename;
            $fdir = $fu->dir;
            $fext = $fu->ext;
	        $sql = "INSERT INTO video_data (Title, SeriesTitle, Series_Episode, Genre, FileName, FilePath, FileFormat, FileExists) 
                VALUES ('$title', '$seriestitle', '$season_episode', '$genre', '$fname', '$fdir', '$fext', 'true')";
	        $query = mysqli_query($conn, $sql);
	        if (!$query) {
		        echo mysqli_error($conn);
	        }
            $msg = "File uploaded successfully!";
        } else {
            $msg = "An error was encountered while uploading your file, please try again.";
        }
	    echo "<meta http-equiv='refresh' content='0'>";
	    echo "<script> alert('".$msg."');</script>";
    }
}

// Handles audio-specific operations //
class audio {
    // Return multi-dementianal array of all songs in the DB //
    function get_music_list() {
	    global $conn;
        $records = array();
        $query = mysqli_query($conn, "SELECT id, Title, Artist, Album, Genre FROM audio_data WHERE FileExists = 'true'");
        while ($rows = mysqli_fetch_array($query)) {
            $info = array();
            $info['title'] = $rows['Title'];
            $info['artist'] = $rows['Artist'];
            $info['album'] = $rows['Album'];
            $info['genre'] = $rows['Genre'];
	        $records[$rows['id']] = $info;
        }
	    return $records;
    }
    // Return array of existing genres for songs in the DB //
    function get_genre_list() {
	    global $conn;
        $records = array();
		$query = mysqli_query($conn, "SELECT Genre FROM audio_data WHERE FileExists = 'true'");			    
	    while ($rows = mysqli_fetch_array($query)) {
			if (in_array($rows['Genre'], $records)) {
				break;
			} else {
				$records[$rows['Genre']];
			} 
	    }
	    return $records;
	}
	// Return array of all artist in the DB //
	function get_artist_list() {
		global $conn;
        $records = array();
		$query = mysqli_query($conn, "SELECT Artist FROM audio_data WHERE FileExists = 'true'");			    
	    while ($rows = mysqli_fetch_array($query)) {
			if (in_array($rows['Artist'], $records)) {
				break;
			} else {
				$records[$rows['Artist']];
			}  
	    }
	    return $records;
	}
    // Return multi-dementianal array of songs limited by a given filter/option //
    function filter_results($filter, $option) {
        global $conn;
        $records = array();
        switch($filter) {
            case "genre":
                $query_filter = "Genre = '".$option."'";
                break;        
            case "artist":
                $query_filter = "Artist = '".$option."'";
                break;
            case "album":
                $query_filter = "Album = '".$option."'";
                break;
            case "owner":
                $query_filter = "Owner = '".$option."'";
                break;
            case "favorite":
                $query_filter = "Favorite = '".$option."'";
                break;
        }
        $sql = "SELECT id, Title FROM audio_data WHERE ".$query_filter;
        $query = mysqli_query($conn, $sql);
        while($rows = mysqli_fetch_array($query)) {
            $records[$rows['id']]=$rows['Title'];
        }
        return $records;
    }
    // Get input from user and handle new file upload, creating new record in the DB //
    function new_upload() {
		global $conn;
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);	
	    $artist = filter_var($_POST['artist'], FILTER_SANITIZE_STRING);
	    $album = filter_var($_POST['album'], FILTER_SANITIZE_STRING);
	    $genre = filter_var($_POST['genre'], FILTER_SANITIZE_STRING);
	    $upload = $_FILES["audio_uploaded_file"];
        $fu = new upload();
        $fu->file = $upload;
        if ($fu->move_upload()) {
            $fu->file_info();
            $fname = $fu->filename;
            $fdir = $fu->dir;
            $fext = $fu->ext;
	        $sql = "INSERT INTO audio_data (Title, Artist, Album, Genre, FileName, FilePath, FileFormat, FileExists) 
                VALUES ('$title', '$artist', '$album', '$genre', '$fname', '$fdir', '$fext', 'true')";
			$query = mysqli_query($conn, $sql);
	        if (!$query) {
		        echo mysqli_error($conn);
	        }
            $msg = "File uploaded successfully!";
        } else {
            $msg = "An error was encountered while uploading your file, please try again.";
        }
	    echo "<meta http-equiv='refresh' content='0'>";
	    echo "<script> alert('".$msg."');</script>";
    }
    // Get existing playlist from DB //
	function playlist_existing() {
		global $conn;
        $records = array();
		$query = mysqli_query($conn, "SELECT id, PlaylistName 
			FROM playlist_data");			    
	    while ($rows = mysqli_fetch_array($query)) {
		    $records[$rows['PlaylistName']];
	    }
	    return $records;
	}
	// Create new playlist of songs //
	function playlist_create($str) {
		$temp = true;
	}
	// Remove an existing playlist from records //
	function playlist_delete($str) {
		$temp = true;
	}
	// Rename an existing playlist //
	function playlist_rename($str) {
		$temp = true;
	}
	// Add a new song to a given playlist //
	function playlist_add_track($t_id, $p_id) {
		$temp = true;
	}
	// Remove a song from a given playlist //
	function playlist_remove_track($t_id, $p_id) {
		$temp = true;
	}
}

// Temporary function for filtering results shown //
function filter_results($results, $table, $filter, $option) { 
    $array = array();
    $query_filter = "";
    switch($filter) {
        case "genre":
            $query_filter = "Genre = '".$option."'";
            break;        
        case "artist":
            $query_filter = "Artist = '".$option."'";
            break;
        case "album":
            $query_filter = "Album = '".$option."'";
            break;
        case "owner":
            $query_filter = "Owner = '".$option."'";
            break;
        case "favorite":
            $query_filter = "Favorite = '".$option."'";
            break;
    }
    foreach ($results as $rid => $title) {
        $sql = "SELECT id, Title FROM ".$table." WHERE ".$query_filter;
        $query = mysqli_query($conn, $sql);
        while($rows = mysqli_fetch_array($query)) {
            $array[$rows['id']]=$rows['MediaTitle'];
        }
    }
    return $array;
}

//  //  //set_error_handler("error_function"); // Set custom error handler for all errors //
function error_function($level, $message, $file, $line, $context) {
	if ($level == 256 || $level == 4096) {
		error_message("Sorry, I encountered an error while completing your request", $message);
	}
}
// Called if there is an error that needs to be brought to the users attention, such as invalid input //
function error_message($type, $msg) {
	echo "<script> alert('".$type.": \\n".$msg."');</script>";
}
// Return a message to inform user of an error with their submission //
function died($error) {
	echo "<div class='w3-row'>
	<table width='65%' height='unset' align='center'>
	<tr>
	<td align='center'><p color='black' font-size='34px'>
	We're sorry, but there were error(s) found with the form you submitted. These errors appear below.<br /></p>
	<p color='black' font-size='24px'><b>", $error."</b><br /></p>
	<p color='black' font-size='34px'>Please go back and fix these errors.<br /><br /></p>
	</td>
	</tr>
	</table>
	</div>
	<div class='w3-row'><table width='25%' height='20%' align='center'>
	<tr><td align='center'><button onclick='history.back()' style='width:75%; height:75%;'>Okay</button></td></tr>
	</table></div>";        
	die();
}

//--------------------//
// USEFULL FUNCTIONS //
//------------------//

//  $df = disk_free_space("/"); // use "C:" on Windows
//  $ds = disk_total_space("/"); // use "C:" on Windows
//  $exist = file_exists($filepath);


// Download DB info as CSV file //
function create_csv() {
	$sql="SELECT * FROM active_requests";
	$result = mysqli_query($conn, $sql);
	$num_column = mysqli_num_fields($result);		
	$csv_header = '';
	for($i=0;$i<$num_column;$i++) {
		$csv_header .= '"' . mysqli_fetch_field_direct($result,$i)->name . '",';
	}	
	$csv_header .= "\n";
	$csv_row ='';
	while($row = mysqli_fetch_row($result)) {
		for($i=0;$i<$num_column;$i++) {$csv_row .= '"' . $row[$i] . '",';}
		$csv_row .= "\n";
	}	
	/* Download as CSV File */
	header('Content-type: application/csv');
	header('Content-Disposition: attachment; filename=active_request.csv');
	echo $csv_header . $csv_row;
	exit;
}