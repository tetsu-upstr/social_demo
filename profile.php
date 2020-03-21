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

// ボタンを押した時のUserクラスのメソッド
if (isset($_POST['remove_friend'])) {
	$user = new User($con, $userLoggedIn);
	$user->removeFriend($username);
}

if (isset($_POST['add_friend'])) {
	$user = new User($con, $userLoggedIn);
	$user->sendRequest($username);
}

if (isset($_POST['respond_request'])) {
	header("Location: request.php");
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
	

		<form action="<?php echo $username; ?>" method="POST">
			<?php 
			$profile_user_obj = new User($con, $username);
			if ($profile_user_obj->isClosed()) {
				header("Location: user_closed.php");
			}

			$logged_in_user_obj = new User($con, $userLoggedIn);
		
			// 自分のページでなければボタンを表示する
			if ($userLoggedIn != $username) {

				// 友達になっていたら
				if ($logged_in_user_obj->isFriend($username)) {
					echo '<input type="submit" name="remove_friend" class="danger" value="Remove Friend"><br>';
				}
				// 友達リクエストを受け取ったら
				else if ($logged_in_user_obj->didReceiveRequest($username)) {
					echo '<input type="submit" name="respond_request" class="warning" value="Respond to Request"><br>';
				}
				// 友達リクエストを送ったら
				else if ($logged_in_user_obj->didSendRequest($username)) {
					echo '<input type="submit" name="" class="default" value="Request Sent"><br>';
				}
				else
					echo '<input type="submit" name="add_friend" class="success" value="Add Friend"><br>';

			}

			?>

		</form>

	</div>

	<div class="main_column column">
		<?php echo $username; ?>
	</div>

	
</body>
</html>