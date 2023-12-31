<?php session_start();
include 'header.php';
include_once('config.php');

if (strlen($_SESSION['ulogin']==0)) {
  header('location:index.php');
  } else{

?>


<div class="signup-form">
    <form  method="post">
		<div class="form-header">
			<h2>welcome</h2>
		</div>

        <div class="form-group">
			<label>Welcome Back--</label>
        <?php  echo $_SESSION['fname'];?>
        </div>

		<div class="form-group">
			<a href="logout.php" class="btn btn-primary btn-block btn-lg" style="color: #fff;">Logout</a>
		</div>	
    </form>

</div>
</body>
</html>
<?php include 'footer.php'; } ?>