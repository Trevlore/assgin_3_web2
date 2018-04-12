<header>

<?php 
session_start();

?>


    <nav class="navbar navbar-default ">
        <div class="">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="">


<div class="topHeaderRow">
            <div class="container">
                <div class="text-center">
                    <ul class="list-inline">
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> <?php if(isset($_SESSION['id'])){echo "Logout";}else{echo "Login";} ?> </a></li>
                        <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Profile </a></li>
                        <li><a href="favorites.php"><span class="glyphicon glyphicon-star"></span> Favorites </a></li>
                        <li><a href="aboutus.php"><span class="glyphicon glyphicon-pencil"></span> About </a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggl " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-th-list"></span> Browse <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="browse-countries.php">Countries</a></li>
                                <li><a href="browse-images.php">Images</a></li>
                                <li><a href="browse-user.php">User</a></li>
                                <li><a href="browse-posts.php">Post</a></li>
                                <li><a href="browse-cities.php">Cities</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>


                <a class="navbar-brand " href="index.php">Share Your Travels</a>
                <form class="navbar-form navbar-left"  action="browse-images.php" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Search">
                </div>
                <a href="browse-images.php?" class="btn btn-info" role="button">Search</a>
            </form>
            </div>
            
        </div>

        
        <!-- end topHeaderRow -->



        <!-- /.navbar-collapse -->


        </div>
        <!-- /.container-fluid -->
    </nav>
    </div>
    </div>
</header>
