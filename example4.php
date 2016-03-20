<?php
//session_start();

require 'admin.php';
require 'dbinfo.php';
require 'ACL.php';

// if(!isset($_SESSION['id']))
//    header("location:loginadmin.php");
$obj = new ACL();
$userid = $_POST['users'];
$name = $_POST['user'];
$role = $_POST['role_name'];

if ($_POST['submit'] == "Add") {
    $sql = "INSERT INTO user_roles (user_id, user_name, role_id)
            VALUES('$userid', '$name', '$role')";
    $result = mysqli_query($conn, $sql);
}

if ($_POST['submit'] == "Delete") {
	$sql = "DELETE 
	        FROM user_roles
	        WHERE user_id = '$userid' ";
	$result = mysqli_query($conn, $sql);
}

?>
<div class="container">
   <h1 class="well" align="center">Adminstration Page</h1>
   <!--Role Assign to a particuler user-->
     <div class="jumbotron">
        <form role="form" name="f" method="post" action="alluser.php">
            <h3>Role Description </h3><br>
                <div class="row">
                   <div class="col-sm-3 form-group">                                 
			            <div>
			                <h4>Select UserId</h4>
			            </div>   
		             
		                <?php
	                    $result = $obj->viewUsers();
		                echo "<select name='users' id='users' >";
		                while ($row = mysqli_fetch_assoc($result)) {
		                    echo "<option value='" . $row['user_id'] ."'>" . $row['user_id'] ."</option>";
		                }

		                echo "</select>"
		                ?>
		            </div>
	                <div class="col-sm-3 form-group">  
	                    <div>   
	                        <h5><label>User Name</label></h5>
	                        <input type="text" name="user"  id="user">
                        </div>
                    </div>
                    <!--Php code here-->
                    <div class="col-sm-3 form-group">                                 
				            <div>
				                <h4>User Type</h4>
				            </div>   
		          
                       <?php
	                    $result = $obj->viewRoles();
		                echo "<select name='role_name' id='role_name' >";
		                while ($row = mysqli_fetch_assoc($result)) {
		                    echo "<option value='" . $row['id'] ."'>" . $row['role_name'] ."</option>";
		                }

		                echo "</select>"
		                ?>
                    </div>
                <div class="col-sm-3 offset-5 form-group">
                    <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Add">
                    <input type="submit" class="btn btn-primary" name="submit" id="submit" value="Delete"> 
                </div>
            </div>
        </form>
    </div>
</div>
<script src="js/rolechange.js"  type="text/javascript"></script>
