<?php
/**
 * Created by PhpStorm.
 * User: stagiair
 * Date: 13-06-17
 * Time: 10:10
 */

if(isset($_POST['update_password'])){

    $passwordIsEmpty = 0;

    if(empty($_POST['oldpassword'])){
        $passwordIsEmpty = 1;
    }

    if(empty($_POST['password_1'])){
        $passwordIsEmpty = 1;
    }

    if(empty($_POST['password_2'])){
        $passwordIsEmpty = 1;
    }

    if ($passwordIsEmpty == 0){
        //Check of wachtwoord klopt
        if(checkPasswordByUserID($_POST['oldpassword']) == true){
            //Check new passwords

            if($_POST['password_1'] === $_POST['password_2']){
                resetPasswordByUserID($_POST['password_2']);
                $success_message = "Password has been reset.";
            }

            else{
                $error_message = "New passwords were not the same.";
            }
        }

        else{
            $error_message = "This was not your old password.";
        }
    }

    elseif ($passwordIsEmpty == 1){
        $error_message = "not all fields are filled in";
    }
}


?>

    <h2 class="green_color">Reset password</h2> <br><br>
    <?php
    if ($error_message){
        echo "<span class='error'>" .$error_message. "</span> <br><br><br>";
    }

    if ($success_message){
        echo "<span class='succes'>" .$success_message. "</span> <br><br><br>";
    }
    ?>
    <form method="POST">
        <label class="" for="oldpassword">old Password</label>
        <input type="password" name="oldpassword" id="oldpassword"><br><br><br>
        <label class="" for="password_1">New Password</label>
        <input type="password" name="password_1" id="password_1"><br>
        <label class="" for="password_2">Confirm new Password</label>
        <input type="password" name="password_2" id="password_2"><br>
        <input type="submit" name="update_password" class="button-green" value="Update">
    </form>
