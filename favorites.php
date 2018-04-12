<!--Way to view and modify the contents of user's favorites list-->
<!--remove all and remove individual-->
<!--For the image favorites list, provide a button labeled “Print Favorites”. This button will
display a modal dialog box (see Bootstrap documentation) that contains a form that
allows the user to “order” prints of each image in the favorites (see Print Favorites
Dialog).-->




<?php include 'includes/helper.inc.php'; 
    // error checking for empty and if its anything but a ecpected ISO string 
     session_start();
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

<head>
    <meta charset="utf-8">
    <title>Favorites</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'includes/css-list.php'; ?>
       
    
    
    
    
    
</head>

<body>
 

  
    
    <?php include 'header.inc.php'; ?>
    <main class="container">
        <?php
    $db = new PostGateway($connection);
    $db2 = new ImagesGateway($connection);
       
    ?>
            <div class="row col-md-12">
                <div class="col-md-9">
                    <div class="panel panel-info">
                        <div class="panel-heading">My Favorite Posts <div class='pull-right btn-group' role='group'><a href='favorities-change.php?target=allPost' class='btn btn-default' role='group'>Remove All Posts</a></div></div>
                        
                        <div class="panel-body">
                            <p>
                                <?php
        
                if (!isset($_SESSION['postFavorites']) || empty($_SESSION['postFavorites'][0])) {
                    echo "No favorites have been selected";
                
                }
                else {
                   for($i = 0 ; count($_SESSION['postFavorites']) > $i ; $i++){
                    $id = $_SESSION['postFavorites'][$i];
                    $result = $db->findByIdJoin($id);
                    $row = $result;
                    $img = "images/square-small/" . $row['Path'];
                ?>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <a href="single-image.php?id=<?php echo $row['ImageID'] ?>" class=""><img src="images/square-medium/<?php echo $row['Path'] ?>" alt="<?php echo $row['Title'] ?>" class="img-responsive"/></a>
                                        </div>
                                        <div class="col-md-10">
                                            <h3>
                                                <?php echo $row['Title'] ?>
                                            </h3>
                                            
                                            <br>

                                            </div>
                                            <a href='favorities-change.php?target=post&id=<?php echo "$i"; ?>'  <?php echo "id='post$i'"; ?> class='post btn btn-default' role='group'>Remove</a>
                                            <p class="pull-right"><a href="single-post.php?id=<?php echo $row['PostID'] ?>" class="btn btn-info btn-sm">Read more</a></p>
                                        </div>
                                    
                                    <!-- /.row -->
                                    <hr/>

                                    <br><br>
                                    <?php           
                }      
        }?>
                            </p>
                            </div>

                        </div>
                    </div>
                
                <div class="row">
                    <div class="col-md-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">My Favorite Images<div class=' btn-group' role='group'><a href='favorities-change.php?target=allImg' class='btn btn-default' role='group'>Remove All Images</a></div></div>
                            <div id="image-list" class="panel-body">

                                <?php  
                if (!isset($_SESSION['imageFavorites']) || empty($_SESSION['imageFavorites'][0])) {
                    echo "No favorites have been selected";}
                else {
                    echo "Here are your favorites";
                for($i = 0 ; count($_SESSION['imageFavorites']) > $i ; $i++){
                    echo "<br>";
                    $id2 = $_SESSION['imageFavorites'][$i];
                    $result2 = $db2->findById2($id2, 'ImageID');
                            
                foreach ($result2 as $row2) {
                    $id = $row2['ImageID'];
                    $img = "images/square-medium/" . $row2['Path'];
                    $img2 = "images/square-small/" . $row2['Path'];
                                
                    generateLinkwImg("single-image.php?id=$id", "", "", $img2, $row2['Title'], "image-item img-responsive img-responsive-list");
                    echo "<div style=' display:none; position:fixed;' class='panel panel-info'><div class='panel-heading'>".$row2['Title']."</div><div class='panel-item''><img src='$img'  /></div></div>";
                    echo "<a href='favorities-change.php?target=img&id=$i'  id='image$i' class='image btn btn-default' role='group'>Remove</a>";
                    
                }
                }
            }?>


                            </div>
                        </div>
                        <div class="btn-group" role="group">
                            <button id='printFavorites' type="button" class="btn btn-info" data-toggle="modal" data-target="#printBox">Print Favorites</button>
                        </div>
                        </div>
                        
                        </div>
                        </div>
                        
                    </div>
                </div>
            </div>

            <div id="printBox" class="modal fade" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content col-md-12">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Print Favorites</h4>
                            
                            
                            
                            
                        </div>
                        <div class="modal-body col-md-12">
                            
                        <!-- The basic form structure with each image in the Favorites lists should be populated by PHP.--> 
                        <form id='order' method='post' action ='order.php'>
                            <ul id="orderopt" class="list-inline col-md-10"><li>Size<li><li>Paper<li><li>Frame<li><li>Quantity<li><li>Total<li></ul>
                            <ul id='imglist' class="list-inline">
                                
                            <?php 
                            for($i = 0 ; count($_SESSION['imageFavorites']) > $i ; $i++){
                                echo "<ul id='item$i' class='item list-inline'>";
                                echo "<li>";
                                $id2 = $_SESSION['imageFavorites'][$i];
                                $result2 = $db2->findById2($id2, 'ImageID');
                                        
                            foreach ($result2 as $row2) {
                                $id = $row2['ImageID'];
                                $img = "images/square-medium/" . $row2['Path'];
                                $img2 = "images/square-small/" . $row2['Path'];
                                            
                                generateLinkwImg("single-image.php?id=$id", "", "", $img2, $row2['Title'], "image-item img-responsive");
                                echo "</li>";
                                echo "   
                                <li><select name='size$i' class='size img img".$i."'></select></li>
                                <li><select name='paper$i' class='stock img img".$i."'></select></li>
                                <li><select name='frame$i' class='frame img img".$i."'></select></li>
                                <li><input  name='qty$i' id='qt' value='1' class='quantity img img".$i."' type='text' ></li>
                                <li><div class='total img img".$i."'>$0</div></li></ul><br>";
                                
                               
                                
                                
                                    }
                                }
                            ?>
                           </ul>
                           
                         <div class = 'col-md-6'>  
                        <ul class='shippingContainer list-inline'></ul>
                        <ul class='list-inline '>
                            
                            </div>
                            <div class = 'col-md-6'>  
                        <div id='subtotal-label'>Subtotal</div>
                        <div id='subtotal'>$0</div>
                        <div id='shipping-label'>Shipping</div>
                        <div id='shipping'>$0</div>
                            <hr class="shipline">
                            
                        <div id='grandTotal-label'>GrandTotal</div>
                        <div id='grandTotal'>$0</div>
                         </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                             <input class="btn btn-info" type="submit" value="Order Prints"/>
                             </form> 
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
  <script type="text/JavaScript" src="js/purchase.js"></script>
 
</body>

</html>
