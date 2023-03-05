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
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script
   src="https://code.jquery.com/jquery-3.6.0.min.js"
   integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
   crossorigin="anonymous"></script>
   
   </head>
   <body class="hh">
     
       <?php require 'header.php' ?>


<div class="container mt-5 mb-5">
   <h1 class="text-center" id="xx">Prod<span>ucts</span></h1>
</div>

<div class="container">
   <a class="btn btn-primary" href="edit_product.php" role="button">New product</a>
   <?php
    $serverName = "localhost";
    $userName = "root";
    $passWord = "";
    $dbName = "stock_managment";
    $connection = mysqli_connect($serverName, $userName, $passWord, $dbName);
    if($connection->connect_error){
        die('Connection KO :( : '.$connection->connect_error);
    }else{
      $query = "select p.prd_id, p.prd_bar_code, p.prd_label, p.prd_unit_price, p.prd_quantity, c.cat_label
               from produits p inner join categories c
               on p.cat_id = c.cat_id";
      $result = $connection->query($query);
      if($result->num_rows){
?>
   <table class="table table-striped table-hover mt-4 mb-4">
            <thead>
               <tr>
                   <th width="200"></th>
                  <th scope="col">Bar code</th>
                  <th scope="col">Label</th>
                  <th scope="col">Unit price</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Category</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  while($row = $result->fetch_object()){
               ?>
               <tr>
                   <td>
                       <a style="border: none;" id="<?php echo $row->prd_id ?>" role="button" class="btn btn-outline-danger delete_product"><ion-icon name="trash-outline"></ion-icon></a>
                       <a style="border: none;" href="edit_product.php?id=<?php echo $row->prd_id ?>" role="button" class="btn btn-outline-success"><ion-icon name="create-outline"></ion-icon></a>
                    </td>
                  <td><?php echo $row->prd_bar_code ?></td>
                  <td><?php echo $row->prd_label ?></td>
                  <td><?php echo $row->prd_unit_price.' dh' ?></td>
                  <?php
                     if($row->prd_quantity <= 3){
                  ?>
                  <td class="text-danger font-weight-bold"><?php echo $row->prd_quantity ?></td>
                  <?php
                     }else{
                  ?>
                  <td><?php echo $row->prd_quantity ?></td>
                  <?php
                     }
                  ?>
                  <td><?php echo $row->cat_label ?></td>
               </tr>
               <?php
                  }
               ?>
            </tbody>
         </table>

         <a class="btn btn-primary mb-4" href="edit_product.php" role="button">New product</a>
<?php
      }else{
?>
   <div class="container mt-5">
      <h3 class="text-center">
         <small class="text-muted">No Products to display!</small>
      </h3>
   </div>
<?php
      }
    }
?>
      </div>

      <script>
         $('#categories').removeClass('active');
         $('#products').addClass('active');
         $('.delete_product').on('click', function(el){
            Swal.fire({
  title: 'Do you want to delete this product?',
  showDenyButton: false,
  showCancelButton: true,  
  confirmButtonText: `Yes`,
  cancelButtonText: `No`
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire('Deleted!', '', 'success').then((res) => {
      if (res.isConfirmed) {
         const id = el.currentTarget.id;
         const href = 'delete_product.php?id='+id;
         window.location.href = href;
      }
    });
  }
})
         });
      </script>
      
   </body>
</html>