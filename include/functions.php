<?php
include_once('../include/config.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

//  //
class dir {
	public $files = [];
	
	//  //
    function scan($video_dir) {
        $iter = new DirectoryIterator($video_dir);
        foreach ($iter as $fileinfo) {
            if (!$fileinfo->isDir() || $fileinfo->isDot()) continue;
            $FileName = $fileinfo->getFilename();
            $FileExtension = $fileinfo->getExtension();
            $FilePath = $fileinfo->getPathname();
        }
    }
    //  //
    function get_files($dir, $files = []) {
        foreach (new DirectoryIterator($dir) as $fileinfo) {
            if ($fileinfo->isDot()) {
                continue;
            } elseif ($fileinfo->isDir()) {
                $files = get_files($dir.'\\'.$fileinfo->getFilename(), $files);
            } elseif ($fileinfo->isFile()) {
                $files[] = $fileinfo->getPathname();
            }
        }
    }
}


//$FileSize = filesize($fpath);
//$FileType = filetype($fpath);


//  //
class favorites {
	public $current_favorites = array();
	//  //
	function add($t_id) {
		$temp = true;
	}
	//  //
	function remove($t_id) {
		$temp = true;
	}
}

//  //
class profile {
	//  //
	function update_icon() {
		$temp = true;
	}
	//  //
	function update_realname() {
		$temp = true;
	}
	//  //
	function update_email() {
		$temp = true;
	}
	//  //
	function change_username() {
		$temp = true;
	}
	//  //
	function change_pswd() {
		$temp = true;
	}
	//  //
	function reset_pswd() {
		$temp = true;
	}
}

//  //
class family {

}