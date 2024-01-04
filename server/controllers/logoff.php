<?php

session_start();

if (isset($_COOKIE['login_user'])) {
  setcookie("login_user", "", time() - 3600, "/");
  header("Location: ../../index.php");
} else if (isset($_SESSION['login_user'])) {
  session_destroy();

  header("Location: ../../index.php");
}
