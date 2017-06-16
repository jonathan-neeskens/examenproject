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

elseif(checklogin() == true) {


    ?>


    <title>Welcome, <?= getName() ?></title>
    <body>
    <?php include('addrun.php') ?>
    <div class="cover"></div>
    <?php
    $color = "green_color";
    include('menu.php') ?>
    <div class="bg-white wide_wrapper fixedthing">

    <div class="wide_wrapper">
    <h2 class="green_color">Welcome,<b> <?= getName($_SESSION['user_id']) ?> </b></h2>
    <h3 class="green_color no-margin">We've missed you, hero.</h3> <br><br>
    <h4 class="green_color"> latest runs</h4>
    <?php
    $x = 3;

    while($x >= 1) :
        $x--;
    ?>
        <div class="latest-runs">
            <div class="bit-4 date"><?= getRunsByUserID()[$x][3] ?> % <img src="img/angle.png"> </div>
            <div class="bit-4 distance"><b><?= getRunsByUserID()[$x][2] ?>K</b> in <b>0<?= getRunsByUserID()[$x][4] ?>:<?= getRunsByUserID()[$x][5] ?></b></div>
            <div class="bit-2 wear"><?= round(getRunsByUserID()[$x][6], 2) ?>% wear</div>
        </div>

        <?php endwhile; ?>
        <br><br><br><br><br><br><br><br><input type="submit" onclick="showPopUp()" class="button-green" value="add new run">
        <br><br><br><br>
        <h4 class="green_color"> nearby events </h4>

        <div alt="oi" class="event box_large">
            <img src="img/mudrunning.png">
            <span>Mudrunning</span>
        </div>

        <div alt="oi" class="event box_large">
            <img src="img/beachrunning.png">
            <span>Beachrunning</span>
        </div>

        <div alt="oi" class="event box_large">
            <img src="img/marathons.png">
            <span>Marathons</span>
        </div>

        <div alt="oi" class="event box_large">
            <img src="img/athletics.png">
            <span>Athletics</span>
        </div>

        <div alt="oi" class="event box_large">
            <img src="img/more.png">
            <span>More...</span>
        </div>

        <br><br><br><br><br><br><br><br>
    </div>

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
            <h2 class="white_color">
            <b>Your</b> <?= $i[1] ?> <?= $i[2] ?>
            </h2>
            <h4 class="white_color">STATUS</h4>
            <H5 class="white_color"><?= round($i[4], 2) ?>% NEW</H5>

            <h4 class="white_color hide_mobile">USED</h4>
            <H5 class="white_color hide_mobile"> <?= time_elapsed_string($i[5]) ?> </H5>

            <h4 class="white_color hide_mobile">DISTANCE RAN</h4>
            <H5 class="white_color hide_mobile"><?= $i[6] ?> KILOMETRES</H5>

        </div>
        <div class="bit-2 progressbar">
            <a target="_blank" class="shopnew" href="http://www.sportsdirect.com/"><i class="fa fa-shopping-bag"></i> Shop new</a>
            <img src="img/models/<?= $i[3] ?>">
        </div>
    </div>
<?php endforeach; ?>

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
