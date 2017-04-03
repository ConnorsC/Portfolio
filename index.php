<?php 
include 'includes/headder.php';

$serverName = "localhost";
$username = "root";
$password = "root";
$dbname = "cms";


?>

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-info">
        <div class="panel-heading">Recent Posts</div>
        <div class="panel-body">
          <?php 


          $conn = new mysqli($serverName,$username,$password,$dbname);

          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          } 

          $query = "SELECT * FROM posts WHERE post_status='Published'";
          $result = $conn->query($query);
          if ($result->num_rows > 0) {
           while($row = $result->fetch_assoc()) {

            $row = $result->fetch_assoc();
            echo '<h3>' . $row['post_title'] . '</h3><br>';
            echo $row['post_author'] . "<br>";
            echo $row['post_date'] . "<br><br>";
            echo $row['post_content'];


          }
        }

        $conn->close();
        ?>

      </div>
    </div>
  </div>
  <div class="col-sm-4">
  </div>
</div>
</div>
<?php 
include 'includes/footer.php';
?>