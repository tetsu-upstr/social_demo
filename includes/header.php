<?php
require 'config/config.php';
include("includes/classes/User.php");
include("includes/classes/Post.php");

// ログインしていれば、セッションの名前をDBと等しいか確認
// mysqli_fetch_array — 結果の行を連想配列・数値添字配列あるいはその両方の形式で取得
if (isset($_SESSION['username'])) {
  $userLoggedIn = $_SESSION['username'];
  $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$userLoggedIn'");
  $user = mysqli_fetch_array($user_details_query);
} else {
  // ログインしていなければ登録フォームにリダイレクト
  header("Location: register.php");
}
?>

<html>
<head>
  <title>Welcome to SNS</title>

  <!-- Javascript -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
	<script src="assets/js/demo.js"></script>
	<script src="assets/js/jquery.jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>

  <!-- CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />
</head>
<body>

  <div class="top_bar">
    <div class="logo">
      <a href="index.php">SNS</a>
    </div>

    <nav>
      <a href="<?php echo $userLoggedIn; ?>">
        <?php echo $user['first_name']; ?>
      </a>
      <a href="index.php">
      <i class="fa fa-home fa-lg"></i>
      </a>
      <a href="#">
      <i class="fa fa-envelope fa-lg"></i>
      </a>
      <a href="#">
      <i class="fa fa-bell fa-lg"></i>
      </a>
      <a href="request.php">
      <i class="fa fa-users fa-lg"></i>
      </a>
      <a href="#">
      <i class="fa fa-cog fa-lg"></i>
      </a>
      <a href="includes/handlers/logout.php">
      <i class="fa fa-sign-out fa-lg"></i>
      </a>
    </nav>

  </div>

  <div class="wrapper">