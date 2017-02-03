<!doctype html>
<html>
<title>Home - Login with Google Account OAuth</title>
<body >
<a href='http://9lessons.info'>www.9lessons.info</a>
<h1>Home - Login with Google Account Login</h1>
<?php
session_start();
include('db.php');
if (!isset($_SESSION['google_data'])) {
    // Redirection to login page twitter or facebook
    header("location: index.php");
}
else
{
//echo print_r($userdata);
$userdata=$_SESSION['google_data'];
$email =$userdata['email'];
$googleid =$userdata['id'];
$fullName =$userdata['name'];
$firstName=$userdata['given_name'];
$lastName=$userdata['family_name'];
$gplusURL=$userdata['link'];
$avatar=$userdata['picture'];
$gender=$userdata['gender'];
$dob=$userdata['birthday'];

//Execture query
$sql=mysql_query("insert into users(email,fullname,firstname,lastname,google_id,gender,dob,profile_image,gpluslink) values('$email','$fullName','$firstName','$lastName','$googleid','$gender','$dob','$avatar','$gplusURL')");

?>
<div>
<table width='100%'>
<tr><td valign='top'>	
<img src="<?php echo $avatar; ?>" style='float:left;width:100px'/></td><td valign='top'>
<b>Email:</b> <?php echo  $email; ?><br/>
<b>Full Name:</b> <?php echo $fullName; ?><br/>
<b>First Name:</b> <?php echo $firstName; ?><br/>
<b>Last Name:</b> <?php echo $lastName; ?><br/>
<b>Google Id</b> <?php echo $googleid; ?><br/>
<b>Gender:</b> <?php echo $gender; ?><br/>
<b>Image URL:</b> <?php echo $avatar; ?><br/>
<b>DOB:</b> <?php echo $dob; ?><br/>
<b>Google Plus Link:</b> <?php echo $gplusURL; ?>
</td>
</tr></table>

</div>
<?php 
print "<a class='logout' href='index.php?logout'>Logout</a><br/> <br/> "; 
}
?>

</div>

</body>
</html>
