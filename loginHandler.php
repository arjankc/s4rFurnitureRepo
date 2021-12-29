<?php
session_start();

if (isset($_POST["login"])) {
    include "connect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * from customers Where username='$username' AND password='$password'";

    $results = $connect->query($sql);
    $final = $results->fetch_assoc();

    $status = $final['status'];

    $_SESSION["username"] = $final["username"];
    $_SESSION["password"] = $final["password"];
    $_SESSION["customerid"] = $final["id"];

    if ($status == "1") {
        if (
            ($username = $final["username"]) and
            ($password = $final["password"])
        ) {
            header("location: my-account.php");
        } else {
            echo "<script> alert('wrong credentials');
        window.location.href='login-register.php';
        </script>";
        }
    } else {
        echo "<script> alert('Not verified! Contact Admin ');
    window.location.href='login-register.php';
    </script>";
    }
}
