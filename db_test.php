<?php
session_start();

//Database gegevens.
$host = 'braintestlab.nl';
$username = 'brain_nl_keeprun';
$password = 'CWcjoB3c4TMv';
$dataBase = 'braintestlab_nl_keeprun';
$port = '3306';
$link = mysqli_connect($host,$username,$password,$dataBase,$port);

$username = "info@jonathanneeskens.nl";
$password = "jonathan";

//Login- functie.
//Wordt aangeroepen met sessie gebruikersnaam en sessie wachtwoord. Geeft true of false terug.

global $link;

$result = mysqli_query($link, "SELECT * FROM users WHERE mail = '$username' AND password = '$password'");
$row = mysqli_fetch_array($result);
$aantal = mysqli_num_rows($result);


    if ($aantal == 1){
        $_SESSION['user']['login'] = 1;
        $_SESSION['userID'] = $row['userID'];

        echo $_SESSION['userName'];
        echo "er is iemand met deze gegevens";
//        return(true);xw
    }

    else{
//        return(false);
        echo "er is niemand met deze gegevens";
    }