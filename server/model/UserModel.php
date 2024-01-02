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
    $data_entrada = mysqli_real_escape_string($conn, $data['data_entrada']);
    $dark_mode = mysqli_real_escape_string($conn, $data['dark_mode']);
    $cookies = mysqli_real_escape_string($conn, $data['cookies']);
    $img = mysqli_real_escape_string($conn, $data['img']);

    $query = mysqli_query(
      $conn,
      "INSERT INTO users(username, email, senha, profile_photo_url, full_name, bio, data_entrada, dark_mode, cookies) VALUES ('$username', '$email', '$password', '$img', '$fullname', '$bio', '$data_entrada', '$dark_mode', '$cookies')"
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
      "SELECT user_id, username, email, senha FROM users WHERE (email = '$email' AND senha = '$password') OR (username = '$email' AND senha = '$password')"
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
          $search = $search;
        }
        $query = mysqli_query(
          $connection,
          "SELECT * FROM users WHERE user_id = " . (int)$search . " OR username = '$search' OR username LIKE '$search%'"
        );

        if ($query) {
          $response = mysqli_fetch_all($query, MYSQLI_ASSOC);

          if (count($response) > 0) {
            return ["status" => 'true', "data" =>  $response[0]];
          } else {
            return ["status" => 'false', "data" => "Nenhum usuário encontrado"];
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
    $name  = mysqli_real_escape_string($conn, $data['name']);
    $bio = mysqli_real_escape_string($conn, $data['bio']);
    $img = mysqli_real_escape_string($conn, $data['image']);

    $query = mysqli_query(
      $conn,
      "UPDATE users SET bio = '$bio', profile_photo_url = '$img' WHERE username = '$name'"
    );

    // var_dump($query);

    if ($query) {
      header("Location: ../../assets/pages/perfil.php?name=" . $name);
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

  public function getSituacaoRepeatDatas($data)
  {
    $this->conn = new ConnectionDB;
    $conn = $this->conn->get_connection();
    $email = mysqli_real_escape_string($conn, $data['email']);
    $username = mysqli_real_escape_string($conn, $data['username']);

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' OR username = '$username'");

    if ($query) {
      if (mysqli_num_rows($query) == 0) {
        return false;
      } else {
        return true;
      }
    }
  }

  public function getUseCookie($data)
  {
    $this->conn = new ConnectionDB;
    $conn = $this->conn->get_connection();
    $email = mysqli_real_escape_string($conn, $data['email']);

    $query = mysqli_query($conn, "SELECT cookies FROM users WHERE email = '$email'");

    if ($query) {
      $result = mysqli_fetch_assoc($query);
      if ($result && $result['cookies'] === 'S') {
        return true;
      }
    }
    return false;
  }

  public function get_preferences_dark_mode($data)
  {
    $this->conn = new ConnectionDB;
    $conn = $this->conn->get_connection();
    $id = mysqli_real_escape_string($conn, $data);

    $query = mysqli_query($conn, "SELECT dark_mode FROM users WHERE user_id = " . (int)$id . " OR username = '$id'");

    if ($query) {
      $result = mysqli_fetch_assoc($query);
      if ($result && $result['dark_mode'] === 'S') {
        return true;
      }
    }
    return false;
  }

  public function set_preferences_dark_mode($data, $situacao)
  {
    $this->conn = new ConnectionDB;
    $conn = $this->conn->get_connection();
    $username = mysqli_real_escape_string($conn, $data);
    $situacao = mysqli_real_escape_string($conn, $situacao);

    $query = mysqli_query($conn, "UPDATE users SET dark_mode = '$situacao' WHERE username = '$username'");

    if ($query) {
      return true;
    }
    return false;
  }
}
