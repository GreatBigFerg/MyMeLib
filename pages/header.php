<?php
include_once('../include/common.php');

// 	<h2>Welcome to MyMeLib, <i style='text-decoration:underline; font-size:28px;'>". $name ."</i></h2>
// <button id='logout' onclick=\"location.href='../scripts/logout.php'\">LOGOUT <br /> [ <i>". $usr ."</i> ]</button>
?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link href='../css/header.css' rel='stylesheet'>
<div id='header' class="<?php echo $ui->mode ?>">
    <form method='post' action=''>
        <div class='menu-container'>
            <div class="home-button">
                <button id="home" class="menu-button" type='submit' name='view-select[]' value='home'>
                    <i class='fa fa-home menu-icon'></i>
                    <label id="home-label">MyMeLib</label>                   
                </button>
            </div>
            <button id="movie" class="menu-button" type='submit' name='view-select[]' value='video'> 
                <i class='fa fa-film menu-icon'></i>
                <label>Movies</label>                 
            </button>
            <button id="music" class="menu-button" type='submit' name='view-select[]' value='audio'>                   
                <i class='fa fa-music menu-icon'></i>
                <label>Music</label>
            </button>
            <button id="photo" class="menu-button" type='submit' name='view-select[]' value='photo'>
                <i class='fa fa-picture-o menu-icon'></i>
                <label>Photos</label>
            </button>
            <button id="other" class="menu-button" type='submit' name='view-select[]' value='other'>
                <i class='fa fa-search menu-icon'></i>
                <label>Other</label>
            </button>
            <button id="more" class="menu-button" type='submit' name='view-select[]' value='more'>
                <i class='fa fa-music menu-icon'></i>
                <label>More</label>
                <div class='menu-dropdown'>
                    <div class='menu-dropdown-item' onclick="location.href='./pages/profile.php'">Recently Added</div>
                    <div class='menu-dropdown-item' onclick="location.href='./pages/profile.php'">Favorites</div>
                    <div class='menu-dropdown-item' onclick="location.href='./pages/profile.php'">Edit Profile</div>
                    <div class='menu-dropdown-item' onclick="location.href='./pages/profile.php'">Logout</div>
                    <div class='menu-dropdown-item' type='submit' name='view-select[]' value='theme-dark'>Dark Theme</div>  
                    <button class='menu-dropdown-item' type='submit' name='view-select[]' value='theme-light'>Light Theme</button>               
                    <!-- <div class='menu-dropdown-item' onclick="location.href='./pages/profile.php'"></div> -->
                </div>
            </button>
        </div>
    </form>
</div>
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<!--  -->
<?php

if (isset($_POST['view-select'])) {
    $selected = array_pop($_POST['view-select']);
    if ($selected == "audio") {
        $ui->set_view("audio");
    } 
    elseif ($selected == "video") {
        $ui->set_view("video");
    }
    elseif ($selected == "theme-dark") {
        $ui->set_mode("theme-dark");
    }
    elseif ($selected == "theme-light") {
        $ui->set_mode("theme-light");
    }
}









/*

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
                <button class='fa-stack fa-lg' type='submit' name='view-select[]' value='video'>
                    <i class='fa fa-circle fa-stack-2x'></i><i class='fa fa-film fa-stack-1x fa-inverse'></i>
                </button>
                <div class='menu-button-label pulse'>Movies</div>
            </div>
            <div class='menu-button'>
                <button class='fa-stack fa-lg' type='submit' name='view-select[]' value='audio'>
                    <i class='fa fa-circle fa-stack-2x'></i><i class='fa fa-music fa-stack-1x fa-inverse'></i>
                </button>
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

*/