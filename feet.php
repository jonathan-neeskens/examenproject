<?php
/**
 * Created by PhpStorm.
 * User: stagiair
 * Date: 13-06-17
 * Time: 10:10
 */

$errors = 0;

if(isset($_POST['update_feet_data'])){
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

        $success_message = "Details were updated.";

        updateFeetByUserID($arrFeetData);
    }

    else{
        $error_message = "Please fill in all fields";
    }
}

?>

<div class="bit-3 bg-white">
    <h2 class="green_color">Feet details</h2><br><br>
    <?php
    if ($error_message){
        echo "<span class='error'>" .$error_message. "</span> <br><br><br>";
    }

    if ($success_message){
        echo "<span class='succes'>" .$success_message. "</span> <br><br><br>";
    }


    ?>
    <form method="POST">
        <label class="active" for="size">SIZE</label><input type="number" value="<?= getFeetDataByUserID()[0][2] ?>" class="w25" name="size">
        <img class="feet" src="img/foot1.png"> <br>
        <label class="active" for="h1">A (MM)</label><input value="<?= getFeetDataByUserID()[0][3] ?>" type="number" class="w25" placeholder="A" name="w1">
        <label class="active" for="h1">B (MM)</label><input value="<?= getFeetDataByUserID()[0][4] ?>" type="number" class="w25" placeholder="B" name="w2">
        <label class="active" for="h1">C (MM)</label> <input value="<?= getFeetDataByUserID()[0][5] ?>" type="number" class="w25" placeholder="C" name="w3">
        <img class="feet" src="img/foot2.png"> <br>
        <label class="active" for="h1">D (MM)</label><input value="<?= getFeetDataByUserID()[0][6] ?>" type="number" class="w25" placeholder="D" name="h1">
        <label class="active" for="h1">E (MM)</label><input value="<?= getFeetDataByUserID()[0][7] ?>" type="number" class="w25" placeholder="E" name="h2">
        <label class="active" for="h1">F (MM)</label> <input value="<?= getFeetDataByUserID()[0][8] ?>" type="number" class="w25" placeholder="F" name="h3">
        <input type="submit" name="update_feet_data" class="button-green" value="Update">
    </form>
</div>
