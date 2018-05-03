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

    $pid = $_POST['pid'];
    $product = $_POST['pname'];
    $description = $_POST['description'];
    $distInfo = $_POST['dist_info'];
    $warrant = $_POST['warranty_status'];
    $model = $_POST['model_number'];
    $price = $_POST['price'];
    $discPercentage = $_POST['discount'];
    $stock = $_POST['stock_quantity'];

    if($product != ""){
      $query = "UPDATE PRODUCTS SET pname='$product' WHERE pid = '$pid'";
      $result = Query::$conn->query($query);
    }

    if($description != ""){
      $query = "UPDATE PRODUCTS SET description='$description' WHERE pid = '$pid'";
      $result = Query::$conn->query($query);
    }

    if($distInfo != ""){
      $query = "UPDATE PRODUCTS SET dist_info='$distInfo' WHERE pid = '$pid'";
      $result = Query::$conn->query($query);
    }

    if($warrant != ""){
      $query = "UPDATE PRODUCTS SET warranty_status='$warrant' WHERE pid = '$pid'";
      $result = Query::$conn->query($query);
    }

    if($model != ""){
      $query = "UPDATE PRODUCTS SET model_number='$model' WHERE pid = '$pid'";
      $result = Query::$conn->query($query);
    }

    if($price != ""){
      $query = "UPDATE PRODUCTS SET price='$price' WHERE pid = '$pid'";
      $result = Query::$conn->query($query);
    }

    if($discPercentage != ""){
      $query = "UPDATE PRODUCTS SET discount='$discPercentage' WHERE pid = '$pid'";
      $result = Query::$conn->query($query);
    }

    if($stock != ""){
      $query = "UPDATE PRODUCTS SET stock_quantity='$stock' WHERE pid = '$pid'";
      $result = Query::$conn->query($query);
    }



   header("Refresh:0; url=listProds.php"); 

?>