<?php
session_start();
$pagetitle = "Home";

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


<title>Welcome, <?= getName() ?></title>
    <body>
    <div class="cover"></div>

<div class="bg-white wide_wrapper">
    <?php include ('menu.php') ?>
    <div class="bit-66">
        <h2 class="green_color">Welcome,<b> <?= getName($_SESSION['user_id']) ?> </b></h2>
        <h3 class="green_color">We've missed you, hero.</h3>
        <form method="post">
            <input type="submit" name="logout" value="log out">
        </form>
    </div>
    <div class="bit-3"> </div>
</div>
<?php $number = 0 ?>
<?php foreach (getShoeByUserID() as $i): ?>
    <?php $number = $number + 1 ?>
    <div class="shoe_<?= $number ?> height_40 bg-green wide_wrapper shoespace">
        <div class="bit-2 align-right">
            <?php if ($number > 1) : ?>
                <a class="previous" onclick="switchShoe('.shoe_<?= $number - 1 ?>', '.shoe_<?= $number ?>')" > < Previous shoe </a>
            <?php endif; ?>

            <?php if ($number < count(getShoeByUserID())) :?>
                <a class="next" onclick="switchShoe('.shoe_<?= $number + 1 ?>', '.shoe_<?= $number ?>')" > Next shoe > </a>
            <?php endif; ?>
            <br>
            <h2 class="white_color">
            <b>Your</b> <?= $i[0] ?> <?= $i[1] ?>
            </h2>
            <h4 class="white_color">WEAR</h4>
            <H5 class="white_color"><?= $i[3] ?>% NEW</H5>

            <h4 class="white_color">USED</h4>
            <H5 class="white_color"> <?= time_elapsed_string($i[4]) ?> </H5>

            <h4 class="white_color">DISTANCE RAN</h4>
            <H5 class="white_color"><?= $i[5] ?> KILOMETRES</H5>

        </div>
        <div class="bit-2 progressbar">
            <img src="img/models/<?= $i[2] ?>">
        </div>
    </div>
<?php endforeach; ?>

<div class="onEnter_cover"></div>

<script>

    function switchShoe(toShow, toHide) {
        jQuery(toShow).addClass("show");
        jQuery(toHide).removeClass("show");
    }

    window.onload = function() {
        setTimeout(function(){
            jQuery(".onEnter_cover").addClass("animated");
        }, 400);
    }

    var message = "Come back plz ♡";
    var original;

    jQuery(window).focus(function() {
        if (original) {
            document.title = original;
        }
    }).blur(function() {
        var title = jQuery('title').text();
        if (title != message) {
            original = title;
        }
        document.title = message;
    });

    jQuery('.menu-circle').click(function() {
        jQuery(".cover").addClass("active");
        jQuery(".menu-circle").addClass("active");
        jQuery(".menu-content").addClass("active");

        jQuery('.cover').click(function () {
            disableMenu()
        });
    });

    jQuery('.disableMenu').click(function() {
        disableMenu();
    });


    function disableMenu(){
        jQuery(".cover").removeClass("active");
        jQuery(".menu-circle").removeClass("active");
        jQuery(".menu-content").removeClass("active");
    }

    jQuery('.addrun').click(function() {
        alert('voeg nieuwe run toe');
    });


</script>
</body>

<?php
} //End elseif
