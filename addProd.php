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
    $product = $_POST['prodName'];
    $description = $_POST['description'];
    $distInfo = $_POST['distInfo'];
	$warrant = $_POST['warrant-stat'];
    $model = $_POST['model-num'];
    $price = $_POST['price'];
	$discPercentage = $_POST['discPercentage'];
    $stock = $_POST['stock'];
    $category = $_POST['category'];

if(empty($_POST['prodName']) || empty($_POST['description']) ||  empty($_POST['distInfo']) ||  empty($_POST['warrant-stat']) ||  empty($_POST['model-num']) ||  empty($_POST['price']) ||  empty($_POST['discPercentage']) ||  empty($_POST['stock']) ||  empty($_POST['category'])   )
	{
		echo "<script>alert('You have an empty field.');</script>";
//    	header("Refresh:0; url=admin.php");   // go back to the register page
		echo $product. $description. $distInfo. $warrant. $model. $price. $discPercentage. $stock;
	}
	else{
	    $queryProd = "INSERT INTO PRODUCTS (pname, description, dist_info, warranty_status, model_number, price, discount, stock_quantity) VALUES ('$product', '$description', '$distInfo', '$warrant', '$model', '$price', '$discPercentage', '$stock')";

	  	$query = "SELECT *
            	  FROM CATEGORY
                  WHERE cname = '$category'";
	    $result = Query::$conn->query($query);

	    if(mysqli_num_rows($result) == 0){
			$query = "INSERT INTO CATEGORY (cname) VALUES ('$category')";
			$insertRes = Query::$conn->query($query);

		  	$query = "SELECT *
	            	  FROM CATEGORY
	                  WHERE cname = '$category'";
		    $result = Query::$conn->query($query);
			}

		$cat = $result->fetch_assoc();
		$catID = $cat[cid];
		

		if (Query::$conn->query($queryProd) === TRUE) {

			$queryPid = "SELECT *
						 FROM PRODUCTS
						 WHERE pname = '$product'";
		 	$resPid = Query::$conn->query($queryPid);

		 	$prodPid = $resPid->fetch_assoc();
		 	$pid = $prodPid[pid];

		 	$query = "INSERT INTO PRODUCT_CATEGORY (pid, cid) VALUES ('$pid', '$catID')";
		 	$result = Query::$conn->query($query);

			echo "<script>alert('Product Added!');</script>";
		} else {
    		echo "<script>alert('error');</script>";
		}

	    header("Refresh:0; url=admin.php"); 
}
?>