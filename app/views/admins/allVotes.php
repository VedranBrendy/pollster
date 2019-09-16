<?php require APPROOT . '/views/inc/header.php'; 

/*  
**  All Votes 
** Show table with all polls and votes results
** 

*/

?>

<?php if(!isset($_SESSION['admin_name'])): ?>
  <?php redirect('polls'); ?>
<?php else: ?>
<div class="container">
<div class="row mt-3 mb-5">
  <div class="card bg-light col-md-12">
  <h4 class="my-3">Latest Polls</h4>
    <table class="table table-lg">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Poll title</th>
          <th scope="col">Option 1</th>
          <th scope="col"></th>
          <th scope="col">Option 2</th>
          <th scope="col"></th>
          <th scope="col">Option 3</th>
          <th scope="col"></th>
          <th scope="col">Created</th>
        </tr>
      </thead>
      <tbody>
      <?php $no = 0; ?>
      <?php foreach($data['allvotes'] as $votes) { ?>
      <?php $no++; ?>
        <tr>
          <th scope="row"><?php echo $no; ?></th>
          <td><?php echo $votes->title; ?></td>
          <td><?php echo $votes->q1; ?></td>
          <td><h5><span class="display-5 badge badge-warning"><?php echo $votes->q1_v; ?></span></h5></td>
          <td><?php echo $votes->q2; ?></td>
          <td><h5><span class="badge badge-warning"><?php echo $votes->q2_v; ?></span></h5></td>
          <td><?php echo $votes->q3; ?></td>
          <td><h5><span class="badge badge-warning"><?php echo $votes->q3_v; ?></span></h5></td>
          <td><?php echo dateShow($votes->created_at); ?></td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
</div>
</div>
</div>

      <?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>