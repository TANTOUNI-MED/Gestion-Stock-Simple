<?php
    $serverName = "localhost";
    $userName = "root";
    $passWord = "";
    $dbName = "stock_managment";
    $connection = mysqli_connect($serverName, $userName, $passWord, $dbName);
    if($connection->connect_error){
        die('Connection KO :( : '.$connection->connect_error);
    }else{
        if(isset($_POST['save'])){
            if(!empty($_POST['bar_code']) &&
                !empty($_POST['category']) &&
                !empty($_POST['label']) &&
                !empty($_POST['unit_price']) &&
                !empty($_POST['quantity'])){
                    $bar_code = $_POST['bar_code'];
                    $category = $_POST['category'];
                    $label = $_POST['label'];
                    $unit_price = $_POST['unit_price'];
                    $quantity = $_POST['quantity'];
                    $query = "insert into produits(prd_bar_code, cat_id, prd_label, prd_unit_price, prd_quantity) values ('$bar_code', '$category','$label', '$unit_price', '$quantity')";
                    $result = $connection->query($query);
                    if(!$result){
                        echo 'Saving KO :(';
                    }else{
                        header('location: products.php');
                    }
            } else{
                echo 'All fields are required !';
            }
        }
    }
?>