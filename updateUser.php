<?php
   session_start();
   $_SESSION["username"] = "";
   $isAdmin = $_SESSION["isAdmin"];
   $id = $_COOKIE['id'];


   if ($isAdmin == 0){
       header("Refresh:0; url=index.php");
       exit; 
   }
   	
    require "Query.php";
    Query::connectDatabase();

    $id=$_POST['id'];                                    
    $name=$_POST['name'];
    $mail=$_POST['mail'];
    $password=$_POST['password'];
    $address=$_POST['address'];
    $taxid=$_POST['taxid'];
    $isAdmin=$_POST['isAdmin'];

    if($name != ""){
      $query = "UPDATE USERS SET name='$name' WHERE id = '$id'";
      $result = Query::$conn->query($query);
    }

    if($mail != ""){
      $query = "UPDATE USERS SET mail='$mail' WHERE id = '$id'";
      $result = Query::$conn->query($query);
    }

    if($password != ""){
      $query = "UPDATE USERS SET password='$password' WHERE id = '$id'";
      $result = Query::$conn->query($query);
    }

    if($address != ""){
      $query = "UPDATE USERS SET address='$address' WHERE id = '$id'";
      $result = Query::$conn->query($query);
    }

    if($taxid != ""){
      $query = "UPDATE USERS SET taxid='$taxid' WHERE id = '$id'";
      $result = Query::$conn->query($query);
    }

    if($isAdmin != ""){
      $query = "UPDATE USERS SET isAdmin='$isAdmin' WHERE id = '$id'";
      $result = Query::$conn->query($query);
    }

   header("Refresh:0; url=listUsers.php"); 

?>