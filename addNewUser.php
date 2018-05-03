<?php
	
    require "Query.php";
    Query::connectDatabase();
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $taxid = $_POST['taxid'];
    $isAdmin = $_POST['isAdmin'];

if(empty($_POST['name']) || empty($_POST['password']) ||  empty($_POST['mail']) ||  empty($_POST['taxid']) ||  empty($_POST['isAdmin']) ||  empty($_POST['isAdmin'])   )
	{
		echo "<script>alert('You have an empty field.');</script>";
    	header("Refresh:0; url=listUsers.php");   // go back to the register page
	}
	else{
	  	$query = "SELECT USERS.id
            	  FROM USERS
                  WHERE USERS.mail = '$mail'";
	    $result = Query::$conn->query($query);
	    if(mysqli_num_rows($result) != 0){
			echo "<script>alert('Entered e-mail already has an account!');</script>";
	    	header("Refresh:0; url=register.php"); 
	    }
	    else{
	    $query = "INSERT INTO USERS (password, mail , name, isAdmin, address, taxid) VALUES ('$password', '$mail', '$name', '$isAdmin', '$address', '$taxid')";
		if (Query::$conn->query($query) === TRUE) {
			echo "<script>alert('User successfully added!');</script>";
		} else {
    		echo "<script>alert('error');</script>";
		}
		}
	    header("Refresh:0; url=listUsers.php"); 
}
?>