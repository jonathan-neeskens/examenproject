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

    $result = mysqli_query($link, "SELECT shoe_brands.name, shoe_models.name, shoe_models.imgURL, user_shoe.status, user_shoe.createDate, user_shoe.distance FROM user_shoe INNER JOIN shoe_models ON user_shoe.modelID = shoe_models.modelID INNER JOIN shoe_brands on shoe_models.brandID = shoe_brands.brandID where user_shoe.userID = $_SESSION[userID]");
    $array_result = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
        $array_result[] = $row;
    }

    return($array_result);
}

//Roep deze functie aan met een datum en krijg terug hoe lang die datum geleden is.
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

//Haalt alle modellen op die bij een merk horen. Wordt gebruikt bij de tweede stap van het registratieproces. Wordt aangeroepen met brandID en geeft een array met alle modellen terug.
function getModelsByBrandID($brandID){
    global $link;
}
