<?php

session_start();
$isActive = $_SESSION['active']??false;

Flight::route('GET /',function()
{
    Flight::redirect('/sign-in');
});

Flight::route('GET /dashboard',function() use($isActive)
{
    if ($isActive){
        Flight::render('pages/dashboard/dashboard');
    } else {
        Flight::unauthorized();
    }
});

Flight::route('GET /sign-in',function() use($isActive)
{
    if ($isActive){
        Flight::redirect('/dashboard');
    } else {
        Flight::render('pages/sign-in');
    }
});

Flight::route('GET /sign-up',function() use($isActive)
{
    if ($isActive){
        Flight::redirect('/dashboard');
    } else {
        Flight::render('pages/sign-up');
    }
});

Flight::route('GET /sign-out', function()
{
    Flight::clear();
    unset($_SESSION['active']);
    unset($_SESSION['userID']);
    Flight::redirect('/');
});