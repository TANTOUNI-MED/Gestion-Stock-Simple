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
                !empty($_POST['id']) &&
                !empty($_POST['category']) &&
                !empty($_POST['label']) &&
                !empty($_POST['unit_price']) &&
                !empty($_POST['quantity'])){
                    $id = $_POST['id'];
                    $bar_code = $_POST['bar_code'];
                    $category = $_POST['category'];
                    $label = $_POST['label'];
                    $unit_price = $_POST['unit_price'];
                    $quantity = $_POST['quantity'];
                    $query = "update produits set prd_bar_code='$bar_code', cat_id='$category', prd_label='$label', prd_unit_price='$unit_price', prd_quantity='$quantity' where prd_id = '$id'";
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