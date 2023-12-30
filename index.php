<?php

$caminho_true = './client/assets/pages/index.php';
$caminho_false = './client/assets/pages/login.php';

if (isset($_COOKIE['user_login'])) {
  header("Location: " . $caminho_true);
  exit();
} else {
  header("Location: " . $caminho_false);
  exit();
}
?>
