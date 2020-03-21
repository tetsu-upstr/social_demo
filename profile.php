<?php
include("includes/header.php");
include("includes/classes/User.php");
include("includes/classes/Post.php");

// index.php上でプロフィールの名前をクリックすると.htaccessによってprofile.phpが表示されます

if (isset($_GET['profile_username'])) {
	$username = $_GET['profile_username'];
	$user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username'");
	$user_array = mysqli_fetch_array($user_details_query);

	// substr_count(a, b) →bの出現回数をaから返す
	$num_friends = (substr_count($user_array['friend_array'], ",")) -1;
}

?>
<style>
	.wrapper {
		margin-left: 0;
		padding-left: 0;
	}
</style>

	<div class="profile_left">
		<img src="<?php echo $user_array['profile_pic'];?>" >

		<div class="profile_info">
			<p><?php echo "投稿: " . $user_array['num_posts']; ?></p>
			<p><?php echo "Likes: " . $user_array['num_likes']; ?></p>
			<p><?php echo "友達: " . $num_friends; ?></p>
		</div>
	</div>

	<form action="<?php echo $username; ?>">
		<?php 
		$profile_user_obj = new User($con, $username);
		if ($profile_user_obj->)
		
		?>


	</form>

	<div class="main_column column">
		<?php echo $username; ?>
	</div>

	
</body>
</html>