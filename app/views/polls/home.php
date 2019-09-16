<?php require APPROOT . '/views/inc/header.php'; 
/*  
** Home page
** Show all polls
**
*/

?>
   <?php flash('poll_message'); ?>
  <div class="container">
      <h1 class="text-center">Polls</h1>
      <?php foreach($data['polls'] as $poll) : ?>
      <div class="col-md-6 offset-md-3 mb-3">
        <div class="card border-dark">
          <div class="card-body">
            <h5 class="card-title"><?php echo $poll->title; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo dateTimeShow($poll->created_at); ?></h6>
            <a href="<?php echo URLROOT; ?>/polls/show/<?php echo $poll->id; ?>" class="card-link">Vote</a>
            <a href="<?php echo URLROOT; ?>/polls/results/<?php echo $poll->id; ?>" class="card-link">Results</a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>