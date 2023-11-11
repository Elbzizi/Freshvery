<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>
<?php 


  if(!isset($_SESSION['adminname'])) {
          
    echo "<script> window.location.href='".ADMINURL."/admins/login-admins.php'; </script>";

  }
  if(isset($_POST['submit'])) {

    if(empty($_POST['email']) OR empty($_POST['password'])
    OR empty($_POST['adminname'])) {

        echo "<script>alert('une ou plusieurs entrées sont vides')</script>";

    } else {

       

            $email = $_POST['email'];
            $password = $_POST['password'];
            $adminname = $_POST['adminname'];

            $insert = $conn->prepare("INSERT INTO admins(email, adminname, mypassword)
            VALUES(:email, :adminname, :mypassword)");

            $insert->execute([
                ":email" => $email,
                ":mypassword" => password_hash($password, PASSWORD_DEFAULT),
                ":adminname" => $adminname,
            ]);


          // header("Location: login.php");

          echo "<script> window.location.href='".ADMINURL."/admins/admins.php'; </script>";

       

      

    }
  }



?>

       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Admins</h5>
              <form method="POST" action="create-admins.php">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="email" name="email" id="form2Example1" class="form-control" placeholder="email" />
                 
                </div>

                <div class="form-outline mb-4">
                  <input type="text" name="adminname" id="form2Example1" class="form-control" placeholder="adminname" />
                </div>
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form2Example1" class="form-control" placeholder="password" />
                </div>

               
            
                
              


                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php"; ?>
