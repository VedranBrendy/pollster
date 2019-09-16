<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
  <div class="container">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>/pages/index"><?php echo SITENAME; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/polls/home">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/polls/about">About</a>
          </li>
        </ul>
        
        
        <ul class="navbar-nav ml-auto">
          <?php if(isset($_SESSION['admin_id'])) : 
            /*  
            ** Navbar
            ** If admin is loged in show Admin Menu dropdown
            **
            */ 
            ?>
          <li class="nav-item">
              <a class="nav-link" href="#">Welcome <?php echo $_SESSION['admin_name']; ?></a>
            </li>
          <li class="nav-item">
            <div class="dropdown">
              <a class="btn btn-light btn-sm mt-1 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Admin Menu
              </a>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                <a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/index">Dashboard</a>
                <a class="dropdown-item" href="<?php echo URLROOT; ?>/polls/add">Add Poll</a>
                <a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/allAdmins">View Admins</a>
                <a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/register">Add Admin</a>
                <a class="dropdown-item" href="<?php echo URLROOT; ?>/admins/logout">Logout</a>
              </div>
            </div>
            </li>
        <?php else : ?>
        <!--     <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/admins/register">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/admins/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/admins/login">Admin</a>
            </li>   -->
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
