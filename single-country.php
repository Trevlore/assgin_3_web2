<?php include 'includes/helper.inc.php'; 
    // error checking for empty and if its anything but a ecpected ISO string 
    
    if(empty($_GET['id'])){
        header("Location: error.php");
    }
    $result = sqlResult("SELECT ISO FROM Countries INNER JOIN ImageDetails ON Countries.ISO = ImageDetails.CountryCodeISO GROUP BY CountryName");
    while ($row = $result->fetch()) {
        $ISOID = $row['ISO'];
        if($_GET['id'] == $ISOID){
            break;
        }
    }
    
    if($_GET['id'] != $ISOID){ 
        header("Location: error.php");
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Countries</title>

   <meta name="viewport" content="width=device-width, initial-scale=1">
   <?php include 'includes/css-list.php'; ?>
   <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/JavaScript" src="js/image-preview.js"></script>
    
   
</head>

<body>
    <?php include 'header.inc.php'; ?>
    <main class="container">
    <?php 
    $id = $_GET['id'];
    $db = new CountriesGateway($connection);
    $result = $db->findById($id);
    $row = $result;
    // $result = sqlResult("select CountryName, Area, Capital, Population, CurrencyName, CountryDescription from Countries where ISO = '$id'");
    // $row = $result->fetch();
    ?>
    <div class="row col-md-12">
            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-heading">Country Information</div>
                        <div class="panel-body">
                            <h3><?php echo $row['CountryName'] ?></h3>
                            <p>Capital: <b><?php echo $row['Capital'] ?></b></p>
                            <p>Area: <b><?php echo number_format($row['Area']) ?> </b>sq km.</p>
                            <p>Population: <b><?php echo number_format($row['Population']) ?></b></p>
                            <p>Currency Name: <b><?php echo $row['CurrencyName'] ?></b></p>
                            <p><?php echo $row['CountryDescription'] ?></p>

                                      <?php
                                        $id2 = $_GET['id'];
                                        $db2 = new ImagesGateway($connection);
                                        $result2 = $db2->findById2($id2, "CountryCodeISO"); 
                                        
                                        $markers = '';
                                        
                                        foreach ($result2 as $row2) {
                                            $markers = $markers . $row2['Latitude'] . "," . $row2['Longitude'] . "|";
                                        }
                                        
                                        $co = $row['CountryName'];
                                        
                                        //$co = str_replace('1', '', $co);
                                        
                                        
                                        
                                        echo "<img class='img-responsive' src='https://maps.googleapis.com/maps/api/staticmap?center={$co}&size=640x400&maptype=roadmap
                                        &markers=color:red%7C{$markers}&key=AIzaSyBnv-h0YuKzwpaPoCoMiM64xb__MfPRWo4'>";
                                        ?>
         
                    </div>
                    
                    
                </div>
            </div>    
            <div class="row">
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">Images from <?php echo $row['CountryName'] ?> </div>
                        <div id="imgList" class="panel-body">
                        <?php
                        $id = $_GET['id'];
                        $db = new ImagesGateway($connection);
                        $result = $db->findById2($id, "CountryCodeISO");
                        foreach ($result as $row) {
                            $id = $row['ImageID'];
                          $img = "images/square-medium/" . $row['Path'];
                                $img2 = "images/square-small/" . $row['Path'];
                                
                                generateLinkwImg("single-image.php?id=$id", "", "", $img2, $row['Title'], "image-item img-responsive img-responsive-list");
                                //along with the title of the image 
                                echo "<div style=' display:none; position:fixed;' class='panel panel-info'>
                                <div class='panel-heading'>".$row['Title']."</div>
                                <div class='panel-item''><img src='$img'  /></div>
                                </div>";
                         }
                        
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        </main>    

<footer>
        <div class="container-fluid">
                    <div class="row final">
                <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
                <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
            </div>            
        </div>
        

    </footer>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>