<?php
class User {
  private $user;
  private $con;

  public function __construct($con, $user){
    $this->con = $con;
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username = '$user'");
    $this->user = mysqli_fetch_array($user_details_query);
  }

  public function getUsername() {
    return $this->user['username'];
  }

  public function getNumPosts() {
    $username = $this->user['username'];
    $query = mysqli_query($this->con, "SELECT num_posts FROM users WHERE username='$username'");
    $row = mysqli_fetch_array($query);
    return $row['num_posts'];
  }

  public function getFirstAndLastName() {
    $username = $this->user['username'];
    $query = mysqli_query($this->con, "SELECT first_name, last_name FROM users WHERE username = '$username'");
    $row = mysqli_fetch_array($query);
    return $row['first_name'] . " " . $row['last_name'];
  }

  public function getProfilePic() {
    $username = $this->user['username'];
    $query = mysqli_query($this->con, "SELECT profile_pic FROM users WHERE username = '$username'");
    $row = mysqli_fetch_array($query);
    return $row['profile_pic'];
  }

  public function isClosed() {
    $username = $this->user['username'];
    $query = mysqli_query($this->con, "SELECT user_closed FROM users WHERE username='$username'");
    $row = mysqli_fetch_array($query);

    if ($row['user_closed'] == 'yes')
      return true;
    else
      return false;
  } 

  // フォロワーのチェック
  public function isFriend($username_to_check) {
    $usernameComma = "," . $username_to_check . ",";

    // strstr(対象となるの文字列, 検索したい文字列) 文字列の一致を確認する フォロワーの名前に一致するものがある、または自分の名前であればtrue
    if ((strstr($this->user['friend_array'], $usernameComma) || $username_to_check == $this->user['username'])) {
      return true;
    }
    else {
      return false;
    }
  }

}