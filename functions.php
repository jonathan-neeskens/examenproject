<?php
//error_reporting(1);
session_start();

//Database gegevens.
$host = 'braintestlab.nl';
$username = 'brain_nl_keeprun';
$password = 'CWcjoB3c4TMv';
$dataBase = 'braintestlab_nl_keeprun';
$port = '3306';
$link = mysqli_connect($host,$username,$password,$dataBase,$port);


//Login- functie.
//Wordt aangeroepen met sessie gebruikersnaam en sessie wachtwoord. Geeft true of false terug.
function login($username, $password){
    global $link;

    $result = mysqli_query($link, "SELECT * FROM users WHERE mail = '$username' AND password = '$password'");
    $row = mysqli_fetch_array($result);
    $aantal = mysqli_num_rows($result);

    if ($aantal == 1){
        $_SESSION['user']['login'] = 1;
        $_SESSION['userID'] = $row['userID'];
        return(true);
    }

    else{
        return(false);
    }
}

//Check of gebruiker ingelogt is en dus geautoriseerd is om specifieke pagina's te bezoeken.
//Wordt leeg aangeroepen en geeft true of false terug.
function checklogin(){
    if ($_SESSION['user']['login'] == 0){
        return(false);
    }
    elseif ($_SESSION['user']['login'] == 1){
        return(true);
    }
}


//Verkrijg de naam van de ingelogde gebruiker.
//Wordt aangevraagd met UserID en geeft een String terug.
function getName(){
    global $link;
    $result = mysqli_query($link, "SELECT * FROM users WHERE userID = '$_SESSION[userID]'");
    $row = mysqli_fetch_array($result);

    $name = $row[2];
    return($name);
}


//Verkrijg de schoenen die bij de gebruiker horen. Wordt aangeroepen met User ID, geeft een nested array terug met alle schoenen en bijbehorende gegevens
function getShoeByUserID($userID){
    global $link;

    $result = mysqli_query($link, "SELECT shoe_models.modelID, shoe_brands.name, shoe_models.name, shoe_models.imgURL, user_shoe.status, user_shoe.createDate, user_shoe.distance FROM user_shoe INNER JOIN shoe_models ON user_shoe.modelID = shoe_models.modelID INNER JOIN shoe_brands on shoe_models.brandID = shoe_brands.brandID where user_shoe.userID = $_SESSION[userID]");
    $array_result = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $array_result[] = $row;
    }

    return($array_result);
}

//Roep deze functie aan met een datum en krijg terug hoe lang die datum geleden is, in leesbaar engels.
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ' : 'just now';
}


//REGISTRATIE

//1. CHECK OF GEBRUIKER AL BESTAAT. Wordt aangeroepen met gebruikersnaam en geeft true of false terug.
function checkIfUserExists($username){
    global $link;

    $result = mysqli_query($link, "SELECT * FROM users WHERE mail = '$username'");
    $number = mysqli_num_rows($result);

    if ($number == 1){
        //Gebruikersnaam bestaat al
        return(true);
    }

    else{
        //Gebruikersnaam bestaat niet
        return(false);
    }
}

//Haal alle merken uit de dataBase op. Geeft een array met daarin alle merken, terug.
function getBrands(){
    global $link;

    $result = mysqli_query($link, "SELECT * FROM shoe_brands");
    $array_result = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $array_result[] = $row;
    }

    return $array_result;
}

//Haalt alle gegevens van één merk op aan de hand van het ID. Wordt aangeroepen met brandID, geeft een array met data van het merk terug.
function getBrandByID($brandID){
    global $link;

    $result = mysqli_query($link, "SELECT * FROM shoe_brands WHERE brandID = $brandID");
    $array_result = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $array_result[] = $row;
    }

    return $array_result;
}

//Haalt alle modellen op die bij een merk horen. Wordt gebruikt bij de tweede stap van het registratieproces. Wordt aangeroepen met brandID en geeft een array met alle modellen terug.
function getModelsByBrandID($brandID){
    global $link;

    $result = mysqli_query($link, "SELECT * FROM shoe_models WHERE brandID = $brandID");
    $array_result = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $array_result[] = $row;
    }

    return $array_result;
}

//Registreert een gebruiker. Is de laatste stap in het registratieproces. Wordt aangeroepen met een array met persoonlijke gegevens, het Id van het gekozen schoenmodel, en een array met data over de voeten. Na het registreren start de functie een sessie 'user_id' en stuurt deze door naar de homepagina.
function registerUser($arrUserData, $modelID, $arrFeetData){
    global $link;

    $today = date("Y-m-d");

    $query_1 = mysqli_query($link, "INSERT INTO users VALUES ('', '$arrUserData[0]', '$arrUserData[1]', '$arrUserData[2]', '$arrUserData[3]', '$arrUserData[6]-$arrUserData[5]-$arrUserData[4]')");
    $query_4 = mysqli_query($link, "SELECT * from users WHERE userID = LAST_INSERT_ID()");
    $query_2 = mysqli_query($link, "INSERT INTO user_shoe VALUES ('', LAST_INSERT_ID(), '$modelID', '$today', '100', '0')");
    $row = mysqli_fetch_array($query_4);
    $query_3 = mysqli_query($link, "INSERT INTO profile VALUES ('', $row[userID], '$arrFeetData[0]', '$arrFeetData[1]', '$arrFeetData[2]', '$arrFeetData[3]', '$arrFeetData[4]', '$arrFeetData[5]', '$arrFeetData[6]')");


    $_SESSION['userID'] = $row['userID'];
    $_SESSION['user']['login'] = 1;
    header('location: home.php');
}

//Voegt een run toe en past de status van de schoen aan.
function addRun($arrData){
    global $link;

    $shoeID = getShoeByUserID()[0][0];
    $query_1 = mysqli_query($link, "SELECT * from user_shoe WHERE modelID = $shoeID");
    $row = mysqli_fetch_assoc($query_1);
    $total_percentage = $row['status'] - $arrData[4];
    $total_distance = $row['distance'] + $arrData[1];

    $query_2 = mysqli_query($link, "UPDATE `user_shoe` SET `status` = '$total_percentage', `distance` = '$total_distance' WHERE `user_shoe`.`modelID` = $shoeID");

    $query_3 = mysqli_query($link, "INSERT into runs VALUES ('', $_SESSION[userID], $arrData[1], $arrData[2], $arrData[3], $arrData[4])");
}

//Haalt de runs op. Bij deze functie is het mogelijk een aantal op te geven die teruggegeven mo
function getRunsByUserID($number){
    global $link;

    $test = array(1, 2, 3);
    return($test);
}

//Haalt alle landen op, zonder voorwaarden. Geeft een array met alle landen+IDs terug. wordt aangeroepen op de allereerste stap van het registratieproces.
function getCountries(){
    global $link;

    $result = mysqli_query($link, "SELECT * FROM app_countries");
    $array_result = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $array_result[] = $row;
    }

    return $array_result;
}

//Haalt alle persoonlijke gegevens van een gebruiker op. Geeft een array met alle persoonlijke gegevens terug. Wordt aangeroepen vanuit de sectie 'Personal' op Profile.php
function getPersonalDataByUserID(){
    global $link;

    $result = mysqli_query($link, "SELECT * FROM users WHERE userID = $_SESSION[userID]");
    $array_result = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $array_result[] = $row;
    }

    return $array_result;
}

//Haalt het land op aan de hand van het ID. Geeft het land terug.
function getCountryByID($countryID){
    global $link;

    $result = mysqli_query($link, "SELECT * FROM app_countries WHERE countryID = $countryID");
    $string_result = mysqli_fetch_assoc($result);

    return($string_result);
}

//Haalt voetendata op aan de hand van een User ID. Geeft een array met de data terug.
function getFeetDataByUserID(){
    global $link;

    $result = mysqli_query($link, "SELECT * FROM profile WHERE userID = $_SESSION[userID]");
    $array_result = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $array_result[] = $row;
    }

    return $array_result;
}

//Update de persoonlijke gegevens van een gebruiker. Wordt aangeroepen op profile.php?section=personal
function updateUserData($arrUserData){
    global $link;

    $query = mysqli_query($link, "UPDATE `users` SET `mail` = '$arrUserData[0]', `name` = '$arrUserData[1]', `countryID` = '$arrUserData[2]', `birthdate` = '$arrUserData[3]' WHERE `users`.`userID` = $_SESSION[userID]");
}

//Checkt of wachtwoord dat ingegeven werd bij het reset- proces, ook daadwerkelijk het oude wachtwoord was.
function checkPasswordByUserID($password){
    global $link;

    $result = mysqli_query($link, "SELECT * FROM users WHERE userID = '$_SESSION[userID]' AND password = '$password'");
    $row = mysqli_fetch_array($result);
    $aantal = mysqli_num_rows($result);

    if ($aantal == 1){
        return(true);
    }

    else{
        return(false);
    }
}

function resetPasswordByUserID($password){
    global $link;

    $query = mysqli_query($link, "UPDATE `users` SET `password` = '$password' WHERE `users`.`userID` = $_SESSION[userID]");

}