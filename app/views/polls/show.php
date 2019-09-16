<?php require APPROOT . '/views/inc/header.php';

/*  
** Show Poll page
** Page for Voting
** 
** 
*/



?>
  <?php flash('post_message'); ?>
  <div class="container">
      <h1 class="text-center">Poll</h1>
      <div class="col-md-6 offset-md-3 mb-3">
        <div class="card border-dark">
          <div class="card-body">
           <form action="<?php echo URLROOT; ?>/polls/vote/<?php echo $data['poll']->id; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $data['poll']->id; ?>">
            <h5 class="card-title"><?php echo $data['poll']->title; ?></h5>
            <h6 class="card-subtitle mb-2 text-muted"><?php echo $data['poll']->created_at; ?></h6>
            <div class="form-group">
              <div class="form-check mb-2">
                <input class="form-check-input <?php echo (!empty($data['q_err'])) ? 'is-invalid' : ''; ?>" name="q" type="radio" value="q1" id="invalidCheck">
                <label class="form-check-label" for="invalidCheck">
                  <?php echo $data['poll']->q1; ?>
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input <?php echo (!empty($data['q_err'])) ? 'is-invalid' : ''; ?>" name="q" type="radio" value="q2"id="invalidCheck">
                <label class="form-check-label" for="invalidCheck">
                  <?php echo $data['poll']->q2; ?>
                </label>
              </div>
              <div class="form-check mb-2">
                <input class="form-check-input <?php echo (!empty($data['q_err'])) ? 'is-invalid' : ''; ?>" name="q" type="radio" value="q3"id="invalidCheck">
                <label class="form-check-label" for="invalidCheck">
                  <?php echo $data['poll']->q3; ?>
                </label>
                <div class="invalid-feedback"><?php echo $data['q_err']; ?></div>
              </div>
            </div>
            <input type="submit" class="btn btn-success btn-sm" value="Vote">
            <?php if(isset($_SESSION['admin_id'])) : ?>
              <a href="<?php echo URLROOT; ?>/polls/edit/<?php echo $data['poll']->id; ?>" class="btn btn-warning btn-sm">Edit</a>
            <?php endif ?>

            </form>
          </div>
        </div>
      </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>