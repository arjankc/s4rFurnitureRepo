<!DOCTYPE html>
<html>
<?php
require('../connect.php');
include('adminfiles/session.php');
include('adminfiles/head.php')
?>
<?php
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $category = $_POST['category'];
  $files = $_FILES['file'];

  //check ectension of image
  $fileName = $_FILES['file']['name'];
  $fileTmpName = $_FILES['file']['tmp_name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png');

  if (in_array($fileActualExt, $allowed)) {
      if ($fileError === 0) {
          if ($fileSize < 5000000) {
              $fileNameNew = uniqid() . '_' . $fileName;
              $fileDestination = '../uploads/' . $fileNameNew;
              move_uploaded_file($fileTmpName, $fileDestination);

              //image 2
              $filess = $_FILES['file1'];
              $filesName = $_FILES['file1']['name'];
              $filesTmpName = $_FILES['file1']['tmp_name'];
              $filesSize = $_FILES['file1']['size'];
              $filesError = $_FILES['file1']['error'];
              $filesType = $_FILES['file1']['type'];

              $filesExt = explode('.', $filesName);
              $filesActualExt = strtolower(end($filesExt));

              $allowedd = array('jpg', 'jpeg', 'png');

              if (in_array($filesActualExt, $allowedd)) {
                  if ($filesError === 0) {
                      if ($filesSize < 5000000) {
                          $filesNameNew = uniqid() . '_' . $filesName;
                          $filesDestination = '../uploads/' . basename($filesNameNew);
                          move_uploaded_file($filesTmpName, $filesDestination);

                          //insert into db
                          $savecategory = "UPDATE products SET `name` = '$name', `price` = '$price',`description` = '$description',`image1` = '$fileDestination',`image2` = '$filesDestination' WHERE id='$id'";
                          if ($connect->query($savecategory)) {
                              // if saved entry 
                              #2.header location
                              echo "Inserted successfully!";
                          } else {
                              //if not saved in database print why not error
                              die("insert failed $connect->error");
                          }
                      } else {
                          echo "Your file is too large!";
                      }
                  } else {
                      echo "There was an error!";
                  }
              } else {
                  echo "You cannot upload files of this type";
              }
          } else {
              echo "Your file is too large!";
          }
      } else {
          echo "There was an error!";
      }
  } else {
      echo "You cannot upload files of this type";
  }
}
?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <?php
    include('adminfiles/header.php')
    ?>
    <!-- Left side column. contains the logo and sidebar -->
    <?php
    include('adminfiles/aside.php');
    ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <center>
          <h1>
            PRODUCTS
          </h1>
        </center>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-sm-3">
          
          </div>
          <div class="col-sm-6">

            <form role="form" action="proupdatehandler.php" method="post" enctype="multipart/form-data">
              <?php
              include("../connect.php");
              if(isset($_GET['id'])){
              $id = $_GET['id'];
            
                $sql = "SELECT * FROM products WHERE id='$id' ";
                $res = mysqli_query($connect, $sql);
                $final = $res->fetch_assoc();

              }
              ?>
              <h1>Update Product</h1>
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Product name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter product name" name="name" value="<?php echo $final['name'] ;?>">
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control" id="price" placeholder="Enter amount" name="price" value="<?php echo  $final['price'] ;?>">
                </div>
                <div class="form-group">
                  <label for="picture">File input</label>
                  <br>
                  <img src="<?php echo $final['image1'];?>" alt="" style="height:100px!important; width:100px!important; object-fit:cover;"> 
                  <br>
                  <br>
                  <input type="file" id="picture" name="file" value="<?php echo  $final['image1'] ;?>">
                </div>
                <div class="form-group">
                  <label for="picture">File input</label>
                  <br>
                  <img src="<?php echo $final['image2'];?>" alt="" style="height:100px!important; width:100px!important; object-fit:cover;"> 
                  <br>
                  <br>
                  <input type="file" id="picture1" name="file1" value="<?php echo  $final['image2'] ;?>">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea class="form-control" name="description" id="description" rows="10" style="height: 180px;" ><?php echo $final['description'];?></textarea>
                </div>
                <div class="form-group">
                  <label for="category">Category</label>
                  <select id="category" name="category">
                    <?php
                    include('connect.php');
                    $id = $_GET['id'];
                        $sql = "SELECT c.name AS catname, d.* FROM products d JOIN categories c ON d.category_id = c.id  WHERE d.id='$id'";
                    
                    $results = mysqli_query($connect, $sql);
                    while ($final = mysqli_fetch_assoc($results)) {
                      echo"<option selected value= " . $final['id'] . ">" ."Recent-"  . $final['catname'] . "</option>";
                      $cat="SELECT * from categories";
                    $results=mysqli_query($connect,$cat);
                    while($final=mysqli_fetch_assoc($results)){
                    echo "<option value=".$final['id'].">".$final['name']."</option>";
                    }
                  }
                    ?>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" value="<?php echo $row['id']?>" name="form_id">
                <button type="submit" name="update" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </section>
      <!-- /.content -->
      <div class="col-sm-3">
      </div>
    </div>
    <!-- /.content-wrapper -->
  </div>
  <?php
  include('adminfiles/footer.php');
  ?>
</body>

</html>