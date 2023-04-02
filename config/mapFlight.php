<?php
Flight::map('notFound', function()
{
    Flight::render('pages/errors/404');
});
//
Flight::map('error',function (){
    Flight::render('pages/errors/500');
});

Flight::map('unauthorized', function (){
    Flight::render('pages/errors/401');
});