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
require_once('model/validate.php');

//Create an instance of the Base class/ instantiate Fat-Free
$f3 = Base::instance();

//Turn on Fat-free error reporting/Debugging
$f3->set('DEBUG',3);

//Genders array
$f3-> set('gender', array('Male', 'Female'));

//State
$f3->set('state', array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho','District of Columbia',
    'Iowa','Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana ', 'Maine',
    'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri',
    'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico',
    'New York', 'North Carolina', 'North Dakota', 'Ohio ', 'Oklahoma', 'Oregon ',
    'Puerto Rico','Pennsylvania', 'Rhode Island ', 'South Carolina', 'South Dakota ', 'Tennessee',
    'Texas ', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin ',
    'Wyoming',
));

//Interest
$f3->set("indoor", array('Tv', 'Puzzles', 'Movies', 'Reading', 'Cooking',
                            'Playing cards', 'Board games', 'Video games'));
$f3->set("outdoor", array('Hiking', 'Walking', 'Biking', 'Climbing', 'Swimming',
                            'Collecting'));

//Define a default route
$f3->route('GET /', function() {
    //Display a view
    $view = new Template();
    echo $view->render('views/home.html');
});

//Route to personal
$f3->route('POST /personal', function ($f3)
{
    if(!empty($_POST)) {

        //personal data
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];

        //Add personal data to hive
        $f3->set('fname', $fname);
        $f3->set('lname', $lname);
        $f3->set('age', $age);
        $f3->set('gender', $gender);
        $f3->set('phone', $phone);

        //Check if data is valid
        if (validForm()) {

            //Session
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['age'] = $age;
            $_SESSION['phone'] = $phone;

            $f3->reroute('/profile');
        }
    }
    $view = new Template();
    echo $view->render('views/personal.html');
});

//Define personal route
$f3->route('GET|POST /profile', function($f3) {

    if(!empty($_POST))
    {
        //data
        $email = $_POST['email'];
        $state = $_POST['state'];
        $seeking = $_POST['seeking'];
        $bio = $_POST['bio'];

        //hive
        $f3->set('email', $email);
        $f3->set('state', $state);
        $f3->set('seeking', $seeking);
        $f3->set('bio', $bio);

        if(validFormTwo())
        {
            //Session
            $_SESSION['email'] = $email;
            $_SESSION['state'] = $state;
            $_SESSION['seeking'] = $seeking;
            $_SESSION['bio'] = $bio;
            $f3->reroute('/interest');
        }
    }

    //Display personal form
    $view = new Template();
    echo $view->render('views/profile.html');
});


//Define interests route
$f3->route('GET|POST /interest', function($f3) {

    if(!empty($_POST))
    {
        //data
        $indoor = $_POST['indoor'];
        $outdoor = $_POST['outdoor'];

        //hive
        $f3->set('indoor', $indoor);
        $f3->set('outdoor', $outdoor);

        //Session
        if(validFormThree())
        {
            $_SESSION['indoor'] = $indoor;
            $_SESSION['outdoor'] = $outdoor;
            $f3->reroute('summary');
        }
    }

    //Display interest form
    $view = new Template();
    echo $view->render('views/interest.html');
});

//Define a summary route
$f3->route('GET|POST /summary', function() {

    //Display summary
    $view = new Template();
    echo $view->render('views/summary.html');
});


//Run fat free F3
$f3->run();


