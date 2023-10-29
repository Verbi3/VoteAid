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

$State = mysqli_real_escape_string($dbc,$_GET['State']);
$ZipCode = mysqli_real_escape_string($dbc,$_GET['ZipCode']);

$result = mysqli_query($dbc, "SHOW COLUMNS FROM $table");
$numberOfRows = mysqli_num_rows($result);
$csv_output = '';
if ($numberOfRows > 0) {

    $values = mysqli_query($dbc, "SELECT * FROM $table WHERE State='$State' AND ZipCodes LIKE '%$ZipCode%' ORDER BY CreatedAt DESC LIMIT 1");
    while ($rowr = mysqli_fetch_row($values)) {
        for ($j=0;$j<$numberOfRows;$j++) {
            $csv_output .= str_replace(',', '[COMMA]', $rowr[$j]).", ";
        }
        $csv_output .= "\n";
    }
}

print $csv_output;
exit;

?>