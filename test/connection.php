<?php
try{

    $connection = new PDO("mysql:host=" . "67.227.206.160" . ";dbname=" . "clini183_sistema_clinicaWeb" . ";port=" . "3306", "clini183_admin", "45+OlCat6=443+");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    var_dump($connection);

    $stm = $connection->prepare("CALL get_all_products();");
    $flag = $stm->execute();
    if ($flag){
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        print("sucess connection\n");
        var_dump($result);
    } else {
        print('bad query');
    }


} catch (PDOException $exception) {
    print($exception->getMessage());
}
//DBNAME="clini183_sistema_clinicaWeb"
//DBUSER="clini183_admin"
//DBPASSWORD="45+OlCat6=443+"
//DBPORT="3306"
//DBHOST="67.227.206.160"