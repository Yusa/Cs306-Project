<?php
$adminLogin = "admin";
$mail = $_POST['mail'];
/*if($mail == $adminLogin){
    header("Location:AdminPanel.php");
    exit();

}
else{*/
    require "Query.php";
    Query::connectDatabase();
    $password = $_POST['password'];
    $query = "SELECT *
                FROM USERS
                  WHERE USERS.mail = '$mail' AND USERS.password = '$password'";
    $result = Query::$conn->query($query);
    if(mysqli_num_rows($result) == 0){
        header("Location:indexbad.php");
    }
    
    echo "<script>alert('You have succesfully logged in !');</script>";
    session_start();

    $person =$result->fetch_assoc();
    
    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = "None";
    $_SESSION['isAdmin'] = $person[isAdmin];
 //   $cookie_name = "user";
 //   $cookie_value = "John Doe";
    setcookie("id",$person[id],time()+(86400 * 30),"/");//time() gets the current time in seconds. This time is relative to the start of unix time.
    //For more info https://www.unixtimestamp.com/
    header("Refresh:0; url=index.php"); 
//}

?>