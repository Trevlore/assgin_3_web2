<?php include 'includes/helper.inc.php'; ?>
<?php
    session_start();
    
    if (isset($_SESSION['id'])){
       header("Location: index.php");}
       else{
        
      
        //if both username and password exist.
        if(isset($_POST['username']) && !empty($_POST['username']) &&
        isset($_POST['password']) && !empty($_POST['password'])){
          
            $username = $_POST['username'];
            $db = new UsersLoginGateway($connection); 
            $key = $db->getPrimaryKeyName();
            $result = $db->getUserName2($username,$key);
            
            
            $password = $_POST[password].$result[2];
            $password = MD5($password);
            $hash = $result[1];
            
            if($username == $result[0]){
                
                if($password === $hash){
                
                $_SESSION['id'] = $result[3];
                header("Location: login.php");
                }
                else{header("Location: login.php?error=Incorrect username or password.");exit();}
                
        }else{header("Location: login.php?error=Incorrect username or password");exit();}
        }elseif(isset($_POST['username']) && empty($_POST['username']) ||
        isset($_POST['password']) && empty($_POST['password'])){
            header("Location: login.php?error=Missing username or password");exit();}
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php include 'includes/css-list.php'; ?>  
    <script type="text/JavaScript" src="js/image-preview.js"></script>
    <script type="text/JavaScript" src="js/error.js"></script>
    
  
</head>

<body>
    <?php include 'header.inc.php'; ?>
    <main class="container">
    
        <div class="row col-md-12">
            <div class="col-md-9">
                <div  id='login' class="panel panel-info">
                    <div class="panel-heading">Login
                    <?php if(isset($_GET['error']) && !empty($_GET['error'])){
                    echo "<div id='error'>ERROR ".$_GET['error']."</div>";} ?>
                    </div>
                        <div class="panel-body">
                        <form method='post' action = 'login.php'>
                            <input class="form-control" type="text" name="username" placeholder="Username"/><br>
                            <input class="form-control" type="password" name="password" placeholder="Password"/><br>
                            <input class="btn btn-info" type="submit"/>
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
</body>

</html>

