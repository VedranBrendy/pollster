
<?php require APPROOT . '/views/inc/header.php'; 
/*  
** Add new poll
** 
*/


?>
  <div class="container">
      <h1 class="text-center">Add New Poll</h1>
      <div class="col-md-6 offset-md-3 mb-3">
        <div class="card border-dark">
          <div class="card-body">
           <form action="<?php echo URLROOT; ?>/polls/add" method="post">
            <!-- Add Title -->
              <div class="form-group">
                <label for="title">Title: <sup>*</sup></label>
                <input type="text" name="title" class="form-control <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
              </div>
                  
              <!-- Add Poll Option 1 -->
              <div class="form-group">
                <label for="title">Poll Option 1: <sup>*</sup></label>
                <input type="text" name="q1" class="form-control <?php echo (!empty($data['q1_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['q1']; ?>">
                <span class="invalid-feedback"><?php echo $data['q1_err']; ?></span>
              </div>

              <!-- Add Poll Option 2 -->
              <div class="form-group">
                <label for="title">Poll Option 2: <sup>*</sup></label>
                <input type="text" name="q2" class="form-control <?php echo (!empty($data['q2_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['q2']; ?>">
                <span class="invalid-feedback"><?php echo $data['q2_err']; ?></span>
              </div>
      
               <!-- Add Poll Option 3 -->
              <div class="form-group">
                <label for="title">Poll Option 3: <sup>*</sup></label>
                <input type="text" name="q3" class="form-control <?php echo (!empty($data['q3_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['q3']; ?>">
                <span class="invalid-feedback"><?php echo $data['q3_err']; ?></span>
              </div>
     
            <input type="submit" class="btn btn-success btn-sm" value="Add">

            </form>
          </div>
        </div>
      </div>
    </div>
<?php require APPROOT . '/views/inc/footer.php'; ?>