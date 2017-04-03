<?php 
  include 'headder.php';
  ?>


<div class="container">
	<div class="row" align ="right">
	 <p>Welcome! it is now 
	  <?php 
	  date_default_timezone_set("America/Halifax");
	    echo date("h:i:sa") . ", on " . date("d-M-Y");
	  ?>
	  </p>
	</div>
  	<div class="row">
	    <div class="col-sm-8 col-lg-8">
	      <div class="panel panel-info">
	        <div class="panel-heading">Panel title</div>
	        <div class="panel-body">
	        	<p>
	        		Thank you for visiting this page.
	        	</p>

	           	<p>
	           		This website was created by: <br>

				<?php 
	  				$name = "Chris Connors";
	  				$program = "Applied Computer Science";
	  				$email = "ch490595@dal.ca";

	  				echo "$name <br> I study $program at Dalhousie University <br> My email address is: $email";

	  			?>


	          	</p>

	      </div>
	    </div>

	  </div>
	  <div class="col-sm-4 col-lg-4">

	  <div class="panel panel-info">
	    <div class="panel-heading">Panel title</div>
	      <div class="panel-body">
	        <form class="loginfourm" action="action_page.php">
	          <div class="container">
	            <label><b>E-Mail Address</b></label><br>
	            <input type="text" placeholder="Enter Username" name="uname" required>

	            <br>

	            <label><b>Password</b></label><br>
	            <input type="password" placeholder="Enter Password" name="psw" required>

	            <br>

	            <input type="checkbox"> Remember me

	            <br>

	            <button type="submit">Login</button>
	            
	          </div>
	        </form>
	      </div>
	    </div>
	  </div>
	</div>

<?php 
  include 'footer.php';
  ?>