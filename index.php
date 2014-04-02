<?php

// start or resume session

/* Check to see if the "isLoggedIn" token is set. If it is, redirect the user to
 *
 * profile.php instead of displaying this page.
 */
// INSERT CODE HERE <-----------------------------------------------------------
if (isset($_SESSION["userId"])) {
	header("Location: profile.php");
	exit; 	// ensure script terminates immediately
}

require_once "header.php";
 ?>
<div id="content">
  <br />
  <h3>Welcome to Artist eXchange!</h3>
  <div>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce elit ligula, hendrerit a, dignissim ut, dictum nec, risus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse vestibulum sem eget nisi. Aenean vel dui. Aliquam at nulla. Quisque quis sapien. Sed euismod nibh ac justo. Proin fermentum tellus sit amet massa. Ut ac est. Donec velit. Donec sodales. Mauris interdum, lectus et dapibus ornare, diam ante cursus velit, sit amet dictum massa erat vel lorem.</p>
    
    <p>Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce elementum dui vitae quam. Morbi velit risus, ultricies id, tempor quis, porta vel, nisl. Quisque quam. Curabitur accumsan est non elit. Ut vitae tellus. Aenean quis eros vel nulla tincidunt ornare. Etiam in sem. Vestibulum odio. Vestibulum condimentum. Quisque arcu. Quisque venenatis gravida est. Donec consequat mollis arcu. Duis vel nulla convallis nulla pretium tincidunt. Mauris sem.</p>
    
    <p>Curabitur augue. Sed dictum lorem sed sem. Vivamus egestas accumsan nisl. Aenean lorem justo, dapibus vel, suscipit vel, viverra vitae, felis. Nulla facilisi. Fusce adipiscing condimentum diam. Nullam vulputate velit sed lacus. Integer sodales dignissim lacus. Suspendisse at enim. Nunc tellus elit, viverra eget, ornare eget, fermentum eget, dui. In eu ante. Vivamus lacinia tempor urna. Suspendisse vitae dolor eget nisi pharetra tempor. Duis commodo dui vitae leo. </p>
  </div>
  
  <div>
    Test your implementation at the <a href="http://people.virginia.edu/~jmc7tp/courses/cs4753/virtual-labs/">Virtual Labs website</a>.
  </div>
</div> <!--end content -->
<?php
require_once "footer.php";
