<?php 
include 'includes/headder.php';

$serverName = "localhost";
$username = "root";
$password = "root";
$dbname = "cms";
$comment_post_id_temp;
if(isset($_POST["submit"])) {

  $conn = new mysqli($serverName,$username,$password,$dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 
  $stmt = $conn->prepare("INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_date, comment_status)VALUES(?,?,?,?,?,?)");
  $stmt->bind_param("isssss", $comment_post_id, $comment_author, $comment_email, $comment_content, $comment_date, $comment_status);

  $comment_post_id = $_POST['comment_post_id'];
  $comment_author = $_POST['comment_author'];
  $comment_email = $_POST['comment_email'];
  $comment_date = date("Y/m/d h:i:sa");
  $comment_content = $_POST['comment_content'];
  $comment_status = "submitted";
  $stmt->execute();
  $conn->close();
}
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

          $query = "SELECT * FROM posts ORDER BY post_id DESC LIMIT 1";
          $result = $conn->query($query);
          $row = $result->fetch_assoc();
          echo '<h3>' . $row['post_title'] . '</h3><br>';
          echo $row['post_author'] . "<br>";
          echo $row['post_date'] . "<br><br>";
          echo $row['post_content'];
          $comment_post_id_temp = $row['post_id'];

          $conn->close();
          ?>

        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-info">
        <div class="panel-body">

          <form class="form-horizontal" method="post" action="posts.php">
            <div class="form-group">
              <div class="col-sm-8">
               <h3>Leave a comment:</h3>
               <label class="control-label">Autor</label>
               <input type="text" class="form-control" name="comment_author" required>

               <label class="control-label">Email</label>
               <input class="form-control" name="comment_email" required>

               <label class="control-label">Comment</label>
               <textarea rows="4" cols="50" class="form-control" name="comment_content"></textarea>
               <br>
               <input type="hidden" name="comment_post_id" value=<?php echo '" '. $comment_post_id_temp . '"'?>''></input>
               <input class="btn btn-info" type="submit" value="Submit" name="submit">

              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-info">
        <div class="panel-body">
        <h3>Comments</h3>
        <?php 

          $conn = new mysqli($serverName,$username,$password,$dbname);

          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          } 

          $query ="SELECT * FROM comments WHERE comment_post_id=$comment_post_id_temp";

          $result = $conn->query($query);

          if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                
                echo '<h4>'. $row['comment_author'] . '</h4> ' . $row['comment_date'] .' <br>';
                echo $row['comment_content'];

              } 
            }
          $conn->close();
          ?>
        </div>
      </div>
    </div>
  </div>


</div>
<?php 
include 'includes/footer.php';
?>