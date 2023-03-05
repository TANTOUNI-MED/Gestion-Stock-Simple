<?php
    $id = $_GET['id'];

    $serverName = "localhost";
    $userName = "root";
    $passWord = "";
    $dbName = "stock_managment";
    $connection = mysqli_connect($serverName, $userName, $passWord, $dbName);
    if($connection->connect_error){
        die('Connection KO :( : '.$connection->connect_error);
    }else{
        $query = "delete from produits where prd_id='$id'";
        $result = $connection->query($query);
        if(!$result){
            echo 'Delete KO :(';
        }else{
            header('location: products.php');
        }
    }
?>