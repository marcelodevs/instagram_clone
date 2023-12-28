<?php

namespace Model;

use Error;
use Model\ConnectionDB;

class UserClass
{

  public $conn;

  public function register($data)
  {
    $this->conn = new ConnectionDB;

    $response = "";

    $conn = $this->conn->get_connection();
    $fullname = mysqli_real_escape_string($conn, $data['fullname']);
    $username = mysqli_real_escape_string($conn, $data['username']);
    $password = mysqli_real_escape_string($conn, $data['password']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $bio = mysqli_real_escape_string($conn, $data['bio']);
    $img = mysqli_real_escape_string($conn, $data['img']);

    $query = mysqli_query(
      $conn,
      "INSERT INTO users(username, email, senha, profile_photo_url, full_name, bio) VALUES ('$username', '$email', '$password', '$img', '$fullname', '$bio')"
    );
    if ($query) {
      $response = "User  cadastrado";
    } else {
      $response = "Erro ao tentar cadastrar o produto";
    }
    return $response;
  }

  public function loginUser($data)
  {
    $this->conn = new ConnectionDB;
    $conn = $this->conn->get_connection();

    $email = mysqli_real_escape_string($conn, $data['email']);
    $password = mysqli_real_escape_string($conn, $data['password']);

    $query = mysqli_query(
      $conn,
      "SELECT user_id, username, email, senha FROM users WHERE email = '$email' AND senha = '$password'"
    );

    if ($query) {
      if (mysqli_num_rows($query) > 0) {
        $response = mysqli_fetch_assoc($query);
        return $response;
      } else {
        return "Nenhum usuario foi encontrado";
      }
    } else {
      $response = "erro ao executar mysql";
    }

    return $response;
  }

  public function list_users()
  {
    $this->conn = new ConnectionDB;
    $connection = $this->conn->get_connection();

    $query = mysqli_query($connection, "SELECT * FROM users");

    if ($query) {
      $response = array();
      while ($row = mysqli_fetch_assoc($query)) {
        $response[] = $row;
      }

      if (count($response) > 0) {
        return $response;
      } else {
        return "Nenhum usuario existente no banco de dados";
      }
    } else {
      return "Erro ao executar a consulta: " . mysqli_error($connection);
    }
  }

  public function search($search)
  {
    $this->conn = new ConnectionDB;
    $connection = $this->conn->get_connection();

    try {
      if (isset($search)) {
        if (is_array($search)) {
          $search = $search["user_id"];
        }
        $query = mysqli_query(
          $connection,
          "SELECT * FROM users WHERE user_id = " . (int)$search . " OR email = '$search'"
        );

        if ($query) {
          $response = mysqli_fetch_all($query, MYSQLI_ASSOC);

          if (count($response) > 0) {
            return ["status" => true, "data" =>  $response[0]];
          } else {
            return ["status" => False, "data" => "Nenhum usuário encontrado"];
          }
        } else {
          return ["status" => False, "data" => "Erro ao executar a consulta: " . mysqli_error($connection)];
        }
      }
    } catch (Error $e) {
      return "Error: " . $e->getMessage();
    }
  }
  public function getssSituacao($id)
  {
    $this->conn = new ConnectionDB;
    $sql = "SELECT situacao FROM users WHERE id = $id";
    $response = $this->conn->get_connection()->query($sql);
    if ($response->num_rows < 1) {
      $response = "Nenhuma situação foi encontrado!";
    }

    return $response;
  }

  public function getUsersSituacaoEmail($email)
  {
    $this->conn = new ConnectionDB;
    $sql = "SELECT situacao FROM users WHERE email = $email";
    $response = $this->conn->get_connection()->query($sql);
    if ($response->num_rows < 1) {
      $response = "Nenhuma situação foi encontrado!";
    }

    return $response;
  }

  public function updateUsers($data)
  {
    $this->conn = new ConnectionDB;


    $conn = $this->conn->get_connection();
    $id  = mysqli_real_escape_string($conn, $data['id']);
    $nome  = mysqli_real_escape_string($conn, $data['name']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $senha = mysqli_real_escape_string($conn, $data['senha']);
    $categoria = mysqli_real_escape_string($conn, $data['categoria']);
    $contato  = mysqli_real_escape_string($conn, $data['contato']);

    $query = mysqli_query(
      $conn,
      "UPDATE users SET nome = '$nome', email = '$email', senha = '$senha', info_contato = '$contato', categoria = '$categoria' WHERE id = $id"
    );
    if ($query) {
      $response = "Usuário atualizdo";
    } else {
      $response = "Erro ao tentar atualizar o usuário";
    }
    return $response;
  }

  public function resestpassword($data)
  {
    $this->conn = new ConnectionDB;
    $conn = $this->conn->get_connection();
    $senha = mysqli_real_escape_string($conn, $data['senha']);
    $query = mysqli_query(
      $conn,
      "UPDATE users SET senha = '$senha"
    );
    if ($query) {
      $response = "Senha atualizdo";
    } else {
      $response = "Erro ao tentar atualizar a senha";
    }
    return $response;
  }


  public function desactiveUser($id)
  {

    $this->conn = new ConnectionDB;
    $conn = $this->conn->get_connection();
    $id = (int)mysqli_real_escape_string($conn, $id["id"]);
    $query = mysqli_query(
      $conn,
      "UPDATE users SET excluido = 'S' WHERE id = " . $id
    );

    if ($query) {
      return "Desativado com sucesso!";
    } else {
      return "Erro ao tentar desativar o usuário!";
    }
  }
}
