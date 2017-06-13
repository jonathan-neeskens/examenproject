<?php
/**
 * Created by PhpStorm.
 * User: stagiair
 * Date: 13-06-17
 * Time: 10:09
 */

?>

<div class="bit-3 bg-white">
    <?php $arrayy = getCountryByID(getPersonalDataByUserID()[0][4]) ?>
    <h2 class="green_color">Personal data</h2><br><br>
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
        <input type="date" name="birthdate" id="date" value="<?= getPersonalDataByUserID()[0][5] ?>">
        <input type="submit" name="update" class="button-green" value="Update">
    </form>
</div>