

<div class="panel panel-info">
      <div class="panel-heading">Login</div>
      <div class="panel-body">
      <?php
        echo '<form class="loginfourm" method="post" action=' . basename($_SERVER['REQUEST_URI'], ".php") . '.php>';
        ?>
          <div class="container">
            <label><b>Username</b></label><br>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <br>

            <label><b>Password</b></label><br>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <br>

            <button class="btn" name="submit" type="submit">Submit</button> 

            <br>

            <a href="#">Forgot Password?</a>

          </div>
        </form>
      </div>
    </div>
  </div>