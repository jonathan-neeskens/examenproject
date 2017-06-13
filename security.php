<?php
/**
 * Created by PhpStorm.
 * User: stagiair
 * Date: 13-06-17
 * Time: 10:10
 */


?>

<div class="bit-3 bg-white">
    <?php $arrayy = getCountryByID(getPersonalDataByUserID()[0][4]) ?>
    <h2 class="green_color">Security details</h2> <br><br>
    <form method="POST">
        <label class="active" for="mail">Password</label>
        <input type="text" name="password" id="password" value="<?= getPersonalDataByUserID()[0][2] ?>"><br>
        <input type="submit" name="update" class="button-green" value="Update">
    </form>
</div>