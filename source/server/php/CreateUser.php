<?php
$server= "localhost"; /* Address of the IONOS Database servers */
$user= "id21372879_admin"; /* Database Username */
$password= "P@ssw0rd"; /* Password */
$database= "id21372879_voteaiddatabase"; /* Name of the Database */
$table= "User"; /* Name of the table, can be freely chosen */

/* Access SQL Server and create the table */
$dbc = mysqli_connect($server,$user,$password);
if (!$dbc) {
    die("Database connection failed: " . mysqli_error($dbc));
    exit();
}

$dbs = mysqli_select_db($dbc, $database);
if (!$dbs) {
    die("Database selection failed: " . mysqli_error($dbc));
    exit();
}

$FirstName = mysqli_real_escape_string($dbc, $_GET['FirstName']);
$LastName = mysqli_real_escape_string($dbc,$_GET['LastName']);
$Street = mysqli_real_escape_string($dbc,$_GET['Street']);
$City = mysqli_real_escape_string($dbc,$_GET['City']);
$State = mysqli_real_escape_string($dbc,$_GET['State']);
$ZipCode = mysqli_real_escape_string($dbc,$_GET['ZipCode']);
$Email = mysqli_real_escape_string($dbc,$_GET['Email']);
$Mobile = mysqli_real_escape_string($dbc,$_GET['Mobile']);
$Password = mysqli_real_escape_string($dbc,$_GET['Password']);


$query = "INSERT INTO $table (FirstName, LastName, Street, City, State, ZipCode, Email, Mobile, Password) VALUES ('$FirstName', '$LastName', '$Street', '$City', '$State', '$ZipCode', '$Email', '$Mobile', '$Password')";

$result = mysqli_query($dbc, $query) or trigger_error("Query MySQL Error: " . mysqli_error($dbc)); 

mysqli_close($dbc); 

?>