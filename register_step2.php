<?php

include 'head.php';

$pagetitle = "Register";
$modelID = $_GET['modelID'];

?>
<title>Keep Running - <?= $pagetitle ?></title>
<body class="bg-green">
<div class="bit-1 bg-green full_height small_wrapper">
    <h2 class="white_color">2. Tell us about your feet. </h2>
    <h3 class="white_color">Enter your size</h3>
    <input type="number" class="w25" name="size">
    <h3 class="white_color">Enter the measurements of your feet</h3>
    <img src="img/foot1.png"> <br>
    <img src="img/foot2.png">
</div>
<?php //include('cover.php'); ?>
<script>
    window.onload = function() {
        setTimeout(function(){
            jQuery(".onEnter_cover").addClass("animated");
        }, 400);
    }
</script>
</body>
