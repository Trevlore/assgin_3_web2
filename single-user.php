<?php include 'includes/helper.inc.php'; 
    // error checking for empty and if its anything but a ecpected ISO string 
    
    if(empty($_GET['id'])){
        header("Location: error.php");
    }
    $result = sqlResult("select UserID from Users group by LastName");
    while ($row = $result->fetch()) {
        $ISOID = $row['UserID'];
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
    <title>Users</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include 'includes/css-list.php'; ?>  
        <script type="text/JavaScript" src="js/image-preview.js"></script>
    
  
</head>

<body>
    <?php include 'header.inc.php'; ?>
    <main class="container">
    <?php
        $id = $_GET['id'];
        $db = new UserGateway($connection);
        $result = $db->findById($id);
        $row = $result;
        // $result = sqlResult("select * from Users join ImageDetails on Users.UserID = ImageDetails.UserID where ImageDetails.UserID = '$id'");
        // $row = $result->fetch();
        ?>
        <div class="row col-md-12">
            <div class="col-md-9">
                <div class="panel panel-info">
                    <div class="panel-heading">User Information</div>
                        <div class="panel-body">
                            <h3><?php echo $row['FirstName'] . " " .$row['LastName'] ?></h3>
                            <p><?php echo $row['Address'] ?></p>
                            <p><?php echo $row['City'] .", ". $row['Postal'] .", ". $row['Country'] ?></p>
                            <p><?php echo $row['Phone'] ?></p>
                            <p><?php echo $row['Email'] ?></p>
                    </div>
                </div>
            </div>    
        <div class="row">
            <div class="col-md-3">
                <div class="panel panel-info">
                    <div class="panel-heading">Images by <?php echo $row['FirstName'] . " " .$row['LastName'] ?></div>
                        <div id="image-list" class="panel-body">
                        <?php  
                            $id = $_GET['id'];
                            $db = new ImagesGateway($connection);
                            $result = $db->findById2($id, "UserID");
                            foreach ($result as $row) {
                                $id = $row['ImageID'];
                                $img = "images/square-medium/" . $row['Path'];
                                $img2 = "images/square-small/" . $row['Path'];
                                
                                generateLinkwImg("single-image.php?id=$id", "", "", $img2, $row['Title'], "image-item img-responsive img-responsive-list");
                                //along with the title of the image 
                                echo "<div style=' display:none; position:fixed;' class='panel panel-info'><div class='panel-heading'>".$row['Title']."</div><div class='panel-item''><img src='$img'  /></div></div>";
                              
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

