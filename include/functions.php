<?php
include_once('../include/config.php');
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

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
class playlist {
	public $current_playlist = array();
	// Get existing playlist from DB //
	function existing() {
		$temp = true;
	}
	//  //
	function create($str) {
		$temp = true;
	}
	//  //
	function delete($str) {
		$temp = true;
	}
	//  //
	function rename($str) {
		$temp = true;
	}
	//  //
	function add_track($t_id, $p_id) {
		$temp = true;
	}
	//  //
	function remove_track($t_id, $p_id) {
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