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
    $productID = $_POST['prodID'];

    if(empty($_POST['prodID'])){
    	echo "<script>alert('Please enter the product ID you want to delete.');</script>";

    }
    else{
    	$query = "SELECT *
    			  FROM PRODUCTS
    			  WHERE pid = '$productID'";
    	$result = Query::$conn->query($query);

    	if(mysqli_num_rows($result) == 0){
    		echo "<script>alert('There is no product with the given product ID');</script>";    	}
    	else{
    		$query = "DELETE FROM PRODUCTS WHERE pid = '$productID'";
    		if (Query::$conn->query($query) === TRUE) {
    			echo "<script>alert('Successfully deleted given product.');</script>";
    		}
    	}
    }

	header("Refresh:0; url=admin.php"); 
?>