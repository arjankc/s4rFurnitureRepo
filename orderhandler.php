<?php
session_start();
error_reporting(0);
include('connect.php');

$total=$_POST['total'];

$phone=$_POST['phone'];

$address=$_POST['address'];
$customerid=$_SESSION['customerid'];
$payment=$_POST['payment'];

$sql="INSERT INTO orders(customer_id,address, phone, total) VALUES('$customerid','$address', '$phone', '$total')";
$connect->query($sql);

$sql2="SELECT id from orders order by id DESC limit 1";
$result=$connect->query($sql2);
$final=$result->fetch_assoc();
$orderid=$final['id'];

foreach ($_SESSION['cart'] as $key => $value) {
	$proid=$value['item_id'];
	$quantity=$value['quantity'];

	$sql3="INSERT INTO order_details(order_id,customer_id,product_id,quantity) VALUES('$orderid','$customerid','$proid','$quantity')";
	$connect->query($sql3);
}

if($payment=="eSewa") {
	$_SESSION['total']=$total;
	$_SESSION['orderid']=$orderid;
	header('location:esewa.php');
} else {
	echo "<script> alert ('order has been placed');
	window.location.href='index.php';
	</script>";
	}
	unset($_SESSION['cart']);
?>