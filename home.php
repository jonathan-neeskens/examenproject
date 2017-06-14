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

    <div class="bit-66">
    <h2 class="green_color">Welcome,<b> <?= getName($_SESSION['user_id']) ?> </b></h2>
    <h3 class="green_color no-margin">We've missed you, hero.</h3> <br><br>
    <h4 class="green_color"> latest runs</h4>
    <?php
    $x = 3;

    while($x >= 1) :
        $x--;
    ?>
        <div class="latest-runs">
            <div class="bit-4 date"><?= getRunsByUserID()[$x][3] ?> % height diff </div>
            <div class="bit-4 distance"><b><?= getRunsByUserID()[$x][2] ?>K</b> in <b><?= getRunsByUserID()[$x][4] ?> : <?= getRunsByUserID()[$x][5] ?></b></div>
            <div class="bit-2 wear"><?= round(getRunsByUserID()[$x][6], 2) ?>% wear</div>
        </div>

        <?php endwhile; ?>
        <br><br><br><br><br><br><br><br><input type="submit" onclick="showPopUp()" class="button-green" value="add new run">
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
            <b>Your</b> <?= $i[1] ?> <?= $i[2] ?>
            </h2>
            <h4 class="white_color">WEAR</h4>
            <H5 class="white_color"><?= round($i[4], 2) ?>% NEW</H5>

            <h4 class="white_color">USED</h4>
            <H5 class="white_color"> <?= time_elapsed_string($i[5]) ?> </H5>

            <h4 class="white_color">DISTANCE RAN</h4>
            <H5 class="white_color"><?= $i[6] ?> KILOMETRES</H5>

        </div>
        <div class="bit-2 progressbar">
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
