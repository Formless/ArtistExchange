<div id="navBar">
  <!-- 
    This is bizarre, but IE requires the login div to be the child of navBar. If
    it isn't present or another div is substituted, IE doesn't display correctly
    (there is a white gap above the navBar).
    -->
  <div id="login">
  <!-- INSERT LOGIN FORM HERE -->
      
	<?php 
	if (isset($_SESSION["userId"])) {
	?>
	
	<form id = "searchForm" action = "search.php" method = "get"> 
          <div >
            
            <label for ="q">Search</label><br />
            <input id="q" name ="q" type ="text" size ="10"/><br />
            <input id="goButton" type ="submit" value ="go"/>
            
            
          </div >
      </form >
	
		<div id="sectionLinks">
			<ul>
				<?php
					$userId = $_SESSION["userId"];
					$str = "profile.php?id=$userId";
				?>
				<li><a href="profile.php">Profile</a></li>
				<li><a href="settings.php">Settings</a></li>
				<li><a href="featured.php">Featured Artists</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div> <! -- end sectionLinks -->
	<?php
	}
	else { 
	?>
	<form id = "loginForm" action = "login.php" method = "post" 
          <div >
            
            <label for ="usernameInput">Username</label><br />
            <input id="usernameInput" name ="username" type ="text" /><br />
            <label for ="passwordInput">Password</label><br />
            <input id="passwordInput" name ="password" type ="password" /><br />
            
            <input id="logInButton" type ="submit" value ="Log in"/>
            
            
          </div >
      </form >
	<?php
		}
	?>
  
  </div> <!-- end login -->
  <div id="register" style="font-size: smaller; text-align: right;">
      New to Artist eXchange? <a href="register.php">Register</a>
  </div> <!-- end register -->
</div> <!-- end navBar -->

</body>

</html>

