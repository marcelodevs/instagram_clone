<?php

namespace Model;

use Model\ConnectionDB;

class FollowClass
{

  public $conn;

  public function follow($data)
  {
    $this->conn = new ConnectionDB;

    $con = $this->conn->get_connection();
    $seguidor_id = mysqli_real_escape_string($con, $data['username']);
    $currentUser = mysqli_real_escape_string($con, $data['currentuser']);

    $query = mysqli_query($con, "SELECT * FROM followers WHERE follower_id = '$currentUser' AND followee_id = '$seguidor_id'");

    if (mysqli_num_rows($query) == 0) {
      $sql = "INSERT INTO followers (follower_id, followee_id) VALUES ('$currentUser', '$seguidor_id')";
      if (mysqli_query($con, $sql)) {
        return true;
      }
    } else {
      $sql = "DELETE FROM followers WHERE followee_id = '$seguidor_id'";
      if (mysqli_query($con, $sql)) {
        return ['data' => 'Deixou de seguir'];
      }
    }
  }

  public function get_following($data) // seguindo
  {
    $this->conn = new ConnectionDB;

    $con = $this->conn->get_connection();
    $currentUser = mysqli_real_escape_string($con, $data);

    $query = mysqli_query($con, "SELECT COUNT(followee_id) AS following_count FROM followers WHERE follower_id = '$currentUser'");
    $result = mysqli_fetch_assoc($query);

    return $result['following_count'];
  }

  public function get_followers($data) // seguidores
  {
    $this->conn = new ConnectionDB;

    $con = $this->conn->get_connection();
    $currentUser = mysqli_real_escape_string($con, $data);

    $query = mysqli_query($con, "SELECT COUNT(follower_id) AS followers_count FROM followers WHERE followee_id = '$currentUser'");
    $result = mysqli_fetch_assoc($query);

    return $result['followers_count'];
  }

  public function get_verification_follow($currentUser, $userFollow)
  {
    $this->conn = new ConnectionDB;

    $con = $this->conn->get_connection();

    $current_user = mysqli_real_escape_string($con, $currentUser);
    $user_follow = mysqli_real_escape_string($con, $userFollow);

    $query = mysqli_query($con, "SELECT * FROM followers WHERE followee_id = '$user_follow' AND follower_id = '$current_user'");

    if (mysqli_num_rows($query) > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function list_following($currentUser)
  {
    $this->conn = new ConnectionDB;

    $con = $this->conn->get_connection();
    $current_user = mysqli_real_escape_string($con, $currentUser);

    $query = mysqli_query($con, "SELECT users.username, users.profile_photo_url FROM followers INNER JOIN users ON followers.followee_id = users.username WHERE followers.follower_id = '$current_user'");

    $following_list = array();

    while ($row = mysqli_fetch_assoc($query)) {
      $following_list[] = $row;
    }

    return $following_list;
  }
}
