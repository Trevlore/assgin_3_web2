<?php 
// this page takes the query string and loads a page.
session_start();

?>

<?php include 'includes/helper.inc.php'; 
    
    $json = file_get_contents('includes/printRules.json');
    $rulesObj = json_decode($json,true );
    // error checking for empty and if its anything but a ecpected ISO string 
     if(!isset($_SESSION['id'])){
 header("Location: login.php");
    }
    $result = sqlResult("select UserID from Users group by LastName");
    while ($row = $result->fetch()) {
        $ISOID = $row['UserID'];
        if($_SESSION['userName'] == $ISOID){
            break;
        }
    }


    
?>
<!DOCTYPE html>
<html lang="en">
<?php $db2 = new ImagesGateway($connection); ?>

<head>
    <meta charset="utf-8">
    <title>Order Summary</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'includes/css-list.php'; ?>
</head>

<body>
    <?php include 'header.inc.php'; ?>

    <main class="container">

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-info">
                    <div class="panel-heading">Order Summary</div>
                    <div id="image-list" class="panel-body">
                    <ul id="orderopt" class="list-inline col-md-10"><li>Size<li><li>Paper<li><li>Frame<li><li>Quantity<li></ul>
                        <?php  
                        if (!isset($_SESSION['imageFavorites']) || empty($_SESSION['imageFavorites'][0])) {
                        echo "No Order";}
                        else {
                    
                for($i = 0 ; count($_SESSION['imageFavorites']) > $i ; $i++){
                    echo "<br>";
                    $id2 = $_SESSION['imageFavorites'][$i];
                    $result2 = $db2->findById2($id2, 'ImageID');
                            
                foreach ($result2 as $row2) {
                    $id = $row2['ImageID'];
                    $img = "images/square-medium/" . $row2['Path'];
                    $img2 = "images/square-small/" . $row2['Path'];
                    echo "<ul id='sumList' class='list-inline'>";
                    
                    generateLinkwImg("single-image.php?id=$id", "", "", $img2, $row2['Title'], "image-item img-responsive img-responsive-list");
                    echo "<div style=' display:none; position:fixed;' class='panel panel-info'><div class='panel-heading'>".$row2['Title']."</div><div class='panel-item''><img src='$img'  /></div></div>";
                    
                    
                 
                }
                $shipping;
                 echo  $rulesObj->sizes;      
                foreach ( $rulesObj as $key => $value ) {  
                    if($key == 'sizes'){echo '<li>'.$value[$_POST["size$i"]]['name'].'</li>';}
                    if($key == 'stock'){echo '<li>'.$value[$_POST["paper$i"]]['name'].'</li>';}
                    if($key == 'frame'){echo '<li>'.$value[$_POST["frame$i"]]['name'].'</li>';}
                    if($key == 'shipping'){$shipping = $value[$_POST["shippingType"]]['name'];}
                    
                    
                  
                  
                }
                echo'<li>'.$_POST['qty'.$i].'</li>';
                echo '</ul>';
               
                
                }

                 echo "<div class='pull-right'><strong>".$shipping." Shipping</strong></div>";
                   }?>
            
            


                    </div>
                </div>
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
    <script type="text/JavaScript" src="js/image-preview.js"></script>
    <script type="text/JavaScript" src="js/purchase.js"></script>
</body>

</html>
