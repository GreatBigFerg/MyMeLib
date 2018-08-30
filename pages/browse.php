<?php
include_once('../include/config.php');
include_once('../include/auth.php');
include_once('../include/common.php');

if ($view == "audio") {
	?>
	<div id="music-library">
		<div class="row-label">
			<div class="column column-label title">Title</div>
			<div class="column column-label artist">Artist</div>
			<div class="column column-label album">Album</div>
			<div class="column column-label genre">Genre</div>
		</div>
		<div>
			<?php 
			$songs = $audio->get_music_list();
			if (!$songs) { ?>
				<div class="row"><div class="column no-records"></div></div>
			<?php } else {
			foreach($songs as $s_id => $song) { ?>
				<button class="row audio-link" type='submit' name='track-select[]' value='<?php echo $s_id; ?>'>
					<div class="column title"> <?php echo $song['title']; ?></div>
					<div class="column artist"> <?php echo $song['artist']; ?></div>
					<div class="column album"> <?php echo $song['album']; ?></div>
					<div class="column genre"> <?php echo $song['genre']; ?></div>
				</button>
			<?php } 
			} ?>
		</div>		
	</div>
	<?php
	if (isset($_POST['track-select'])) {
		$selected = array_pop($_POST['track-select']);
		echo "<script>alert('".$selected."');</script>";
	}
}
elseif ($view == "video") {
	?>
	<div id="video-library">
		<div>
			<div class="column column-label title">Title</div>
			<div class="column column-label artist">Artist</div>
			<div class="column column-label album">Album</div>
			<div class="column column-label genre">Genre</div>
		</div>
		<div>
			<?php 
     	   $videos = $video->get_video_list();
			if (!$videos) { ?>
				<div class="row"><div class="column no-records"></div></div>
			<?php } else {
			foreach($videos as $vid) { ?>
				<div class="row">
					<div class="column title"> <?php echo $song['title']; ?></div>
					<div class="column artist"> <?php echo $song['artist']; ?></div>
					<div class="column album"> <?php echo $song['album']; ?></div>
					<div class="column genre"> <?php echo $song['genre']; ?></div>
				</div>
			<?php } 
			} ?>
		</div>
	</div>
	<?php
}
