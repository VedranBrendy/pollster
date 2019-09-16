<?php
  // Admin class
  class Admins extends Controller {
    public function __construct(){
      $this->adminModel = $this->model('Admin');
      $this->pollModel = $this->model('Poll');
    }
    /* Admin index/ Dashboard page */
   public function index(){

    // Get latest polls, number of all pols in db, total number of votes
      $data = $this->pollModel->getLatestPolls(); 
      $pollNum = $this->pollModel->getAllPollsCount();
      $totalVotes = $this->pollModel->getTotalVotesCount();

      $data = [
        'data' => $data,
        'pollNum' => $pollNum,
        'totalVotes' => $totalVotes   
      ];

      $this->view('admins/index', $data);

    }
    /* All votes table  */
    public function allVotes(){

      // Get all admins
      $allVotes = $this->pollModel->getAllVotes(); 

      $data = [

        'allvotes' => $allVotes
  
      ];
  
      $this->view('admins/allVotes', $data);

    }
    /* All Admins page */
    public function allAdmins(){
   
      $admins = $this->adminModel->getAdmins(); 

      $data = [

        'admins' => $admins
  
      ];
  
      $this->view('admins/admins', $data);

    }
    /* Regisrter new Admin */
    public function register(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        // Init data
        $data =[
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        } else {
          // Check email
          if($this->adminModel->findAdminByEmail($data['email'])){
            $data['email_err'] = 'Email is already taken';
          }
        }

        // Validate Name
        if(empty($data['name'])){
          $data['name_err'] = 'Pleae enter name';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Pleae enter password';
        } elseif(strlen($data['password']) < 6){
          $data['password_err'] = 'Password must be at least 6 characters';
        }

        // Validate Confirm Password
        if(empty($data['confirm_password'])){
          $data['confirm_password_err'] = 'Pleae confirm password';
        } else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = 'Passwords do not match';
          }
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
          // Validated    
          // Hash Password
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register Admin
          if($this->adminModel->register($data)){
            flash('register_success', 'You are registered and can log in');
            redirect('admin/login');
          } else {
            die('Something went wrong');
          }

        } else {
          // Load view with errors
          $this->view('admins/register', $data);
        }

      } else {
        // Init data
        $data =[
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => ''
        ];

        // Load view
        $this->view('admins/register', $data);
      }
    }
    /* Admin Login */
    public function login(){
      // Check for POST
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        
        // Init data
        $data =[
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_err' => '',
          'password_err' => '',      
        ];

        // Validate Email
        if(empty($data['email'])){
          $data['email_err'] = 'Pleae enter email';
        }

        // Validate Password
        if(empty($data['password'])){
          $data['password_err'] = 'Please enter password';
        }

        // Check for admin/email
        if($this->adminModel->findAdminByEmail($data['email'])){
          // Admin found
        } else {
          // Admin not found
          $data['email_err'] = 'No admin found';
        }

        // Make sure errors are empty
        if(empty($data['email_err']) && empty($data['password_err'])){
          // Validated
          // Check and set logged in admin
          $loggedInAdmin = $this->adminModel->login($data['email'], $data['password']);

          if($loggedInAdmin){
            // Create Session
            $this->createAdminSession($loggedInAdmin);
          } else {
            
            $data['password_err'] = 'Password incorrect';

            $this->view('admins/login', $data);
          }
        } else {
          // Load view with errors
          $this->view('admins/login', $data);
        }


      } else {
        // Init data
        $data =[    
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',        
        ];

        // Load view
        $this->view('admins/login', $data); 
      }
    }
    /* Create Session */
    public function createAdminSession($admin){
      $_SESSION['admin_id'] = $admin->id;
      $_SESSION['admin_email'] = $admin->email;
      $_SESSION['admin_name'] = $admin->name;
      redirect('admins/index');
    }
    /* Logout Admin */
    public function logout(){
      unset($_SESSION['admin_id']);
      unset($_SESSION['admin_email']);
      unset($_SESSION['admin_name']);
      session_destroy();
      redirect('polls');
    }
  }