<?php
/**
Trang Luu
20 Apil 2019
Dating Website/ HTML Home page
*/
session_start();
//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//require the autoload file autoload.php
require_once('vendor/autoload.php');

//Create an instance of the Base class/ instantiate Fat-Free
$f3 = Base::instance();

//Turn on Fat-free error reporting/Debugging
$f3->set('DEBUG',3);

//Define a default route
$f3->route('GET /', function() {
    //Display a view
    $view = new Template();
    echo $view->render('views/home.html');
});

//Define personal route
$f3->route('POST /personal', function() {

    //Display personal form
    $view = new Template();
    echo $view->render('views/personal.html');
});

//Define profile route
$f3->route('POST /profile', function() {


    $_SESSION['lname'] = $_POST['lname'];
    $_SESSION['fname'] = $_POST['fname'];
    $_SESSION['age'] = $_POST['age'];
    $_SESSION['gender'] = $_POST['gender'];
    $_SESSION['phone'] = $_POST['phone'];

    //Display  profile form
    $view = new Template();
    echo $view->render('views/profile.html');
});

//Define interests route
$f3->route('POST /interest', function() {

    $_SESSION['email'] = $_POST['email'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['seeking'] = $_POST['seeking'];
    $_SESSION['bio'] = $_POST['bio'];

    //Display interest form
    $view = new Template();
    echo $view->render('views/interest.html');
});

//Define a summary route
$f3->route('POST /summary', function() {

    $_SESSION['interest'] = $_POST['interest'];

    //Display summary
    $view = new Template();
    echo $view->render('views/summary.html');
});


//Run fat free F3
$f3->run();


