<?php 
include 'includes/headder.php';
?>


<?php

if(isset($_POST['submit'])) {
  $name = ($_POST['uname']);
  $email = ($_POST['uemail']);
  $message = ($_POST['message']);
  $issue = ($_POST['selectedIssue']);
  $date = date('M-d-Y h-i-s');

  //this may need to be changed for whoever is marking this 
  $filename = 'C:\MAMP\htdocs\A2\misc\message_'.$date.'.txt';
  $newFile = fopen($filename, "w") or die("unable to open file");
  $txt = "Issue Alert!\nType of issue: $issue \n \nSubmitted by: $name \nEmail ID: $email\nSubmitted at $date \n \nDetails: $message";
  fwrite($newFile, $txt);
  fclose($newFile);
  }
?>

<div class="container">
  <div class="row">
      <div class="panel panel-info">
        <div class="panel-heading">Recent Posts</div>
        <div class="panel-body">

         <form class="loginfourm" method="post" action="report.php";
         ?>
         <div class="container">
          <label><b>Name</label><br>
          <input type="text" placeholder="Enter name" id="uname" name="uname" required>

          <br>
          <label><b>Email</b></label><br>
          <input type="text" placeholder="Enter Email" name="uemail" required>

          <br>

          <label for="sel1">Issue:</label>
          <select class="form-control" id="selectedIssue" name="selectedIssue" required>
            <option>Link not working</option>
            <option>Page not found</option>
            <option>Incorrect script</option>
          </select>

          <br>
          <label><b>Tell us whats wrong!</b></label><br>
          <textarea class="form-control" rows="5" name="message" id="message" required></textarea>          

          <button class="btn" name="submit" type="submit">Submit</button> 
          <button class ="btn" type="reset">Reset</button>

          <br>

        </div>
      </form>
    </div>
  </div>
</div>
<?php 
include 'includes/footer.php';
?>