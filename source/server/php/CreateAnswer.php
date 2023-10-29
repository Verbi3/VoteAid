<?php
$server= "localhost"; /* Address of the IONOS Database servers */
$user= "id21372879_admin"; /* Database Username */
$password= "P@ssw0rd"; /* Password */
$database= "id21372879_voteaiddatabase"; /* Name of the Database */
$table= "Answer"; /* Name of the table, can be freely chosen */

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
$CandidateId = mysqli_real_escape_string($dbc, $_GET['CandidateId']);
$QuestionnaireId = mysqli_real_escape_string($dbc, $_GET['QuestionnaireId']);
$Question = mysqli_real_escape_string($dbc, $_GET['Question']);
$Answer = mysqli_real_escape_string($dbc, $_GET['Answer']);
$Comment = mysqli_real_escape_string($dbc, $_GET['Comment']);

$query = "INSERT INTO $table (ElectionId, CandidateId, QuestionnaireId, Question, Answer, Comment) VALUES ('$ElectionId', '$CandidateId', '$QuestionnaireId', '$Question','$Answer', '$Comment')";

$result = mysqli_query($dbc, $query) or trigger_error("Query MySQL Error: " . mysqli_error($dbc)); 

mysqli_close($dbc); 

?>