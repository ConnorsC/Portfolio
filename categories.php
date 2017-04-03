<?php 
include 'includes/headder.php';


$serverName = "localhost";
$username = "root";
$password = "root";
$dbname = "cms";

//update DB
if($_GET['Update_required'] == "True"){

  $conn = new mysqli($serverName,$username,$password,$dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 

  $stmt = $conn->prepare("UPDATE category SET cat_title=? WHERE cat_id=?");

  $stmt->bind_param("si", $name, $id);
  $name = $_GET['Update_Name'];
  $id = $_GET['Update_Id'];
  $stmt->execute(); 
  $conn->close();

}

if($_GET['new_category'] == "True"){

  $conn = new mysqli($serverName,$username,$password,$dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 



  $stmt = $conn->prepare("INSERT INTO category (cat_title)VALUES(?)");

  $stmt->bind_param("s", $name);
  $name = $_GET['categoryToAdd'];
  $stmt->execute(); 
  $conn->close();

}

if($_GET['button'] == "Delete_Button"){

  $conn = new mysqli($serverName,$username,$password,$dbname);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  } 



  $stmt = $conn->prepare("DELETE FROM category WHERE cat_id=?");

  $stmt->bind_param("i", $id);
  $id = $_GET['id_value'];
  $stmt->execute(); 
  $conn->close();

}

?>

<div class="container">
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-info">
        <div class="panel-heading">Category Managment</div>
        <div class="panel-body">
          Add a Category
          <form class="form-horizontal" method="get" action="categories.php">
            <div class="form-group">
              <label class="control-label col-sm-2" for="categoryToAdd">Category:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" name="categoryToAdd" placeholder="Category">
                <input type="hidden" name="new_category" value="True"></input>
                <button type="submit" class="btn btn-default">Add Category</button>
              </div>
            </div>
          </form>

          <?php 
          if($_GET['button'] == "Edit_Button"){

            echo'
            <br>

            Edit a Category

            <form class="form-horizontal" method="get" action="categories.php">
              <div class="form-group">

                <label class="control-label col-sm-2">Update Category:</label>

                <div class="col-sm-10">

                  <input type="hidden" name="Update_Id" value=' . $_GET['id_value'] .'></input>

                  <input type="hidden" name="Update_required" value="True"></input>

                  <input type="text" class="form-control" name="Update_Name" value="' . $_GET['name_value'] . '">

                  <button type="submit" class="btn btn-default">Update Category</button>

                </div>
              </div>
            </form>';
          }
          ?>

        </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="panel panel-info">
        <div class="panel-heading">Category Managment</div>
        <div class="panel-body">

          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>ID</th>
                <th>Category Title</th>
                <th></th>
              </tr>
            </thead>
            <tbody>

              <?php 
              $serverName = "localhost";
              $username = "root";
              $password = "root";
              $dbname = "cms";

              $conn = new mysqli($serverName,$username,$password,$dbname);

              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              } 

              $query = "SELECT cat_id, cat_title FROM category";
              $result = $conn->query($query);

              if ($result->num_rows > 0) {
               while($row = $result->fetch_assoc()) {
                ?>
                <tr>
                  <td><?php echo $row['cat_id'];?></td>
                  <td><?php echo $row['cat_title'];?></td>
                  <td>
                    <a class="btn btn-info" href= 'categories.php?button=Edit_Button&id_value=<?php echo $row['cat_id'];?>&name_value=<?php echo $row['cat_title'];?>'>Update</a>

                    <a class="btn btn-danger" href= 'categories.php?button=Delete_Button&id_value=<?php echo $row['cat_id'];?>'>Delete</a>
                  </td>
                </tr>

                <?php
              } 
            }
            $conn->close();

            ?>

          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
</div>


<?php 
include 'includes/footer.php';
?>