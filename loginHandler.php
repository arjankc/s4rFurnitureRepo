<?php
session_start();
include('connect.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password =  $_POST['password'];
    $status = $_POST['status'];

    $sql="SELECT * from customers Where username='$username' AND password='$password'";
  $results=$connect->query($sql);
  $final=$results->fetch_assoc();

  $_SESSION['username']=$final['username'];
  $_SESSION['password']=$final['password'];

  $_SESSION['customerid']=$final['id'];

  
if($status == '1'){
    if($username=$final['username'] AND $password=$final['password']){
        header('location: ../cart.php');
      } else {
        if($username=$final['username'] AND $password=$final['password']){
    header('location: ../cart.php');
  } else {
    echo"<script> alert('wrong credentials');
    window.location.href='../customerforms.php';
    </script>";
  }
      }
}else{
    echo"<script> alert('Not verified! Contact Admin ');
    window.location.href='../customerforms.php';
    </script>";
}
}
