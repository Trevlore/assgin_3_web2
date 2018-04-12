<?php
$rules = file_get_contents('printRules.json');
header("Content-Type: application/json");
echo($rules);
?>