
<?php 
/*  
** Result page
** Show sum votes for poll
**
*/
// Sum votes
 $votes_sum = $data['result']->q1_v + $data['result']->q2_v + $data['result']->q3_v; 

?>

 <?php require APPROOT . '/views/inc/header.php'; ?>

  <?php flash('post_message'); ?>
  <div class="container">
      <h1 class="text-center">Results</h1>
      <div class="col-md-6 offset-md-3 mb-3">
        <div class="card border-dark">
          <div class="card-body">
            <h5 class="card-title"><?php echo $data['result']->title; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $data['result']->created_at; ?></h6>
            <p class="card-text">
            <div class="d-flex justify-content-between">
              <div class="ml-2"> <?php echo $data['result']->q1; ?></div>
              <div class="mr-4"><span class="badge badge-warning text-right">
                <?php echo $data['result']->q1_v; ?></span>
              </div>
            </div>
            </p>
           <div class="hr"></div>
            <p class="card-text">
             <div class="d-flex justify-content-between">
             <div class="ml-2"><?php echo $data['result']->q2; ?></div>
              <div class="mr-4"><span class="badge badge-warning pull-right"><?php echo $data['result']->q2_v; ?></span></div>
              </div>
            </p>
            <div class="hr"></div>
            <p class="card-text">
             <div class="d-flex justify-content-between">
             <div class="ml-2"><?php echo $data['result']->q3; ?></div> 
            <div class="mr-4"><span class="badge badge-warning pull-right"><?php echo $data['result']->q3_v; ?></span></div>
              </div>
            </p>
            <div class="d-flex justify-content-between">
            <div>
             <div><a href="<?php echo URLROOT; ?>/polls/home" class="btn btn-info btn-sm">Back to Poll</a></div>
            </div>
              <h5 class="mr-4">Votes: <span class="badge badge-secondary">
                <?php print_r($votes_sum); ?></span>
              </h5>
            </div>
           
          </div>
        </div>
      </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?> 