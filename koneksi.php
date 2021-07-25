<?php

class Koneksi
{
    var $host = 'localhost';
    var $username = 'root';
    var $password = '';
    var $db_name = 'pendaftaran';
    protected $conn = '';

    public function __construct()
    {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
    }
}

$conn = new Koneksi;