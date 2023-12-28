<?php
session_start();

$caminho_true = './client/assets/pages/index.php';
$caminho_false = './client/assets/pages/login.php';

if (isset($_SESSION['user_login'])) {
  header("Location: " . $caminho_true);
  exit();
} else {
  header("Location: " . $caminho_false);
  exit();
}
?>
