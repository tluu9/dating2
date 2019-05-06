<?php

//validForm

function validForm()
{
    global $f3;
    $isValid = true;

    // Valid first-name
    if (!validName($f3->get('fname')))
    {
        $isValid = false;
        $f3->set("errors['fname']", 'Please enter first name in character');
    }

    //Valid last-name
    if (!validName($f3->get('lname')))
    {
        $isValid = false;
        $f3->set("errors['lname']", 'Please enter last name in character');
    }

    // Valid age
    if (!validAge($f3->get('age')))
    {
        $isValid = false;
        $f3->set("errors['age']", 'Please enter your age in numbers');
    }

    // Valid phone number
    if (!validPhone($f3->get('phone')))
    {
        $isValid = false;
        $f3->set("errors['phone']", 'Please enter your phone number in numbers');
    }
    return $isValid;
}


//validFormTwo

function validFormTwo()
{
    global $f3;
    $isValid = true;

    //Valid email
    if (!validEmail($f3->get('email')))
    {
        $isValid = false;
        $f3->set("errors['email']", "Please enter a valid email");
    }
    return $isValid;
}

//ValidFormThree

function validFormThree()
{
    global $f3;
    $isValid = true;

    // checking the indoor activities
    if (!validIndoor($f3->get('indoor')))
    {
        $isValid = false;
        $f3->set("errors['indoor']", 'Please select indoor activities');
    }
    // checking the outdoor activities
    if (!validOutdoor($f3->get('outdoor')))
    {
        $isValid = false;
        $f3->set("errors['outdoor']", 'Please select a valid outdoor activities');
    }
    return $isValid;
}

//Check last name

function validLname($lname)
{
    return ctype_alpha($lname);
}

//Check first name
function validFname($fname)
{
    return ctype_alpha($fname);
}

//check age
function validAge($age)
{
    return ctype_digit($age) && ($age >= 18 && $age <= 118);
}

//check phone numbers
function validPhone($phone)
{
    return ctype_digit($phone) && strlen($phone) === 10;
}

//check email
function validEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

//check indoor activity
function validIndoor($indoor)
{
    global $f3;
    if(empty($indoor))
    {
        return true;
    }
    foreach($indoor as $interest)
    {
        if(!in_array($interest, $f3->get('indoor')))
        {
            return false;
        }
    }
    return true;
}


//check outdoor activity
function validOutdoor($outdoor)
{
    global $f3;
    if(empty($outdoor))
    {
        return true;
    }
    foreach($outdoor as $interest)
    {
        if(!in_array($interest, $f3->get('outdoor')))
        {
            return false;
        }
    }
    return true;
}
