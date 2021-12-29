<!DOCTYPE html>
<html>
  <?php
  require('../connect.php');
  require('productHandler.php');
  include('adminfiles/session.php');
    include('adminfiles/head.php')
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
          <center><h1>
            PRODUCTS
          </h1></center>
        </section>
          
        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-sm-3">
              
            </div>
            <div class="col-sm-6"> 

            <form role="form" action="" method="post" enctype="multipart/form-data">
              <h1>Add Product</h1>
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Product name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter product name" name="name">
                </div>
                <div class="form-group">
                  <label for="price">Price</label>
                  <input type="text" class="form-control" id="price" placeholder="Enter amount" name="price">
                </div>
                <div class="form-group">
                  <label for="picture">File input</label>
                  <input type="file" id="picture" name="file">
                </div>
                <div class="form-group">
                  <label for="picture">File input</label>
                  <input type="file" id="picture1" name="file1">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <textarea id="description" class="form-control" rows="10" placeholder="Enter Description" name="description"></textarea>
                </div>
                <div class="form-group">
                  <label for="category">Category</label>
                  <select id="category" name="category">
                    <?php
                    include('../connect.php');
                    $cat="SELECT * from categories";
                    $results=mysqli_query($connect,$cat);
                    while($final=mysqli_fetch_assoc($results)){
                    echo "<option value=".$final['id'].">".$final['name']."</option>";
                    }
                    ?>
                  </select>
                </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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