<?php
    if (isset($_POST['submit_run'])){

    }
?>

<div class="popup_addrun bg-white">
    <a onclick="disableCover()"> <i class="fa fa-times"></i></a>
    <h2> Add a new run </h2>
    <form method="post" action="#">
        <label for="distance">distance in kilometres</label>
        <input type="text" required name="distance" id="distance"><br>
        <label for="percentage">percentage of height difference</label>
        <input type="text" required name="percentage" id="percentage"><br>
        <label for="time">time</label>
        <input type="text" required name="time" id="time"><br>
        <span class="wear_percentage"> percentage of wear: </span> <br>
        <input type="submit" class="button-green" name="submit_run" value="Submit your run">
    </form>
</div>