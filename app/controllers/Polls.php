<?php
  class Polls extends Controller {
    public function __construct(){
      $this->pollModel = $this->model('Poll');
    }

    /* Poll index page */
    public function index(){

      $data = [
        'title' => 'SharePosts',
        'description' => 'Simple poll app built on the TraversyMVC PHP framework'
      ];

      $this->view('polls/index', $data);
    }
    /* Home page with all polls */
     public function home(){
      // Get all polls
      $polls = $this->pollModel->getPolls(); 

      $data = [
        'polls' => $polls 
      ];

      $this->view('polls/home', $data);
    }
    /* About page */
      public function about(){

      $data = [
        'title' => 'About Us',
        'description' => 'Poll app'
      ];

      $this->view('polls/about', $data);
    }

    //Show poll by id
    public function show($id){
      $poll = $this->pollModel->getPollById($id);
 
      $data = [
        'poll' => $poll
      ];

      $this->view('polls/show', $data);
    }

    /* Vote, show error if radio button is empty */    
    public function vote($id){
     
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  
        $data = [
          'id' => $_POST['id'], 
          'q' => $_POST['q'],
          'q_err' => ''
        ]; 

        // Validate data
        if(empty($data['q'])){
           $data['q_err'] = 'Please enter vote option';
        }
       
        // Make sure no errors
        if(empty($data['q_err'])){

          // Validated
          if($this->pollModel->votePoll($data)){

            flash('poll_message', 'Thanke You for Voting');
            redirect('polls/home');
          } else {
            die('Something went wrong');
          }
        } else {
          //If error, redirect to same page and show red error
          $poll = $this->pollModel->getPollById($id);
 
          $data = [
            'poll' => $poll,
            'q_err' => 'Please enter vote option'
          ];
       
          // Load view with errors
          $this->view('polls/show', $data);
        }

      } else {
        // Get existing post from model
        $poll = $this->pollModel->getPollById($id);

          $data = [
          'id' => $id,
            '' => $poll->q
            ];

      $this->view('polls/show', $data);
      }
    }
    /* Show results by id */
    public function results($id){
      $result = $this->pollModel->getPollResultById($id);
      
      $data = [
        'result' => $result,
      ];

      $this->view('polls/result', $data);
    }

    /* Add new poll by Admin */
    public function add(){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'title' => trim($_POST['title']),
          'q1' => trim($_POST['q1']),
          'q2' => trim($_POST['q2']),
          'q3' => trim($_POST['q3']),
          'admin_id' => $_SESSION['admin_id'],
          'title_err' => '',
          'q1_err' => '',
          'q2_err' => '',
          'q3_err' => ''
        ];

        // Validate data
        if(empty($data['title'])){
          $data['title_err'] = 'Please enter title';
        }
        if(empty($data['q1'])){
          $data['q1_err'] = 'Please enter poll option 1';
        }

        if(empty($data['q2'])){
          $data['q2_err'] = 'Please enter poll option 2';
        }

        if(empty($data['q3'])){
          $data['q3_err'] = 'Please enter poll option 3';
        }

        // Make sure no errors
        if(empty($data['title_err']) && empty($data['q1_err']) && empty($data['q2_err']) && empty($data['q3_err'])){
          // Validated
          if($this->pollModel->addPoll($data)){
            flash('poll_message', 'Poll Added');

            redirect('polls');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('polls/add', $data);
        }

      } else {
        $data = [
          'title' => '',
          'q1' => '',
          'q2' => '',
          'q3' => '',
        ];
  
        $this->view('polls/add', $data);
      }

    }
      /* Edit poll option for Admin  */
      public function edit($id){
      
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Sanitize POST array
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'id' => $id,
          'title' => trim($_POST['title']),
          'q1' => trim($_POST['q1']),
          'q2' => trim($_POST['q2']),
          'q3' => trim($_POST['q3']),

          'title_err' => '',
          'q1_err' => '',
          'q2_err' => '',
          'q3_err' => '',
        ];

        // Validate data
        if(empty($data['title'])){
          $data['title_err'] = 'Please enter title';
        }
        if(empty($data['q1'])){
          $data['q1_err'] = 'Please enter poll option 1';
        }

        if(empty($data['q2'])){
          $data['q2_err'] = 'Please enter poll option 2';
        }
        if(empty($data['q1'])){
          $data['q3_err'] = 'Please enter poll option 3';
        }
        // Make sure no errors
        if(empty($data['title_err']) && empty($data['q1_err']) && empty($data['q2_err']) && empty($data['q3_err'])){
          // Validated
          if($this->pollModel->editPoll($data)){
            flash('poll_message', 'Poll Updated');
            redirect('polls');
          } else {
            die('Something went wrong');
          }
        } else {
          // Load view with errors
          $this->view('ž/edit', $data);
        }

      } else {
        // Get existing post from model
        $poll = $this->pollModel->getPollById($id);

        $data = [
          'id' => $id,
          'title' => $poll->title,
          'q1' => $poll->q1,
          'q2' => $poll->q2,
          'q3' => $poll->q3
        ];
  
        $this->view('polls/edit', $data);
      }
    }
  }