<?php require APPROOT . '/views/inc/header.php'; 

/*  
** Main page/ First page
** 
**
*/

?>
  <div class="jumbotron jumbotron-flud text-center">
    <div class="container">
    <h1 class="display-3"><?php echo $data['title']; ?></h1>
    <p class="lead"><?php echo $data['description']; ?></p>
    <a href="<?php echo URLROOT; ?>/polls/home" class="btn btn-primary">Polls</a>
    </div>
  </div> 
<?php require APPROOT . '/views/inc/footer.php'; ?>
