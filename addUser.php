<?php
	
    require "Query.php";
    Query::connectDatabase();
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];

if(empty($_POST['name']) || empty($_POST['password']) ||  empty($_POST['mail'])   )
	{
		echo "<script>alert('You have an empty field.');</script>";
    	header("Refresh:0; url=register.php");   // go back to the register page
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
	    $query = "INSERT INTO USERS (password, mail , name) VALUES ('$password', '$mail', '$name')";
		if (Query::$conn->query($query) === TRUE) {
			echo "<script>alert('You have successfully registered!');</script>";
		} else {
    		echo "<script>alert('error');</script>";
		}
		}
	    header("Refresh:0; url=index.php"); 
}
?>