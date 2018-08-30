<?php

$usr = $_SESSION["usr"];
$name = $_SESSION["name"];

// 	<h2>Welcome to MyMeLib, <i style='text-decoration:underline; font-size:28px;'>". $name ."</i></h2>
// <button id='logout' onclick=\"location.href='../scripts/logout.php'\">LOGOUT <br /> [ <i>". $usr ."</i> ]</button>

?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link href='../css/header.css' rel='stylesheet'>

<div id='header'>
    <div class='menu-container'>
        <div class='mul9'>
            <div class='mul9circ1'></div>
            <div class='mul9circ2'></div>
            <div class='mul9circ3'></div>
        </div>
        <div class='menu-button'>
            <span class='fa-stack fa-lg'>
                <i class='fa fa-circle fa-stack-2x'></i><i class='fa fa-user-circle-o fa-stack-1x fa-inverse' style='font-size:24px;'></i>
            </span>
            <div class='menu-dropdown'>
                <div class='menu-dropdown-item' onclick=\"location.href='../pages/profile.php'\">Edit Profile</div>
                <div class='menu-dropdown-item'>Starred Files</div>
                <div class='menu-dropdown-item' onclick=\"location.href='../scripts/logout.php'\">Logout</div>
            </div>
        </div>
        <div class='menu-button'>
            <span class='fa-stack fa-lg' onclick=\"location.href='../pages/index.php'\">
                <i class='fa fa-circle fa-stack-2x'></i><i class='fa fa-home fa-stack-1x fa-inverse'></i>
            </span>
            <div class='menu-button-label pulse'>Home</div>
        </div>        
        <div class='menu-button'>
            <span class='fa-stack fa-lg'>
                <i class='fa fa-circle fa-stack-2x'></i><i class='fa fa-file-text-o fa-stack-1x fa-inverse'></i>
            </span>
            <div class='menu-button-label pulse'>Files</div>
        </div>
        <div class='menu-button'>
            <span class='fa-stack fa-lg'>
                <i class='fa fa-circle fa-stack-2x'></i><i class='fa fa-film fa-stack-1x fa-inverse'></i>
            </span>
            <div class='menu-button-label pulse'>Movies</div>
        </div>
        <div class='menu-button'>
            <span class='fa-stack fa-lg'>
                <i class='fa fa-circle fa-stack-2x'></i><i class='fa fa-music fa-stack-1x fa-inverse'></i>
            </span>
            <div class='menu-button-label pulse'>Music</div>
        </div>
        <div class='menu-button'>
            <span class='fa-stack fa-lg'>
                <i class='fa fa-circle fa-stack-2x'></i><i class='fa fa-picture-o fa-stack-1x fa-inverse'></i>
            </span>
            <div class='menu-button-label pulse'>Photos</div>
        </div>
        <div class='menu-button'>
            <span class='fa-stack fa-lg'>
                <i class='fa fa-circle fa-stack-2x'></i><i class='fa fa-search fa-stack-1x fa-inverse'></i>
            </span>
            <div class='menu-button-label pulse'>Search</div>
        </div>
    </div>
</div>
<?php
