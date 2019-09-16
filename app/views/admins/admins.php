<?php require APPROOT . '/views/inc/header.php'; 

/*  
** Admins 
** Table with registered Admins
**
*/

?>
<?php if(!isset($_SESSION['admin_name'])): ?>
  <?php redirect('polls'); ?>
<?php else: ?>
  <div class="container">
  <div class="row mt-3 mb-5">
    <div class="card bg-light col-md-12">
    <h4 class="my-3">Admins</h4>
      <table class="table table-lg">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Admin</th>
            <th scope="col">Email</th>
            <th scope="col">Register</th>
          </tr>
        </thead>
        <tbody>
        <?php $no = 0; ?>
        <?php foreach($data['admins'] as $admin) { ?>
        <?php $no++; ?>
          <tr>
            <th scope="row"><?php echo $no; ?></th>
            <td><?php echo $admin->adminName; ?></td>
            <td><?php echo $admin->adminEmail; ?></td>
            <td><?php echo $admin->adminRegister; ?></td>

          </tr>
        <?php } ?>
        </tbody>
      </table>
  </div>
  </div>
  </div>
<?php endif; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>