<?php


Flight::route('GET /',function()
{
    Flight::redirect('/sign-in');
});

Flight::route('GET /dashboard',function()
{
    Flight::render('pages/dashboard/dashboard');
});

Flight::route('GET /sign-in',function()
{
    Flight::render('pages/sign-in');
});

Flight::route('GET /sign-up',function()
{
    Flight::render('pages/sign-up');
});

Flight::route('GET /',function()
{

});

Flight::route('GET /',function()
{

});

//
Flight::map('notFound', function()
{
    Flight::render('pages/errors/404');
});
//
Flight::map('error',function (){
    Flight::render('pages/errors/500');
});