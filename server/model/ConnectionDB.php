<?php

namespace Model;

use Error;
use mysqli;

class ConnectionDB
{
  public $conn;
  public function get_connection()
  {
    try {
      $this->conn = new mysqli("localhost", "root", "", "instagram");
      return $this->conn;
    } catch (Error $e) {
      die("Error: " . $e->getMessage());
    }
  }
}
