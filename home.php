<?php
session_start();
error_reporting(0);
include ("database/config.php");
$session_usr = $_SESSION['username'];

$query = "SELECT rewards FROM gozoop_users WHERE username = '$session_usr'";
$data = mysqli_query($db, $query);
$result = mysqli_fetch_assoc($data);

$total = mysqli_num_rows($data);

if($total == 1){
	$_SESSION['rewards'] = $result['rewards'];
}
?>

<!DOCTYPE html>
<html>
<head>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" type="text/css" href="css/home.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
	
</head>
<body>
	<nav class="navbar">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#">Welcome</a>
	    </div>
	    <ul class="nav navbar-nav navbar-right">
	      <li class="username"><b><?php echo $_SESSION['username']; ?></b></li>
	      <li><a href="logout.php" id="logout">Sign Out</a></li>
	    </ul>
	  </div>
	</nav>


	<div class="container-fluid homeBg">
		<div class="row">
			<div class="col images">
				<img src="/images/main.png" alt="main" class="center main">
				<img src="/images/button.png" alt="button" class="button" id="spinNow">
				<img src="/images/seven.png" id="slot1">
				<img src="/images/seven.png" id="slot2">
				<img src="/images/seven.png" id="slot3">
			</div>
		</div>
	</div>
	<div class="container-fluid successBg">
		<div class="row">
			<div class="col">
				<p class="success-info"><b>USE POINTS TO REDEEM FOLLOWING PRODUCTS:</b></p>
			</div>
		</div>
	</div>
	<div class="container-fluid successBg pdBtm">
		<div class="row">
			<div class="col-4 col1 cols text-center">
				<img src="images/club.png" class="pd">
				<p>Points required: 100</p>
				<button class="btn">REDEEM</button>
			</div>
			<div class="col-4 cols col23 text-center">
				<img src="images/club.png" class="pd">
				<p>Points required: 200</p>
				<button class="btn">REDEEM</button>
			</div>
			<div class="col-4 cols col23 text-center">
				<img src="images/club.png" class="pd">
				<p>Points required: 500</p>
				<button class="btn">REDEEM</button>
			</div>
		</div>
		<div class="row">
			<div class="col-4">
				<p class="balanceTxt balanceTxt1">Hint: Redeem done, Now balance: <span class="balance"></span></p>
			</div>
			<div class="col-4">
				<p class="balanceTxt balanceTxt2">Hint: Redeem done, Now balance: <span class="balance"></span></p>
			</div>
			<div class="col-4">
				<p class="balanceTxt balanceTxt3">Hint: Redeem done, Now balance: <span class="balance"></span></p>
			</div>
		</div>
	</div>

	
</body>
<!-- Modal -->
	<div id="success" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-body">
	        <h1>Congratulations!</h1>
	        <p class="rewardTxt">You get <span id="points"></span> points.</p>
	        <p class="rewardTxt marginBtm">Use this to redeem below products.</p>
	        <button class="btn modalBtn" data-dismiss="modal">OK</button>
	      </div>
	    </div>

	  </div>
	</div>

	<div id="failure" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-body">
	        <h1>THAT WAS <br> A GREAT SPIN!</h1>
	        <p class="rewardTxt">One more try might make <br> you lucky.</p>
	        <p class="rewardTxt marginBtm">To earn more spins click below</p>
	        <button class="btn modalBtn" data-dismiss="modal">Spin Now</button>
	      </div>
	    </div>

	  </div>
	</div>

	<div id="threeTimes" class="modal fade" role="dialog">
	  <div class="modal-dialog">

	    <!-- Modal content-->
	    <div class="modal-content">
	      <div class="modal-body">
	        <h1>Limit exceeded: Please try again after <b>30 Minutes!</b></h1>
	        <button class="btn modalBtn" data-dismiss="modal">OK</button>
	      </div>
	    </div>

	  </div>
	</div>

</html>