<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 


  if(!isset($_SESSION['adminname'])) {
          
    echo "<script> window.location.href='".ADMINURL."/admins/login-admins.php'; </script>";

  }
  $admins = $conn->query("SELECT * FROM admins");
  $admins->execute();

  $allAdmins = $admins->fetchAll(PDO::FETCH_OBJ);


?>

      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-4 d-inline">Admins</h5>
             <a  href="<?php echo ADMINURL; ?>/admins/create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
              <table class="table  table table-bordered table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom Admin</th>
                    <th scope="col">Email</th>
                    <th scope="col">Modifier</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($allAdmins as $admin)  : ?>
                  <tr>
                    <th scope="row"><?php echo $admin->id; ?></th>
                    <td><?php echo $admin->adminname; ?></td>
                    <td><?php echo $admin->email; ?></td>
                    <td><button class="btn btn-primary">modifier</button></td>
                   
                  </tr>
                  <?php endforeach; ?>
                 
                </tbody>
              </table> 
            </div>
          </div>
        </div>
      </div>



<?php require "../layouts/footer.php"; ?>
