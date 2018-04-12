<?php include 'includes/helper.inc.php';  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Cities</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include 'includes/css-list.php'; ?>  
     <script type="text/JavaScript" src="js/image-preview.js"></script>
    
  
</head>

<body>
    <?php include 'header.inc.php'; ?>
    <main class="container">
    <?php
        $id = $_GET['id'];
        $db = new CitiesGateway($connection);
        $result = $db->findById($id);
        $row = $result;
        // $result = sqlResult("select * from Users join ImageDetails on Users.UserID = ImageDetails.UserID where ImageDetails.UserID = '$id'");
        // $row = $result->fetch();
        ?>
        <div class="row col-md-12">
            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-heading">City Information</div>
                        <div class="panel-body">
                            <h3><?php echo $row['AsciiName'] ?></h3>
                            <p>Population: <b><?php echo number_format($row['Population']) ?></b></p>
                            <p>Elevation: <b><?php echo number_format($row['Elevation']) ?> </b> km.</p>
                            <p>Time Zone: <b><?php echo $row['TimeZone'] ?></b></p>
                            

                          <!--add map-->
                          
                          <?php
                          
                          
                          $latlng = $result['Latitude'] . "," . $result['Longitude'];
                          $co = $result['AsciiName'];
                          
                          //$co = str_replace('1', '', $co);
                          
                          
                          echo "<img src='https://maps.googleapis.com/maps/api/staticmap?zoom=5&center={$co}&size=640x400&maptype=roadmap
                          &markers=color:red%7C{$latlng}&key=AIzaSyBnv-h0YuKzwpaPoCoMiM64xb__MfPRWo4'>";
                         
                          ?>

                    </div>
                </div>
            </div>    
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">Images From <?php echo $row['AsciiName'] ?></div>
                        <div id="imgList" class="panel-body">
                        <?php  
                            $id = $_GET['id'];
                            $db = new ImagesGateway($connection);
                            $result = $db->findById2($id, "CityCode");
                            foreach ($result as $row) {
                                $id = $row['ImageID'];
                                $img = "images/square-medium/" . $row['Path'];
                                $img2 = "images/square-small/" . $row['Path'];
                                
                                generateLinkwImg("single-image.php?id=$id", "", "", $img2, $row['Title'], "image-item img-responsive img-responsive-list");
                                //along with the title of the image 
                                echo "<div style=' display:none; position:fixed;' class='panel panel-info'><div class='panel-heading'>".$row['Title']."</div><div class='panel-item''><img src='$img'  /></div></div>";
                            }
                        // $result = sqlResult("select * from ImageDetails where UserID = '$id'");
                        // imgLink($result);
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