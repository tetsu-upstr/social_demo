<?php
include("../../config/config.php");
include("../classes/User.php");

$query = $_POST['query'];
$userLoggedIn = $_POT['userLoggedIn'];

$name = explode(" ", $query);

// strposは文字列の最初に現れる部分を見つける
if(strpos($query, "_") != false) {
  $userReturned = mysqli_query($con, "SELECT users FROM username LIKE '%$query%' AND user_closed='no' LIMIT 8");

}
else if(count($names) == 2) {
  $userReturned = mysqli_query($con, "SELECT users FROM username WHERE (first_name LIKE '%$names[0]%' AND lastname LIKE '%$names[1]%' AND user_closed='no' LIMIT 8");
}
else {
  $userReturned = mysqli_query($con, "SELECT users FROM username WHERE (first_name LIKE '%$names[0]%' OR lastname LIKE '%$names[0]%' AND user_closed='no' LIMIT 8");
}

if($query != "") {
  while($row = mysqli_fetch_array($userReturned)) {
    $user = new User($con, $userLoggedIn);

    if ($row['username'] != $userLoggedIn) {
      $mutual_friends = $user->getMutualFriends($row['username']) . " friend in common";
    } else {
      $mutual_friends = "";
    }

    if ($user->isFriend($row['username'])) {
      echo "<div class='resutDisplay'>
              <a href='messages.php?u='" . $row['username'] . "' style='color: #000'>
                <div class='LiveSeachProfilePic'>
                  <img src='". $row['profile_pic'] . "'
                </div>

                <div class='LiveSearchText'>
                  " . $row['first_name'] . " " . $row['last_name'] . "
                  <p  style='margin:0;'>" . $row['username']  . "</p>
                  <p id='grey'>" . $mutual_friends . "</p>
                </div>
              </a>
            </div>";
    }
  }
}