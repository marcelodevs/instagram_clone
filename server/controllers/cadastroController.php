<?php

namespace Controller;

require '../../autoload.php';

use Model\UserClass;

$obj_user = new UserClass;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // var_dump(gettype($_POST));
  // var_dump($_POST);

  $caminhoArquivoTemporario = '../../client/assets/img/user.png';
  $conteudoArquivo = file_get_contents($caminhoArquivoTemporario);
  $imagemBase64 = base64_encode($conteudoArquivo);

  $dataEntrada = date('d/m/Y');

  $data = array(
    'email' => $_POST["email"],
    'fullname' => $_POST["fullname"],
    'username' => $_POST["name"],
    'password' => $_POST["password"],
    'bio' => '',
    'img' => $imagemBase64,
    'data_entrada' => $dataEntrada,
    'dark_mode' => 'N',
    'cookies' => $_GET['cookie'] == 'true' ? 'S' : 'N'
  );

  if (isset($_GET['cookie']) and $_GET['cookie'] == 'true') {
    $verificationUser = $obj_user->getSituacaoRepeatDatas($data);
    if ($verificationUser === true) {
      echo "Usuário já cadastrado, experimente <a href='../../client/assets/pages/login.php'>fazer o login</a>";
    } else {
      if ($obj_user->register($data)) {
        if ($login = $obj_user->loginUser($data)) {
          setcookie("login_user", $login['user_id'], time() + (30 * 24 * 60 * 60), "/");
          header("Location: ../../client/assets/pages/index.php");
        } else {
          $error = 'Erro no login, senha ou email inválidos :(';
          header("Location: ../php/404.php?error=" . urlencode($error));
        }
      } else {
        $error = 'Erro ao cadastrar, senha ou email inválidos :(';
        header("Location: ../php/404.php?error=" . urlencode($error));
      }
    }
  } else if (isset($_GET['cookie']) and $_GET['cookie'] == 'false') {
    $verificationUser = $obj_user->getSituacaoRepeatDatas($data);
    if ($verificationUser === true) {
      echo "Usuário já cadastrado, experimente <a href='../../client/assets/pages/login.php'>fazer o login</a>";
    } else {
      session_start();
      if ($obj_user->register($data)) {
        if ($login = $obj_user->loginUser($data)) {
          $_SESSION['login_user'] = $login['user_id'];
          header("Location: ../../client/assets/pages/index.php");
        } else {
          $error = 'Erro no login, senha ou email inválidos :(';
          header("Location: ../php/404.php?error=" . urlencode($error));
        }
      } else {
        $error = 'Erro ao cadastrar, senha ou email inválidos :(';
        header("Location: ../php/404.php?error=" . urlencode($error));
      }
    }
  }
}
