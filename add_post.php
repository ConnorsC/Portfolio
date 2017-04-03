<?php 
include 'includes/headder.php';
$serverName = "localhost";
$username = "root";
$password = "root";
$dbname = "cms";

$target_dir = "images/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if(isset($_POST["submit"])) {
    if($_FILES["fileToUpload"]["tmp_name"] != null){
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"] > 2097152) {
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png") {
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";

        } else {
        //image processed 
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            } else {
                $uploadOk = 0;
                echo "Sorry, there was an error uploading your file.";
            }

        }
    }
    $conn = new mysqli($serverName,$username,$password,$dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    $stmt = $conn->prepare("INSERT INTO posts (post_cat_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comments, post_status)VALUES(?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssis", $post_cat_id, $post_title, $post_author, $post_date, $post_image, $post_content, $post_tags, $post_comments, $post_status);


    $post_cat_id = $_POST['post_cat_id'];
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_date = date("Y/m/d h:i:sa");
    if($uploadOk != 0){$post_image = $target_file;
    }else {$post_image = NULL;}
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];
    $post_comments = '0';
    $post_status = $_POST['post_status'];

    $stmt->execute();
    $conn->close();

}


?>

<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-info">
        <div class="panel-heading">Add Post</div>
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="add_post.php" enctype="multipart/form-data">
              <div class="form-group">
                <div class="col-sm-4">

                    <label class="control-label">Post Title</label>
                    <input type="text" class="form-control" name="post_title" placeholder="Title" required>

                    <label class="control-label">Post Category</label>
                    <select class="form-control" name="post_cat_id" required>

                        <?php 
                        $conn = new mysqli($serverName,$username,$password,$dbname);
                        $query = "SELECT cat_title FROM category";
                        $result = $conn->query($query);
                        while ($row = $result->fetch_assoc()){
                            echo "<option value=\"owner1\">" . $row['cat_title'] . "</option>";
                        }
                        ?>
                    </select>

                    <label class="control-label">Post Author</label>
                    <input type="text" class="form-control" name="post_author" placeholder="Post Author" required>

                    <label class="control-label">Post Status</label>
                    <select class="form-control" name="post_status" required>

                        <option>Draft</option>
                        <option>Published</option>
                    </select>

                    <label class="control-label">Post Image</label>
                    <input type="file" name="fileToUpload" id="fileToUpload">

                    <label class="control-label">Post Tags</label>
                    <input type="text" class="form-control" name="post_tags" placeholder="Post Tags" required>

                    <label class="control-label">Post Content</label>
                    <textarea rows="4" cols="50" class="form-control" name="post_content"></textarea>

                    <br>
                    <input class="btn btn-info" type="submit" value="Publish Post" name="submit">

                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>

<?php 
include 'includes/footer.php';
?>