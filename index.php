<?php
//this line makes PHP behave in a more strict way
declare(strict_types=1);

//we are going to use session variables so we need to enable sessions
session_start();

function whatIsHappening() {
    echo '<h2>$_GET</h2>';
    var_dump($_GET);
    echo '<h2>$_POST</h2>';
    var_dump($_POST);
    echo '<h2>$_COOKIE</h2>';
    var_dump($_COOKIE);
    echo '<h2>$_SESSION</h2>';
    var_dump($_SESSION);
}

//your products with their price.

$food = [
    ['name' => 'Club Ham', 'price' => 3.20],
    ['name' => 'Club Cheese', 'price' => 3],
    ['name' => 'Club Cheese & Ham', 'price' => 4],
    ['name' => 'Club Chicken', 'price' => 4],
    ['name' => 'Club Salmon', 'price' => 5]
];

$drinks = [
    ['name' => 'Cola', 'price' => 2],
    ['name' => 'Fanta', 'price' => 2],
    ['name' => 'Sprite', 'price' => 2],
    ['name' => 'Ice-tea', 'price' => 3],
];
// 2 different $products arrays link at the top of the page you click
if (isset($_GET['food'])) {
    if ($_GET['food']) {
        $products = $food;
    } else {
        $products = $drinks;
    }
}else {
    $products = $food;
}
$totalValue = 0;

// define variables and set to empty values
$emailErr = $streetErr = $streetnumberErr = $cityErr = $zipcodeErr = "";
$email = $street = $streetnumber = $city = $zipcode = "";

// required fields
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = test_input($_POST["email"]);
    }

    // validating email format
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    if (empty($_POST["street"])) {
        $streetErr = "Street is required";
    } else {
        $street = test_input($_POST["street"]);
    }

    if (empty($_POST["streetnumber"])) {
        $streetnumberErr = "Street number is required";
    } else {
        $streetnumber = test_input($_POST["streetnumber"]);
    }

    // only numbers
    if (!preg_match("/^[0-9]+$/",$streetnumber)) {
        $streetnumberErr = "The street number should be only numbers";
    }
    if (empty($_POST["city"])) {
        $cityErr = "City is required";
    } else {
        $city = test_input($_POST["city"]);
    }

    if (empty($_POST["zipcode"])) {
        $zipcodeErr = "Zipcode is required";
    } else {
        $zipcode = test_input($_POST["zipcode"]);
    }

    //only numbers
    if (!preg_match("/^[0-9]+$/",$zipcode)) {
        $zipcodeErr = "The zipcode should be only numbers";
    }
}


function test_input($data) {
    return $data;
}

// Set session variables
if (!empty($_POST["email"])) {
    $_SESSION["email"] = $_POST["email"];
}
if (!empty($_POST["street"])) {
    $_SESSION["street"] = $_POST["street"];
}
if (!empty($_POST["streetnumber"])) {
    $_SESSION["streetnumber"] = $_POST["streetnumber"];
}
if (!empty($_POST["city"])) {
    $_SESSION["city"] = $_POST["city"];
}
if (!empty($_POST["zipcode"])) {
    $_SESSION["zipcode"] = $_POST["zipcode"];
}

//Calculate the delivery time
/*if (isset()){
    ;
} else {
    ;
}*/

whatIsHappening();

require 'form-view.php';