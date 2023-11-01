<?php
$server= "localhost"; /* Address of the IONOS Database servers */
$user= "id21372879_admin"; /* Database Username */
$password= "P@ssw0rd"; /* Password */
$database= "id21372879_voteaiddatabase"; /* Name of the Database */
$table= "Questionnaire"; /* Name of the table, can be freely chosen */

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

$ElectionId = mysqli_real_escape_string($dbc, $_GET['ElectionId']);
$Questions = mysqli_real_escape_string($dbc, $_GET['Questions']);
$State = mysqli_real_escape_string($dbc, $_GET['State']);
$ZipCodes = mysqli_real_escape_string($dbc, $_GET['ZipCodes']);

$query = "INSERT INTO $table (ElectionId, CreatedAt, Questions, State, ZipCodes) VALUES ('$ElectionId', NOW(), '$Questions', '$State', '$ZipCodes')";

$result = mysqli_query($dbc, $query) or trigger_error("Query MySQL Error: " . mysqli_error($dbc)); 

mysqli_close($dbc); 

?>