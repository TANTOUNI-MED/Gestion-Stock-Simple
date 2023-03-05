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
   <h1 class="text-center" id="xx"><span>Categ</span>ories</h1>
</div>

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
         if(!empty($_POST['label'])
            && !empty($_POST['code'])){
            $label = $_POST['label'];
            $code = $_POST['code'];
            $insertQuery = "insert into categories(cat_code, cat_label) values('$code', '$label')";
            $insertResult = $connection->query($insertQuery);
            if(!$insertResult){
               die('Saving KO !!!');
            }
         }
      }
      $query = "select * from categories";
      $result = $connection->query($query);
    }
?>

<div class="container mt-5">
<form action="categories.php" method="post" class="row g-3">

   <div class="col-auto">
    <input type="text" name="code" class="form-control" placeholder="Category code">
  </div>
  <div class="col-auto">
    <input type="text" name="label"  class="form-control" placeholder="Category label">
  </div>
  <div class="col-auto">
    <button name="save" type="submit" class="btn btn-primary mb-3">Add new category</button>
  </div>
</form>
</div>
<?php 
if($result->num_rows){
?>
<div class="container">
        <table class="table table-striped table-hover">
            <thead>
               <tr>
                  <th width="100"></th>
                  <th scope="col">Code</th>
                  <th scope="col">Label</th>
               </tr>
            </thead>
            <tbody>
               <?php
                  while($row = $result->fetch_object()){
               ?>
               <tr>
                   <td>
                       <a style="border: none;" id="<?php echo $row->cat_id ?>" role="button" class="btn btn-outline-danger delete_category"><ion-icon name="trash-outline"></ion-icon></a>
                   </td>
                  <td><?php echo $row->cat_code ?></a></td>
                  <td><?php echo $row->cat_label ?></td>
               </tr>
               <?php
                  }
               ?>
            </tbody>
         </table>
      </div>
 <?php
  }else{
?>
       <div class="container mt-5">
      <h3 class="text-center">
         <small class="text-muted">No category to display!</small>
      </h3>
   </div>
   <?php
      }
  ?>

      <script>
       $('#products').removeClass('active');
       $('#categories').addClass('active');
         $('.delete_category').on('click', function(el){
            Swal.fire({
  title: 'Do you want to delete this category?',
  showDenyButton: false,
  showCancelButton: true,
  confirmButtonText: `Yes`,
  cancelButtonText: `No`
}).then((result) => {
  if (result.isConfirmed) {
    Swal.fire('Deleted!', '', 'success').then((res) => {
      if (res.isConfirmed) {
         const id = el.currentTarget.id;
         const href = 'delete_category.php?id='+id;
         window.location.href = href;
      }
    });
  }
})
         });
      </script>
   </body>
</html>