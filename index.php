<?php include 'includes/helper.inc.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Welcome</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php include 'includes/css-list.php'; ?>

</head>

<body>

    <?php include 'header.inc.php'; ?>
    <main class="container">
    <div class="row">
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <a href='browse-countries.php' class=''><img src="images/misc/home_countries.jpg" alt="bob"></a>
          <div class="caption">
            <h3>Countries</h3>
            <p>See all the countries for which we have images</p>
            <p><a href='browse-countries.php' class='list-group-item' >View Countries </a></p>
          </div>
        </div>
      </div>
       <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <a href='browse-images.php' class=''><img src="images/misc/home_images.jpg" alt="bob"></a>
          <div class="caption">
            <h3>Images</h3>
            <p>See all the travel images that we have collected. </p>
            <p><a href='browse-images.php' class='list-group-item' >View Images </a></p>
          </div>
        </div>
      </div>
       <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <a href='browse-user.php' class=''><img src="images/misc/home_users.jpg" alt="bob"></a>
          <div class="caption">
            <h3>Users</h3>
            <p>See information about our contributoning users.</p>
            <p><a href='browse-user.php' class='list-group-item' >View Users </a></p>
          </div>
        </div>
      </div>
         <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <a href='browse-posts.php' class=''><img src="images/misc/222223.jpg" alt="bob"></a>
          <div class="caption">
            <h3>Posts</h3>
            <p>Browse through our users posts.</p>
            <p><a href='browse-posts.php' class='list-group-item' >View Posts </a></p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4">
        <div class="thumbnail">
          <a href='browse-cities.php' class=''><img src="images/misc/9494282329.jpg" alt="bob"></a>
          <div class="caption">
            <h3>Cities</h3>
            <p>Browse through our Cities.</p>
            <p><a href='browse-posts.php' class='list-group-item' >View Cities </a></p>
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