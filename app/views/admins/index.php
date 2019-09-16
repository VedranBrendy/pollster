<?php require APPROOT . '/views/inc/header.php';
/*  
** Admin Index/Dashboard page 
** Show total votes, polls number, latest polls
** Add new polls etc.
**
*/


?>
<?php if(!isset($_SESSION['admin_name'])): ?>
  <?php redirect('polls'); ?>
<?php else: ?>

  <div class="container">
    <div class="row">
      <i class="fas fa-cog fa-3x mr-2"></i> <h1> Dashboard</h1>
      <div class="card-deck">
      <!-- Firs Admin card: Total Votes -->
      <div class="card bg-light"  style="width: 22rem;">
      <div class="row align-items-center">
          <div class="col-md-3">
              <i class="p-4 far fa-chart-bar fa-5x"></i>
          </div>
          <div class="col-md-9 ml-auto">
            <h2 class="text-right mr-3">Total Votes</h2>
            <h2 class="text-right mr-3"><a href="#">
            <?php 
            
            foreach ($data['totalVotes'] as $totalVotes ) {
                echo $totalVotes->sum;
              }
            ?>
            </a></h2>
          </div>
      </div>
        <div class="hr"></div>
        <div class="row align-items-center">
          <i class="pl-4 pb-3 p-2 fas fa-arrow-right"></i>
          <a class="pb-2" href="<?php echo URLROOT; ?>/admins/allVotes">View all votes</a>
        </div>
      </div>

      <!-- Second Admin card: Polls -->
      <div class="card bg-light"  style="width: 22rem;">
      <div class="row align-items-center">
          <div class="col-md-3">
              <i class="p-4 far fa-clipboard fa-5x"></i>
          </div>
          <div class="col-md-9 ml-auto">
            <h2 class="text-right mr-3">Polls</h2>
            <h2 class="text-right mr-3"><a href="<?php echo URLROOT; ?>/polls/home">
            <?php 
            
            foreach ($data['pollNum'] as $pollNum ) {
                echo $pollNum->count;
              }
            ?>
            </a></h2>
          </div>
      </div>
        <div class="hr"></div>
        <div class="row align-items-center">
          <i class="pl-4 pb-3 p-2 fas fa-arrow-right"></i>
            <a class="pb-2" href="<?php echo URLROOT; ?>/polls/home">View all polls</a>
        </div>
      </div>
      <!-- Third Admin card: Add Poll -->
      <div class="card bg-light"  style="width: 22rem;">
      <div class="row align-items-center">
          <div class="col-md-3">
            <!-- <i class="p-4 fas fa-plus fa-5x"></i> -->
            <i class="p-4 fas fa-pencil-alt fa-5x"></i>
          </div>
          <div class="col-md-9 ml-auto">
            <h2 class="text-right mr-3 mt-3">Add Poll</h2>
            <h2 class="text-right mr-3">
              <a href="<?php echo URLROOT; ?>/polls/add">
                <i class="p-2 fas fa-plus"></i></a>
            </h2>
          </div>
      </div>
      <div class="hr"></div>
      <div class="row align-items-center">
        <i class="pl-4 pb-3 p-2 fas fa-arrow-right"></i>
          <a class="pb-2" href="<?php echo URLROOT; ?>/polls/add">Add new poll</a>
      </div>
      </div>
    </div>
    </div><!-- //row  -->
  </div><!-- Container -->


  <div class="container">
  <div class="row mt-3 mb-5">
    <div class="card bg-light col-md-12">
    <h4 class="my-3">Latest Polls</h4>
      <table class="table table-lg">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Poll title</th>
            <th scope="col">Created</th>
          </tr>
        </thead>
        <tbody>
        <?php $no = 0; ?>
        <?php foreach($data['data'] as $data) { ?>
        <?php $no++; ?>
          <tr>
            <th scope="row"><?php echo $no; ?></th>
            <td><?php echo $data->title; ?></td>
            <td><?php echo $data->created_at; ?></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
  </div>
  </div>
  </div>

<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>