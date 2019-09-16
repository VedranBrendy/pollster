<?php
  class Poll {
    private $db;

    public function __construct(){
      $this->db = new Database;
   
    }
      /* Get all polls  */
      public function getPolls(){
        $this->db->query('SELECT * FROM poll ORDER BY created_at DESC');

        $results = $this->db->resultSet();

        return $results;
    }
    // Get latest polls for admin dashboard
     public function getLatestPolls(){
      $this->db->query('SELECT title, created_at FROM poll ORDER BY created_at DESC LIMIT 5');
      
        $results = $this->db->resultSet();
        return $results;

     }
      /* Number of polls in db for admin dashboard  */
     public function getAllPollsCount(){

        $this->db->query('SELECT COUNT(*) AS count FROM poll');
        $count = $this->db->resultSet();
        return $count;

     }
    /* Number of all votes in db for admin dashboard  */
     public function getTotalVotesCount(){

        $this->db->query('SELECT SUM(q1_v + q2_v +q3_v) AS sum FROM poll_votes');
        $sum = $this->db->resultSet();
        return $sum;

     }
    /* Get one poll */
      public function getPollById($id){
        $this->db->query('SELECT * FROM poll WHERE id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }
    /* Result of privious votes  */
     public function getPollResultById($id){
        $this->db->query('SELECT *
                          FROM poll 
                          INNER JOIN poll_votes
                          ON poll.id = poll_votes.poll_id
                          WHERE poll.id = :id');
        $this->db->bind(':id', $id);
        $row = $this->db->single();

        return $row;

    }
 /* All votes in db for admin dashboard with all information */
    public function getAllVotes(){

         $this->db->query('SELECT * 
                           FROM poll 
                           INNER JOIN poll_votes
                           ON poll.id = poll_votes.poll_id
                           ORDER BY poll.created_at DESC');
      
        $results = $this->db->resultSet();
        return $results;
    }
    /* Query updates poll_votes table when user votes */
     public function votePoll($data){

      if($data['q'] == 'q1'){

        $this->db->query('UPDATE poll_votes SET q1_v = (q1_v + 1) WHERE :poll_id = poll_id');
          // Bind values
          $this->db->bind(':poll_id', $data['id']); 

    }  elseif ($data['q'] == 'q2') {
 
          $this->db->query('UPDATE poll_votes SET q2_v = (q2_v + 1) WHERE :poll_id = poll_id');
          // Bind values
          $this->db->bind(':poll_id', $data['id']);

      } elseif ($data['q'] == 'q3') {
 
          $this->db->query('UPDATE poll_votes SET q3_v = (q3_v + 1) WHERE :poll_id = poll_id');
          // Bind values
          $this->db->bind(':poll_id', $data['id']);
      } 

      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }
    }
      /* Add poll by Admin in db */
     public function addPoll($data){
      $this->db->query('INSERT INTO poll (title, q1, q2, q3, admin_id) VALUES(:title,  :q1, :q2, :q3, :admin_id)');
      // Bind values
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':q1', $data['q1']);
      $this->db->bind(':q2', $data['q2']);
      $this->db->bind(':q3', $data['q3']);
      $this->db->bind(':admin_id', $_SESSION['admin_id']);
    
      // Execute
      if($this->db->execute()){

        $last_id = $this->db->lastInsertId();
        $this->db->query('INSERT INTO poll_votes (poll_id, q1_v, q2_v, q3_v) 
                          VALUES("'.$last_id.'", 0, 0, 0)');
        
      
        return true;
      } else {
        return false;
      }

    }
    /* Edit poll by Admin */
     public function editPoll($data){

       $this->db->query('UPDATE poll SET title = :title, q1 = :q1, q2 = :q2, q3 = :q3 WHERE id = :id');
      // Bind values
      $this->db->bind(':id', $data['id']);
      $this->db->bind(':title', $data['title']);
      $this->db->bind(':q1', $data['q1']);
      $this->db->bind(':q2', $data['q2']);
      $this->db->bind(':q3', $data['q3']);
    
      // Execute
      if($this->db->execute()){
        return true;
      } else {
        return false;
      }

    
    }
}