<!DOCTYPE html>
<html>
<head>
	<title>Assignment3</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/styles.css">
  <?php 
  date_default_timezone_set("America/Halifax");
  ?>

</head>
<body>

  <?php 
  function checkActiveClass($requestUri){

    $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

    if ($current_file_name == $requestUri)
      echo 'class="active"';
  }
  ?>




  <?php 

  $loggedIn = false;
  $loginError = false;

  if(isset($_POST['submit'])) {
    $name = ($_POST['uname']);
    $password = ($_POST['psw']);

    $passwords = fopen('C:\MAMP\htdocs\A2\db\users.txt', "r") or die("unable to open file");
    while(!feof($passwords)){

      $theThreeThings = fgetcsv($passwords);
      $testuser = $theThreeThings[0];
      if($name == $testuser){
        $testpassword = $theThreeThings[2];
        if($password == $testpassword){
          $loggedIn = true;
        }
      }

    }
    if(!$loggedIn){
      $loginError = true;
    }
  }
  function checkLogin($requestUri){

  }

  ?>


  <header>		
   <nav class="navbar navbar">
    <div class="container-fluid">
      <div class="navbar-header">
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        Navigation
      </button>
      <a class="navbar-brand" href="index.php"></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
     <ul class="nav navbar-nav">
      <li <?php checkActiveClass("index")?>><a href="index.php">Home</a></li>
      <li <?php checkActiveClass("posts")?>><a href="posts.php">Posts</a></li>
      <li <?php checkActiveClass("report")?>><a href="report.php">Reporting</a></li>
      <li <?php checkActiveClass("categories")?>><a href="categories.php">Categories</a></li>
      <li <?php checkActiveClass("add_post")?>><a href="add_post.php">Add_post</a></li>
    </ul>
      <div align="right">
    <?php 
      if($loggedIn){
        //echo "<h3>loggedIn</h3>";
      }
      else{
        //echo "<h3>NotloggedIn</h3>";
      }
     ?>
  </div>


  </div>
</div>
</nav>
</header>