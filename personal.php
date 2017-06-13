<?php
/**
 * Created by PhpStorm.
 * User: stagiair
 * Date: 13-06-17
 * Time: 10:09
 */

if(isset($_POST['update_personal_data'])){
//    $register_errors = array();

    //Check of velden ingevuld zijn
    if(empty($_POST['mail'])){
        $register_errors = 1;
    }

    if(empty($_POST['name'])){
        $register_errors = 1;
    }

    if(empty($_POST['country'])){
        $register_errors = 1;
    }

    if(empty($_POST['birthdate'])){
        $register_errors = 1;
    }


    if($register_errors == 0){
            $arrUserData = array($_POST['mail'], $_POST['name'], $_POST['country'], $_POST['birthdate']);
            updateUserData($arrUserData);
            $success_message = "Details were updated";
        }

    else{
        $error_message = "Please fill in all required fields.";
    }
}


?>

    <?php $arrayy = getCountryByID(getPersonalDataByUserID()[0][4]) ?>
    <h2 class="green_color">Personal data</h2><br><br>
    <?php
    if ($error_message){
        echo "<span class='error'>" .$error_message. "</span> <br><br><br>";
    }

    if ($success_message){
        echo "<span class='succes'>" .$success_message. "</span> <br><br><br>";
    }
    ?>
    <form method="POST">
        <label class="active" for="mail">Mail</label>
        <input type="text" name="mail" id="mail" value="<?= getPersonalDataByUserID()[0][1] ?>"><br>
        <label class="active" for="name">Name</label>
        <input type="text" name="name" id="name" value="<?= getPersonalDataByUserID()[0][3] ?>"><br>
        <label class="active" for="country">Country</label>
        <select name="country" id="country">
            <option selected value="<?= $arrayy["countryID"] ?>"> <?= $arrayy["name"] ?> </option>
            <?php foreach(getCountries() as $country) : ?>

                <option value="<?= $country[0] ?>"> <?= $country[1] ?> </option>

            <?php endforeach; ?>
        </select> <br>
        <label class="active" for="date">Birthdate</label>
        <input type="date" name="birthdate" id="date" value="<?= getPersonalDataByUserID()[0][5] ?>"> <br>
        <input type="submit" name="update_personal_data" class="button-green" value="Update"> <br>
    </form>
