<?php include 'includes/helper.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Browse User</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    
  <?php include 'includes/css-list.php'; ?>

</head>

<body>
    <?php include 'header.inc.php'; ?>
    <main class="container">  
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading">Users</div> 
                        <div class="panel-body">
                    <?php
                    $db = new UserGateway($connection);
                    $result = $db->findAll('LastName');
                    foreach ($result as $row) {
                        $name = $row['FirstName'] . " " . $row['LastName'];
                        generateLink("single-user.php", $row['UserID'], "col-md-3", $name);
                    }
                    
                    // $result = sqlResult("select FirstName, LastName, UserID from Users group by LastName");
                    // while ($row = $result->fetch()) {
                    //     $name = $row['FirstName'] . " " . $row['LastName'];
                    //     generateLink("single-user.php", $row['UserID'], "col-md-3", $name);
                    // }
                      
                    ?>
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