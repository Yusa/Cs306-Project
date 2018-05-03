<?php
define("COOKIE_LEN",600);//this defines a constant for cookie length (in seconds)
class Query
{
   public static $conn;

   public static function connectDatabase(){
        $myfile = fopen("creds.txt", "r");

        if(!self::$conn){//check if you are already connected to database
            $servername = "localhost";
            $username = "root";
            $password = fgets($myfile);
            $dbname = "SHOPDB";
            // Create connection
            self::$conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if (self::$conn->connect_error) {
                echo "Can't connect to database";
                exit();
            }
        }
        fclose($myfile);
    }

    public static function loginCheck(){
        if(!isset($_COOKIE['id'])){//check here if there is a cookie with 'id' which indicates that client has already logged in
            //if not set then exit
            echo "You are not logged in. Please log in first<br>";
            echo "<a href='Login.php'>Log in page </a>";
            exit();
        }
        else {
            $id = $_COOKIE['id'];
            $query = "SELECT *
                        FROM persons
                          WHERE persons.id = $id";
            $result = self::$conn->query($query);
            if(mysqli_num_rows($result)==0){
                echo "You have created a cookie with an id which is not in our database. If you are trying to cheat do it right :)<br>";
                echo "<a href='Login.php'>Log in page </a>";
                exit();
            }
        }
    }

    public static function getTable($tableName){
        $query = "SELECT *
                    FROM $tableName";
        $result = self::$conn->query($query);
        $fields = mysqli_fetch_fields($result);
        echo "<table>";
        echo "<tr>";
        foreach($fields as $field){
            echo "<th>$field->name</th>";
        }
        echo "</tr>";
        while($row = $result->fetch_assoc()){
            echo "<tr>";
            foreach($fields as $field){
                $data = $row[$field->name];
                echo "<td>$data</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    public static function tablePopulator($tableName){
        $query = "DESCRIBE $tableName";//to get the only the table information without getting all the rows.Run this query in phpmyadmin to understand whats going on.
        //for example run 'DESCRIBE persons'
        $result = self::$conn->query($query);
        echo "<form action='SubmitForm.php' method='post'>";//starting of the submit form
        echo "<input type='hidden' name='tableName' value=$tableName >";//hidden attributed elements is not shown
        while($row = $result->fetch_assoc()) {
            $fieldName = $row["Field"];
            if ($fieldName != "id") {
                echo "<a>$fieldName</a><br>";
                if($fieldName == "password"){
                    echo "<input type='password' name=$fieldName><br>";
                }
                else{
                    echo "<input type=\"text\" name=$fieldName><br>";
                }

            }
        }
        echo "<input type=\"submit\" value=\"Create\">";
        echo "</form>";
    }

    public static function addRow($tableName,$columns,$dataList){
        $query = "INSERT INTO `$tableName`";
        $query = $query."(";
        foreach($columns as $column){
            $query = $query."$column".",";
        }
        $query = substr($query,0,-1);
        $query = $query.")";
        $query = $query."VALUES";
        $query = $query."(";
        foreach($dataList as $data){
            $query = $query."'$data'".",";
        }
        $query = substr($query,0,-1);
        $query = $query.")";
        $result = self::$conn->query($query);
        return $result;
    }

    public static function newOrder(){
        $query = "SELECT *
                    FROM products
                      ORDER BY products.name";
        $result = self::$conn->query($query);
        echo "<form action='PlaceOrder.php' method='post'>";
        echo "<table><tr><th>Name</th><th>Price</th><th>Amount</th></tr>";
        $i = 0;
        while($row = $result->fetch_assoc()){
            $productId = $row['id'];
            $productName = $row['name'];
            $productPrice = $row['price'];
            echo "<input type='hidden' name='id$i' value=$productId>";
            echo "<input type='hidden' name='price$i' value=$productPrice>";
            echo "<tr><td>$productName</td><td>$productPrice</td><td><input type='text' name='quantity$i' value='0'></td></tr>";
            echo "<br>";
            $i++;
        }
        echo"</table>";
        echo "<input type='hidden' name='numItems' value=$i>";//we will need this information in PlaceOrder.php because we need to know how many products
        echo "<input type=\"submit\" value=\"Place Order\">";
        echo "</form>";

    }

    public static function listOrders(){

        $id = $_COOKIE['id'];
        echo "<table>";
        echo "<tr><th>Order Number</th><th>Price Paid</th><th>Issue Date</th></tr>";
        $query = "SELECT *
                    FROM orders
                      WHERE orders.person_id=$id";//get all the orders that this person has ordered
        $result = self::$conn->query($query);
        $i = 1; // variable that will hold the order number
        while($row = $result->fetch_assoc()){
            $orderId = $row['id'];
            $amountPaid = $row['amount_paid'];
            $issueDate = $row['issue_date'];
            echo "<tr>";//'li' stands for list item
            echo "<td>$i<br><a href='DisplayOrder.php?orderid=$orderId'>Click</a> </td>";
            echo "<td>$amountPaid</td>";
            echo "<td>$issueDate</td>";
            echo "</tr>";
            $i++;
        }
        echo"</table>";
    }

    public static function displayOrder($id){
        $query = "SELECT products.name as name,orders_products.quantity as quantity
                    FROM products,orders_products
                      WHERE orders_products.order_id = $id AND orders_products.product_id = products.id";
        $result = self::$conn->query($query);
        echo "<table>";
        echo "<tr><th>Name</th><th>Quantity</th></tr>";
        while ($row = $result->fetch_assoc()){
            echo "<tr>";
            echo "<td>".$row['name']."</td><td>".$row['quantity']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}