<?php
include_once('../include/config.php');
include_once('../include/auth.php');
include_once('../include/common.php');

if ($ui->upload_filetype == "audio") {
	?>
	<div id='upload-form'>
		<form enctype='multipart/form-data' action='' method='post' id='upload_form' >       
			<div class='form-row'>
				<input type='file' name='uploaded_file'>
			</div>
			<div class='form-row'>
				<label>Title</label>
				<input name='title' type='text' maxlength='100' size='15' />
			</div>
			<div class='form-row'>
				<label>Artist</label>
				<input name='artist' type='text' maxlength='100' size='15' />
			</div>
			<div class='form-row'>
				<label>Album</label>
				<input name='album' type='text' maxlength='100' size='15' />
			</div>
			<div class='form-row'>
				<label>Genre</label>
				<input name='genre' type='text' maxlength='100' size='15' />
			</div>		
			<div class='form-row'>
				<input style='grid-column:1/2; margin-right:16px;' type='reset' value='Reset Form' />		
				<input style='grid-column:2/3;' type='submit' value='Upload'>
			</div>       
		</form>
	</div>
	<?php
	if (!empty($_FILES['uploaded_file'])) {
    	$audio = new audio();
    	$audio->new_upload();
	}
}

