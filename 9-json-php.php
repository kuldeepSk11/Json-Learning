<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Narrative</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
   
</head>

<style>
    body{padding: 4%;}
</style>

<body>
    
    <h1>JSON PHP</h1>
    <ul>
      <li>A common use of JSON is to read data from a web server, and display the data in a web page.</li>
      <li>his chapter will teach you how to exchange JSON data between the client and a PHP server.</li>
    </ul>
    
    <hr>
    
    <h3>The PHP File</h3>
    <p>PHP has some built-in functions to handle JSON.</p>
    <p>Objects in PHP can be converted into JSON by using the PHP function json_encode():</p>
    
    <br>

    <?php
    $myObj->name = "John";
    $myObj->age = 30;
    $myObj->city = "New York";

    $myJSON = json_encode($myObj);

    echo $myJSON;
    ?>
    
   <hr>
   
   <h2>The Client JavaScript</h2>
    <p>Here is a JavaScript on the client, using an AJAX call to request the PHP file from the example above:</p>
<h2>Get data as JSON from a PHP file on the server.</h2>

<p id="demo"></p>

<script>

var xmlhttp = new XMLHttpRequest();

xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        document.getElementById("demo").innerHTML = myObj.name;
    }
};
xmlhttp.open("GET", "demo_file_array.php", true);
xmlhttp.send();

</script>

       <hr>
       
       
       <h2>PHP Array</h2>
        <p>Arrays in PHP will also be converted into JSON when using the PHP function json_encode():</p>

        <?php
        $myArr = array("John", "Mary", "Peter", "Sally");

        $myJSON = json_encode($myArr);

        echo $myJSON;
        ?>

       
     <hr>
    
      <h3>The Client JavaScript</h3>
    <p>Here is a JavaScript on the client, using an AJAX call to request the PHP file from the array example above:</p>


    <h2>Get data as JSON from a PHP file, and convert it into a JavaScript array.</h2>

    <p id="demo1"></p>

    <script>

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            document.getElementById("demo1").innerHTML = myObj.name;
        }
    };
    xmlhttp.open("GET", "demo_file_array.php", true);
    xmlhttp.send();

    </script>


    
    <hr>
    
    <h3>PHP Database</h3>
    <p>PHP is a server side programming language, and should be used for operations that can only be performed by a server, like accessing a database.<br>

Imagine you have a database on the server, containing customers, products, and suppliers.<br>

You want to make a request to the server where you ask for the first 10 records in the "customers" table:</p>
    
    
<h2>Get data as JSON from a PHP file on the server.</h2>

<p>The JSON received from the PHP file:</p>

<p id="demo3"></p>

<script>
var obj, dbParam, xmlhttp;
obj = { "table":"customers", "limit":10 };
dbParam = JSON.stringify(obj);
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("demo3").innerHTML = this.responseText;
    }
};
xmlhttp.open("GET", "json_demo_db.php?x=" + dbParam, true);
xmlhttp.send();

</script>
  <br>
   <h3>Example explained:</h3>
   <ul>
  <li>Define an object containing a table property and a limit property.</li>
  <li>Convert the object into a JSON string.</li>
  <li>Send a request to the PHP file, with the JSON string as a parameter.<br></li>
  <li>Wait until the request returns with the result (as JSON)</li>
  <li>Display the result received from the PHP file.</li>
</ul>

<?php
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_GET["x"], false);

$conn = new mysqli("myServer", "myUser", "myPassword", "Northwind");
$result = $conn->query("SELECT name FROM ".$obj->table." LIMIT ".$obj->limit);
$outp = array();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);
?>

<hr>

<h3>PHP File explained:</h3>
<ul>
  <li>Convert the request into an object, using the PHP function
  <span class="w3-codespan">json_decode()</span>.</li>
  <li>Access the database, and fill an array with the requested data.</li>
  <li>Add the array to an object, and return the object as JSON using 
the <span class="w3-codespan">json_encode()</span> function.</li>
</ul>

<br>

<h3>Loop Through the Result</h3>
<p>Convert the result received from the PHP file into a JavaScript object, or in this case, a JavaScript array:</p>


<h2>Get data as JSON from a PHP file on the server.</h2>

<p id="demo4"></p>

<script>
var obj, dbParam, xmlhttp, myObj, x, txt = "";
obj = { "table":"customers", "limit":10 };
dbParam = JSON.stringify(obj);
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        for (x in myObj) {
            txt += myObj[x].name + "<br>";
        }
        document.getElementById("demo4").innerHTML = txt;
    }
};
xmlhttp.open("GET", "json_demo_db.php?x=" + dbParam, true);
xmlhttp.send();

</script>

<p>Try changing the "table" property from "customers" to "products".</p>

<hr>

<h3>PHP Method = POST</h3>
<p>When sending data to the server, it is often best to use the HTTP POST method.</p>
<p>To send AJAX requests using the POST method, specify the method, and the correct header.</p>
<p>The data sent to the server must now be an argument to the .send() method:</p>


<h2>Use the HTTP method POST to send data to the PHP file.</h2>

<p id="demo5"></p>

<script>
var obj, dbParam, xmlhttp, myObj, x, txt = "";
obj = { "table":"customers", "limit":10 };
dbParam = JSON.stringify(obj);
xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        myObj = JSON.parse(this.responseText);
        for (x in myObj) {
            txt += myObj[x].name + "<br>";
        }
        document.getElementById("demo5").innerHTML = txt;
    }
};
xmlhttp.open("POST", "json_demo_db_post.php", true);
xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xmlhttp.send("x=" + dbParam);

</script>

<p>Try changing the "table" property from "customers" to "products".</p>
<p>The only difference in the PHP file is the method for getting the transferred data.</p>

<hr>

<h3>PHP file</h3>
<p>Use $_POST instead of $_GET:</p>

<?php
header("Content-Type: application/json; charset=UTF-8");
$obj = json_decode($_POST["x"], false);

$conn = new mysqli("myServer", "myUser", "myPassword", "Northwind");
$result = $conn->query("SELECT name FROM ".$obj->table." LIMIT ".$obj->limit);
$outp = array();
$outp = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($outp);
?>


   
    
    <script src="js/jquery.min.js"></script> 
    <script src="js/bootstrap.min.js"></script> 
    
        
<script>

            
    </script>
 
</body>
</html>