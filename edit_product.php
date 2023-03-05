<?php
    $row = (object) [
        'prd_id' => 0,
        'prd_bar_code' => '',
        'prd_label' => '',
        'prd_unit_price' => 0,
        'prd_quantity' => 0,
        'prd_category' => 0
      ];
    $action = '';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $action = 'update_product.php?id='.$id;
        $serverName = "localhost";
        $userName = "root";
        $passWord = "";
        $dbName = "stock_managment";
        $connection = mysqli_connect($serverName, $userName, $passWord, $dbName);
        if($connection->connect_error){
            die('Connection KO :( : '.$connection->connect_error);
        }else{
            $query = "select p.prd_id, p.prd_bar_code, p.prd_label, p.prd_unit_price, p.prd_quantity, p.cat_id
                    from produits p
                    where p.prd_id = '$id'";
            $result = $connection->query($query);
            $row = $result->fetch_object();
            $h1 = $row->prd_label.' product update';
        }
    }else{
        $h1 = 'New product';
        $action = 'insert_product.php';
    }
?>

<!doctype html>
<html>
   <head>
    <title>Stock Manager</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="test.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
   </head>
   <body >
       <?php require 'header.php' ?>

       <?php
    $serverName = "localhost";
    $userName = "root";
    $passWord = "";
    $dbName = "stock_managment";
    $connection = mysqli_connect($serverName, $userName, $passWord, $dbName);
    if($connection->connect_error){
        die('Connection KO :( : '.$connection->connect_error);
    }else{
      $cquery = "select * from categories";
      $cresult = $connection->query($cquery);
    }
?>
    <div class="container mt-4">
        <h1 class="text-center"><?php echo $h1; ?></h1>
    </div> 
    <div class="container col-md-4 mt-10">
       <form action="<?php echo $action; ?>" method="post">
       <input id="id" name="id" type="hidden" value="<?php echo $row->prd_id ?>">
  <div class="mb-3">
    <label for="bar_code" class="form-label">Bar code</label>
    <input type="text" maxLength="10" class="form-control" id="bar_code" name="bar_code" placeholder="Bar code" value="<?php echo $row->prd_bar_code ?>">
  </div>
       <div class="mb-3">
    <label for="label" class="form-label">Label</label>
    <input type="text" class="form-control" id="label" name="label" placeholder="Label" value="<?php echo $row->prd_label ?>">
  </div>
  <div class="mb-3">
    <label for="unit_price" class="form-label">Unit price</label>
    <input type="number" min="0.00" max="10000.00" step="0.01" class="form-control" id="unit_price" name="unit_price" placeholder="Unit price" value="<?php echo $row->prd_unit_price ?>">
  </div>
  <div class="mb-3">
    <label for="quantity" class="form-label">Quantity</label>
    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="<?php echo $row->prd_quantity ?>">
  </div>
  <div class="mb-3">
    <label for="category" class="form-label">Category</label>
    <select class="form-select" id="category" name="category" >
        <?php
            if(!$row->cat_id){
        ?>
            <option selected disabled>Select a category</option>
        <?php
                while($crow = $cresult->fetch_object()){
        ?>
            <option value="<?php echo $crow->cat_id ?>"><?php echo $crow->cat_label ?></option>
        <?php
                }
            }else{
        ?>
            <option disabled>Select a category</option>
        <?php
                $seleced = $row->cat_id;
                while($crow = $cresult->fetch_object()){
                    if($seleced == $crow->cat_id){
        ?>
            <option selected value="<?php echo $crow->cat_id ?>"><?php echo $crow->cat_label ?></option>
        <?php
                    }else{
        ?>
            <option value="<?php echo $crow->cat_id ?>"><?php echo $crow->cat_label ?></option>
        <?php
                    }
                }
            }
      ?>
    </select>
  </div>
  <div class="d-grid gap-2 col-12 mx-auto">
      <button class="btn btn-primary btn-block" name="save" type="submit">Save</button>
  </div>
</form>
      </div>
       
   </body>
</html>