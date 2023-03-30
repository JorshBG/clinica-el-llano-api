<?php


Flight::route('GET /',function()
{
    Flight::render('index');
});

Flight::route('GET /dashboard',function()
{
    Flight::render('pages/dashboard/dashboard');
});

Flight::route('GET /signing',function()
{

});

Flight::route('GET /signup',function()
{

});

Flight::route('GET /',function()
{

});

Flight::route('GET /',function()
{

});


Flight::map('notFound', function()
{
    Flight::render('pages/errors/404');
});