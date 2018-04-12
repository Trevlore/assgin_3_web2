<?php
include 'includes/config.php';
$sql = "select * from Users";
$statement = DatabaseHelper::runQuery($connection, $sql, null);

?>

<html>
<body>
<h1>Imprints (using DatabaseHelper)</h1>
<?php
   while ($row = $statement->fetch()) {
        echo $row['UserID'] . ' ' . $row['FirstName'] . '<br>';
   }    
?>
</body>
</html>