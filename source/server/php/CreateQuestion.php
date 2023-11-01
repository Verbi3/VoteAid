<?php
$server= "localhost"; /* Address of the IONOS Database servers */
$user= "id21372879_admin"; /* Database Username */
$password= "P@ssw0rd"; /* Password */
$database= "id21372879_voteaiddatabase"; /* Name of the Database */
$table= "Question"; /* Name of the table, can be freely chosen */

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
$Question = mysqli_real_escape_string($dbc, $_GET['Question']);
$UserId = mysqli_real_escape_string($dbc, $_GET['UserId']);
$ForCandidate = mysqli_real_escape_string($dbc, $_GET['ForCandidate']);

$query = "INSERT INTO $table (ElectionId, Question, UserId, CreatedAt, ForCandidate) VALUES ('$ElectionId', '$Question', '$UserId', NOW(), '$ForCandidate' )";

$result = mysqli_query($dbc, $query) or trigger_error("Query MySQL Error: " . mysqli_error($dbc)); 

mysqli_close($dbc); 

?>