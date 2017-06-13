<?php

include 'head.php';

if(!$_SESSION['arrUserData']){
    header('location: login.php');
}

if(!$_GET['modelID']){
    header('location: register_step1.php');
}

if(checklogin() == true){
    header('location: home.php');
}

$pagetitle = "Register";
$modelID = $_GET['modelID'];

$errors = 0;

if(isset($_POST['register_user'])){
    if(empty($_POST['size'])){
        $errors = 1;
    }

    if(empty($_POST['w1'])){
        $errors = 1;
    }

    if(empty($_POST['w2'])){
        $errors = 1;
    }

    if(empty($_POST['w3'])){
        $errors = 1;
    }

    if(empty($_POST['h1'])){
        $errors = 1;
    }

    if(empty($_POST['h2'])){
        $errors = 1;
    }

    if(empty($_POST['h3'])){
        $errors = 1;
    }

    if($errors == 0){
        //All fields are filled in.
        $arrFeetData = array($_POST['size'], $_POST['w1'], $_POST['w2'], $_POST['w3'], $_POST['h1'], $_POST['h2'], $_POST['h3']);

        registerUser($_SESSION['arrUserData'], $_GET['modelID'], $arrFeetData);
    }

    else{
        $error_msg = "Please fill in all fields";
    }
}

?>
<title>Keep Running - <?= $pagetitle ?></title>
<body class="bg-green">
<div class="bit-1 bg-green full_height small_wrapper">
    <form method="POST">
        <h2 class="white_color">2. Tell us about your feet. </h2>
        <h3 class="white_color">Enter your size</h3>
        <input type="number" class="w25" name="size">
        <h3 class="white_color">Enter the measurements of your feet</h3>
        <img class="feet" src="img/foot1.png"> <br>
        <input type="number" placeholder="A" class="w10" name="w1" id="w1"> <label class="label2" for="w1">MM</label>
        <input type="number" placeholder="B" class="w10" name="w2"> <label class="label2" for="w2">MM</label>
        <input type="number" placeholder="C" class="w10" name="w3"> <label class="label2" for="w3">MM</label>
        <img class="feet" src="img/foot2.png"> <br>
        <input type="number" placeholder="D" class="w10" name="h1"> <label class="label2" for="h1">MM</label>
        <input type="number" placeholder="E" class="w10" name="h2"> <label class="label2" for="h2">MM</label>
        <input type="number" placeholder="F" class="w10" name="h3"> <label class="label2" for="h3">MM</label>
        <br><br><br><br>
        <span class="error"><?= $error_msg ?> </span><br>
        <input type="submit" class="button-white" value="done" name="register_user"><br><br><br><br>
    </form>
</div>
<?php include('cover.php'); ?>
<script>
    window.onload = function() {
        setTimeout(function(){
            jQuery(".onEnter_cover").addClass("animated");
        }, 400);
    }
</script>
</body>
