<?php
Flight::route('/test1', function (){
    Flight::json(['message'=>'Este es el test 1']);
});