<?php
  class Admin {
    private $db;

    public function __construct(){
      $this->db = new Database;
    }

    // Only admin is able to register new admin
    public function register($data){
      $this->db->query('INSERT INTO admin (name, email, password) VALUES(:name, :email, :password)');
      // Bind values
      $this->db->bind(':name', $data['name']);
      $this->db->bind(':email', $data['email']);
      $this->db->bind(':password', $data['password']);

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }

    // Login Admin
    public function login($email, $password){
      $this->db->query('SELECT * FROM admin WHERE email = :email');
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      $hashed_password = $row->password;
      if(password_verify($password, $hashed_password)){
        return $row;
      } else {
        return false;
      }
    }

    // Find admin by email
    public function findAdminByEmail($email){
      $this->db->query('SELECT * FROM admin WHERE email = :email');
      // Bind value
      $this->db->bind(':email', $email);

      $row = $this->db->single();

      // Check row
      if($this->db->rowCount() > 0){
        return true;
      } else {
        return false;
      }
    }

    // Get admin by ID
    public function getAdminById($id){
      $this->db->query('SELECT * FROM admin WHERE id = :id');
      // Bind value
      $this->db->bind(':id', $id);

      $row = $this->db->single();

      return $row;
    }
    /* Get all Admins from db for Admin table */
    public function getAdmins(){
      $this->db->query('SELECT name AS adminName, email AS adminEmail, register_at AS adminRegister FROM admin');
      $allAdmins = $this->db->resultSet();
      return $allAdmins;
    }
  }