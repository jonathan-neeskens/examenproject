<?php
session_start();

include 'head.php';
$pagetitle = "Login or Register";

if(checklogin() == true){
    header('location: home.php');
}

//Als er op 'Login' gedrukt wordt
if(isset($_POST['login'])){
    $login_errors = array();

    if(empty($_POST['login_username'])){
        array_push($login_errors, "No username entered");
    }

    if(empty($_POST['login_password'])){
        array_push($login_errors, "No password entered");
    }

    if(empty($login_errors)){

        if(login($_POST['login_username'], $_POST['login_password']) == true){
            header('location: home.php');
        }

        elseif(login($_POST['login_username'], $_POST['login_password']) == false){
            array_push($login_errors, "Login failed. Please try again!");
        }
    }
}

//Als er op 'Registreer' gerdrukt wordt
$register_errors = 0;

if(isset($_POST['register'])){
//    $register_errors = array();

    //Check of velden ingevuld zijn
    if(empty($_POST['register_username'])){
        $register_errors = 1;
    }

    if(empty($_POST['register_password'])){
        $register_errors = 1;
    }

    if(empty($_POST['register_name'])){
        $register_errors = 1;
    }

    if(empty($_POST['register_country'])){
        $register_errors = 1;
    }

    if(empty($_POST['register_day'])){
        $register_errors = 1;
    }

    if(empty($_POST['register_month'])){
        $register_errors = 1;
    }

    if(empty($_POST['register_year'])){
        $register_errors = 1;
    }

    if($register_errors == 0){
    //Alle velden zijn ingevuld!
        //Check of username al bestaat
        if (checkIfUserExists($_POST['register_username']) == true){
            //Gebruikersnaam bestaat al! Too bad :(
            $register_error_message = "Username already exists. Try another username or log in";
        }

        else{
            //Gebruikersnaam bestaat nog niet. Ga naar stap 2.
            $_SESSION['arrUserData'] = array($_POST['register_username'], $_POST['register_password'], $_POST['register_name'], $_POST['register_country'], $_POST['register_day'], $_POST['register_month'], $_POST['register_year']);
            header('location: register_step1.php');
        }
    }

    else{
        $register_error_message = "Please fill in all required fields.";
    }
}

?>
<title>Keep Running - <?= $pagetitle ?></title>
<body class="bg-green">
<div class="cover"></div>
    <div class="bit-3 bg-white full_height section">
        <h1 class="green_color">Login</h1>
        <?php $number = 0; ?>
        <?php foreach ($login_errors as $login_error) : ?>

            <span class='error'> <?= $login_errors[$number] ?></span>

            <?php $number = $number + 1; ?>
        <?php endforeach; ?>
        <br><br>
        <form method="POST" action="#">
            <label for="username"> Username </label><input name="login_username" id="username" type="text"> <br>
            <label for="password"> Password </label><input name="login_password" id="password" type="password"> <br>
            <input type="submit" class="button-green" name="login" value="LOGIN">
        </form>
    </div>
    <div class="bit-66 bg-green full_height section">
        <div class="bit-2">
        <h1 class="white_color">REGISTER NOW</h1>
            <?php
            if ($register_error_message){
                echo "<span class='error'>" .$register_error_message. "</span>";
            }
            ?>
        <form method="POST" action="#">
            <label for="email"> Your Email</label><input name="register_username" id="email" type="email"> <br>
            <label for="reg_password">Your password</label> <input name="register_password" id="reg_password" type="password"> <br>
            <label for="name">Your Name</label> <input name="register_name" id="name" type="text"> <br>
            <label for="country" class="active">Your country</label>
<!--            <input name="register_country" id="country" type="text"> -->
            <select name="register_country">
                <option selected disabled>-pick a country-</option>
                <?php foreach(getCountries() as $country) : ?>
                    <option value="<?= $country[0] ?>"> <?= $country[1] ?> </option>
                <?php endforeach; ?>
            </select> <br>
<!--            <label for="register_year" class="active">Your birthdate</label>-->
            <input min="1900" max="2017" maxlength="2" id="birthdate" placeholder="Y" class="bit-4" type="number" name="register_year">
            <input min="01" max="12" maxlength="2" placeholder="M"  id="" class="bit-4" type="number" name="register_month">
            <input min="01" max="31" maxlength="2" placeholder="D" id="" class="bit-4" type="number" name="register_day"> <br><br><br>
            <input type="submit" name="register" class="button-white" value="REGISTER NOW">
        </form>
        </div>

        <?php
        $color = "white_color";
        include ('menu.php');
        ?>
    </div>
<!--    <div class="bit-3 bg-green full_height section" style="padding-top: 50px!important;">-->
<!--        <div class="menu-circle">-->
<!--            <div class="menu-content">-->
<!--                <div class="cross-line-1"></div>-->
<!--                <div class="cross-line-2"></div>-->
<!--                <ul>-->
<!--                    <li>Home</li>-->
<!--                    <li>My profile</li>-->
<!--                    <li>Questions? </li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="onEnter_cover"></div>

    <script>
        
        window.onload = function() {
            // Check if localStorage is available (IE8+) and make sure that the visited flag is not already set.
            if(typeof window.localStorage !== "undefined" && !localStorage.getItem('visited')) {
                // Set visited flag in local storage
                localStorage.setItem('visited', true);
                // Alert the user
                setTimeout(function(){
                    jQuery(".onEnter_cover").addClass("animated");
                }, 400);
            }

            else{
                jQuery(".onEnter_cover").addClass("hide");
            }
        }


//        jQuery('input').on('input', function() {
//
//            $this = jQuery(this);
//            $label = jQuery('label[for="'+ $this.attr('id') +'"]');
//            if ($label.length > 0 ) {
//                $label.addClass("active");
//            }
//
//            if( !this.value ) {
//                $label.removeClass("active");
//            }
//        });

//        jQuery('.menu-circle').click(function() {
//            jQuery(".cover").toggleClass("active");
//            jQuery(".menu-circle").toggleClass("active");
//
//            setTimeout(function(){
//                jQuery(".menu-content").addClass("active");
//            }, 750);
//        });

    </script>
<?php include('footer.php') ?>
</body>
