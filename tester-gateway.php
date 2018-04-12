<?php

include 'includes/config.php';

?>

<html>
<body>

<?php


  echo '<hr>';
  $db = new CountriesGateway($connection);
  // $result = $db->findById(11);
  // echo '<h3>Sample User (id=11)</h3>';
  // echo $result['UserID'] . ' ' . $result['FirstName'] . ' ' . $result['LastName'] . ' ' . $result['Country'];
  $result = $db->joinGroupBy();
  echo '<h3>All Users</h3>';    
  foreach ($result as $row) {   
    echo $row['ISO'] . ' ' . $row['CountryName'] . ', ';      
  }
  echo '<h3>Testing</h3>';
  echo $result = $db->printbob();

?>
</body>
</html>