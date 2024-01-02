<?php

if (isset($_COOKIE['login_user'])) {
  setcookie("login_user", "", time() - 3600, "/");
  header("Location: ../../index.php");
} else if (isset($_SESSION['login_usere'])) {
  session_start();

  session_destroy();

  header("Location: ../../index.php");
}
