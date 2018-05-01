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
    $query = "SELECT USERS.id
                FROM USERS
                  WHERE USERS.mail = '$mail' AND USERS.password = '$password'";
    $result = Query::$conn->query($query);
    if(mysqli_num_rows($result) == 0){
        header("Location:indexbad.php");
        exit();
    }
    session_start();

    $person =$result->fetch_assoc();

    $_SESSION['valid'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = "None";

    setcookie("id",$person["id"],time()+COOKIE_LEN,"/");//time() gets the current time in seconds. This time is relative to the start of unix time.
    //For more info https://www.unixtimestamp.com/
    header("Location:index.php");
//}

?>