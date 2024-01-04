<?php

namespace Controller;

require '../../autoload.php';

use Model\FollowClass;
use Model\ConnectionDB;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  $conection = new ConnectionDB;
  $obj_follow = new FollowClass;

  $con = $conection->get_connection();

  $user = mysqli_real_escape_string($con, $_POST['currentuser']);
  $user_follow = mysqli_real_escape_string($con, $_POST['username']);

  $data = array(
    'username' => $user_follow,
    'currentuser' => $user
  );

  if ($return = $obj_follow->follow($data)) {
    if (gettype($return) == 'array' and $return['data'] == 'Deixou de seguir') {
      echo false;
    } else {
      echo true;
    }
  }
}
