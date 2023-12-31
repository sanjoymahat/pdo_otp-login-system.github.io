<?php session_start();
include_once('config.php');
include 'header.php';
include ('phpmailer_smtp/test.php');
error_reporting(0);

//validation page
if($_SESSION['emailid']=='' ){
echo "<script>window.location.href='login.php'</script>";
}else{

//Code for otp verification
if(isset($_POST['verify'])){
//Getting Post values
$emailid=$_SESSION['emailid'];	
$otp=$_POST['emailotp'];	
// Getting otp from database on the behalf of the email
$stmt=$dbh->prepare("SELECT emailOtp FROM  tblusers where emailId=:emailid");
$stmt->execute(array(':emailid'=>$emailid)); 
while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
$dbotp=$row['emailOtp'];
}
if($dbotp!=$otp){
echo "<script>alert('Please enter correct OTP');</script>";	
} else {
$emailverifiy=1;
$sql="UPDATE tblusers SET isEmailVerify=:emailverifiy,emailOtp=''  WHERE emailId=:emailid";
$query = $dbh->prepare($sql);
// Binding Post Values
$query->bindParam(':emailid',$emailid,PDO::PARAM_STR);
$query->bindParam(':emailverifiy',$emailverifiy,PDO::PARAM_STR);
$query->execute();	
session_destroy();
echo "<script>alert('OTP verified successfully');</script>";	
echo "<script>window.location.href='login.php'</script>";
}}
}

?>

<div class="signup-form">
    <form  method="post">
		<div class="form-header">
			<h2>Verify OTP</h2>
		</div>
        <div class="form-group">
			<label>Email OTP</label>
        	<input type="number" class="form-control" placeholder ="Enter your OTP" name="emailotp" maxlength="6" required="required">
        </div>
    

		<div class="form-group">
			<button type="submit" class="btn btn-primary btn-block btn-lg" name="verify">Verify</button>
		</div>	
    </form>
	<div class="text-center small">Already have an account? <a href="#">Login here</a></div>
</div>
<?php include 'footer.php'; ?>