<?php
include_once('../include/config.php');
include_once('../include/auth.php');
include_once('../include/common.php');

$ui->get_mode();

?>
<div class="<?php echo $ui->mode ?>">
<?php
if ($ui->view == "audio") { ?>
	<div class="browse">
		<div class="library-title">
			MUSIC
		</div>
		<div id="music-library">
			<form class="library-form" method='post' action=''>
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
						<div class="row">
							<button class="file-link" type='submit' name='file-select[]' value='<?php echo $s_id; ?>'>
								<div class="column title"> <?php echo $song['title']; ?></div>
								<div class="column artist"> <?php echo $song['artist']; ?></div>
								<div class="column album"> <?php echo $song['album']; ?></div>
								<div class="column genre"> <?php echo $song['genre']; ?></div>
							</button>
						</div>
					<?php } 
					} ?>
				</div>
			</form>
		</div>
	</div>
<?php }
elseif ($ui->view == "video") { ?>
	<div class="browse">
		<div class="library-title">
			MOVIES
		</div>
		<div id="video-library">
			<form class="library-form" method='post' action=''>
				<div class="row-label">
					<div class="column column-label title">Title</div>
					<div class="column column-label artist">Length</div>
					<div class="column column-label genre">Genre</div>
				</div>
				<div>
				<?php 
     	 		  $vids = $video->get_movie_list();
					if (!$vids) { ?>
						<div class="row"><div class="column no-records"></div></div>
					<?php } else {
					foreach($vids as $v_id => $movie) { ?>
						<div class="row">
							<button class="file-link" type='submit' name='file-select[]' value='<?php echo $v_id; ?>'>
								<div class="column title"> <?php echo $movie['title']; ?></div>
								<div class="column artist"> <?php echo $movie['length']; ?></div>
								<div class="column genre"> <?php echo $movie['genre']; ?></div>
							</button>
						</div>
					<?php } 
					} ?>
				</div>
			</form>
		</div>
	</div>
<?php }
?> </div> <?php
if (isset($_POST['file-select'])) {
	$selected = array_pop($_POST['file-select']);
	echo "<meta http-equiv='refresh' content='0'>";
	echo "<script>alert('".$selected."');</script>";
}