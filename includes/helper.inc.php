<?php
require_once('includes/config.php'); 
    
     /* try {
        $pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "select CountryName from Countries inner join ImageDetails on Countries.ISO = ImageDetails.CountryCodeISO group by CountryName";
        $result = $pdo->query($sql);
        while ($row = $result->fetch()) {
            echo $row['CountryName'] . "<br/>";
        }
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    } */
    
    function sqlResult($sql){
    
    try {
        $pdo = new PDO(DBCONNECTION,DBUSER,DBPASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $pdo->query($sql);
        $pdo = null;
    }
    catch (PDOException $e) {
        die( $e->getMessage() );
    }
    
    return $result;
    }
    
    function generateLink($url, $id, $class, $label) {
    echo "<a  class='$class' href='$url?id=$id' class='$class' > $label </a>";
    }
    
    function generateLinkwImg($url, $class, $label, $img, $alt, $imgClass) {
    echo "<a href='$url' class='$class' ><img src='$img' alt='$alt' class='$imgClass' /> $label </a>";
    }
    
    function generateLinkwImg2($url, $img, $alt, $imgClass) {
    echo "<img href='$url' src='$img' alt='$alt' class='$imgClass' />";
    }
    
    function imgLink($result){
     while ($row = $result) {
        $img = "images/square-medium/" . $row['Path'];
        $imgId = $row['ImageID'];
        generateLinkwImg("single-image.php?imgId=$imgId", "list-group-item", "", $img, $row['Description'], "");

        }
    }
    
    // function imgLink($result){
    //  while ($row = $result->fetch()) {
    //     $img = "images/square-small/" . $row['Path'];
    //     $imgId = $row['ImageID'];
    //     generateLinkwImg("single-image.php?imgId=$imgId", "col-md-1", "", $img, $row['Description'], "");

    //     }
    // }
        
    function imgLink2($row){
        $count = count($row);
        for($i=0; $i < $count; $i++) {
        $img = "images/square-small/" . $row['Path'];
        $imgId = $row['ImageID'];
        generateLinkwImg("single-image.php?imgId=$imgId", "col-md-1", "", $img, $row['Description'], "");

        }
    }
    
    function filterUsed(){
        $filterString;
                if(isset($_GET['continent']) && $_GET['continent'] != "0"){
			       $filterString .= "[Continent = " . $_GET['continent'] . "]";
			    }
			    if(isset($_GET['country']) && $_GET['country'] != "0" ){
			       $filterString .= "[Country = " . $_GET['country'] . "]"; 
			    }
			    if(isset($_GET['city']) && $_GET['city'] != "0"){
			       $filterString .= "[City = " . $_GET['city'] . "]";
			    }
			    if(isset($_GET['title']) && $_GET['title'] != null){
			       $filterString .= "[Title = " . $_GET['title'] . "]"; 
			    }
			    if(!isset($filterString)){$filterString = "[All]";}
			    return "[All]";
    }
    
?>