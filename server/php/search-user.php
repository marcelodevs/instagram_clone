<?php

namespace Controller;

header('Content-Type: application/json');

require_once '../../autoload.php';

use Model\ConnectionDB;


if (isset($_POST['query'])) {
  $user = search_busca($_POST['query']);
  echo $user;
}

function search_busca($search)
{
  $conn = new ConnectionDB;
  $connection = $conn->get_connection();

  if (isset($search) && $search <> '') {
    $search = mysqli_real_escape_string($connection, $search);

    $query = mysqli_query(
      $connection,
      "SELECT username FROM users WHERE username LIKE '$search%'"
    );

    if ($query) {
      $data = [];

      while ($row = mysqli_fetch_assoc($query)) {
        $data[] = $row['username'];
      }

      echo json_encode($data); // Retorna os resultados diretos ao invés de HTML
    } else {
      echo json_encode(["status" => False, "data" => "Erro ao executar a consulta: " . mysqli_error($connection)]);
    }
  }
}
