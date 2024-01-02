<?php

namespace Controller;

require_once '../../autoload.php';

use Model\UserClass;

$username = $_GET['name'] ?? null;

if ($username) {
  $obj_user = new UserClass;

  $dar_mode = $obj_user->get_preferences_dark_mode($username);

  // var_dump($dar_mode);

  if ($dar_mode) {
    $res = $obj_user->set_preferences_dark_mode($username, 'N');
  } else {
    $res = $obj_user->set_preferences_dark_mode($username, 'S');
  }

  if ($res) {
    header("Location: ../../client/assets/pages/perfil.php");
  } else {
    echo "Erro ao atualizar as preferências de modo escuro.";
  }
} else {
  echo "Nome de usuário não especificado.";
}
