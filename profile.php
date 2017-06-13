<?php
session_start();
$pagetitle = "Profile";

include 'head.php';

if(isset($_POST['logout'])){
    session_destroy();
    header('location: login.php');
}

if(checklogin() == false){
    header('location: login.php');
}

elseif(checklogin() == true){


    ?>



    <body>

    <div class="bit-3 full_height bg-green padding-top align-right" style="position: relative">
        <h2 class="white_color"> <?= getName() ?> </h2>
        <ul class="side_menu">
            <li><a href="?section=personal"> Personal </a> </li>
            <li><a href="?section=security"> Security and Privacy </a> </li>
            <li><a href="?section=feet"> Feet </a> </li>
            <li><a href="?section=delete"> Delete account </a> </li>
        </ul>
    </div>

    <div class="bit-66 section_3 full_height bg-white padding-top">
        <?php include $_GET['section'].".php" ?>
    </div>

    <?php
    $color = "green_color";
    include ('menu.php') ?>
    <div class="cover"></div>
    <?php include('cover.php'); ?>
    <script>

        jQuery('.cover').click(function () {
            jQuery(".popup_addrun").removeClass("active");
            jQuery(".cover").removeClass("active");
        });

        function switchShoe(toShow, toHide) {
            jQuery(toShow).addClass("show");
            jQuery(toHide).removeClass("show");
        }

        window.onload = function() {
            setTimeout(function(){
                jQuery(".onEnter_cover").addClass("animated");
            }, 400);
        }

        jQuery('.addrun').click(function() {
            hideMenu();

            showPopUp();
        });

        function showPopUp(){
            jQuery('.popup_addrun').addClass('active');
            jQuery(".cover").addClass("active");
        }

        function hideMenu(){
            jQuery(".menu-circle").removeClass("active");
            jQuery(".menu-content").removeClass("active");
        }

        function disableCover(){
            jQuery(".popup_addrun").removeClass("active");
            jQuery(".cover").removeClass("active");

            hideMenu();
        }

    </script>

    <?php include('footer.php') ?>
    </body>

    <?php
} //End elseif
