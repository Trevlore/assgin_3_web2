<?php include 'includes/helper.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Browse Images</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include 'includes/css-list.php'; ?>
     


</head>

<body>
    <?php include 'header.inc.php'; ?>
        <main class="container">
        <div class="panel panel-default">
          
          <div class="panel-heading">Filters</div>
          
          
          <div class="panel-body">
            <!--<form action="browse-images.php" method="get" class="form-horizontal">-->
              <div class="form-inline">
              <select id="continent" name="continent" class="form-control">
                <option value="0">Select Continent</option>
                <?php /* display list of continents */
                     $db = new ContinentsGateway($connection);
                        $result = $db->joinGroupBy();
                        foreach ($result as $row) {
                        
                    // $result = sqlResult("select Continents.ContinentCode, ContinentName from Continents join ImageDetails on Continents.ContinentCode = ImageDetails.ContinentCode group by ContinentName");
                    // while ($row = $result->fetch()) {
                ?>
                         "<option value=<?php echo $row['ContinentCode'] ?>> <?php echo $row['ContinentName']?></option>
                   <?php } ?>
              </select>     
              <select id="country" name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php /* display list of continents */
                  $db = new CountriesGateway($connection);
                  $result = $db->joinGroupBy();
                  foreach ($result as $row) {
                    // generateLink("single-country.php", $row['ISO'], "list-group-item", $row['CountryName']);
                  
                    // $result = sqlResult("select ISO, CountryName from Countries join ImageDetails on ISO = CountryCodeISO group by CountryName");
                    // while ($row = $result->fetch()) {
                ?>
                         "<option value=<?php echo $row['ISO'] ?>> <?php echo $row['CountryName']?></option>
                   <?php } ?>
              </select> 
              <select id="city" name="city" class="form-control">
                <option value="0">Select City</option>
                
                
                <?php /* display list of continents */
                    $db = new CitiesGateway($connection);
                    $result = $db->joinGroupBy();
                    foreach ($result as $row) {
                    // $result = sqlResult("select Cities.CityCode, AsciiName from Cities join ImageDetails on Cities.CityCode = ImageDetails.CityCode group by AsciiName");
                    // while ($row = $result->fetch()) {
                ?>
                         "<option value=<?php echo $row['CityCode'] ?>> <?php echo $row['AsciiName']?></option>
                   <?php } ?>
              </select> 
              <input id="search" type="text" placeholder="Search Title" class="form-control" name=title>
              
              <!--<button href="browse-images.php" type="clear" class="btn btn-default">Clear</button>-->
              <a href="browse-images.php" class="btn btn-info" role="button">Clear</a>
              </div>
            <!--</form>-->

          </div>
        </div>     
                                    
    <div class="panel panel-info">
      <div class="panel-heading">Images <?php echo filterUsed() ?></div>
        <div class="panel-body">
		      <ul class="caption-style-2">
			    <?php
			    $db = new ImagesGateway($connection);
			    if(isset($_GET['search']) && !empty($_GET['search'])) {
			    $result = $db->filterSearchBar($_GET['search']);
			    }
			    else {
			    $result = $db->filter2();
			    }
			    
			    foreach ($result as $row) {
			   
			   
			   // $sqlQuerry = filter();
      //           $result = sqlResult($sqlQuerry);
      //           while ($row = $result->fetch()) {
                ?>
                <li class='<?php echo $row['ContinentCode']; echo " ".$row['CountryCodeISO']; echo " ".$row['CityCode']; ?>'>
                    <a href=single-image.php?id=<?php echo $row['ImageID']; ?> class=img-responsive-small >
                     <img src=images/square-medium/<?php echo $row['Path']; ?> alt= <?php echo $row['Title']; ?> >
                          <div class="caption">
                            <div class="blur"></div>
                              <div class="caption-text">
                                  <p> <?php echo $row['Title']; ?> </p>
                              </div>
                          </div>
                  </a>
			  </li>        
            <?php } ?> 
       </ul>       
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
 <script type="text/javascript" src="js/image-filter.js"></script>
</html>