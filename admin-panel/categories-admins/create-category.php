<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php 

  if(!isset($_SESSION['adminname'])) {
          
    echo "<script> window.location.href='".ADMINURL."/admins/login-admins.php'; </script>";

  }

  if(isset($_POST['submit'])) {

    if(empty($_POST['name']) OR empty($_POST['icon'])
    OR empty($_POST['description'])) {

        echo "<script>alert('une ou plusieurs entrées sont vides')</script>";

    } else {

       

            $name = $_POST['name'];
            $icon = $_POST['icon'];
            $description = $_POST['description'];
            $image = $_FILES['image']['name'];

            $dir = "img_category/" . basename($image);

            $insert = $conn->prepare("INSERT INTO categories(name, icon, description, image)
            VALUES(:name, :icon, :description, :image)");

            $insert->execute([
                ":name" => $name,
                ":icon" => $icon,
                ":description" => $description,
                ":image" => $image,
            ]);

            if(move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
              echo "<script> window.location.href='".ADMINURL."/categories-admins/show-categories.php'; </script>";

            }


    }
  }


?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Créer  catégorie</h5>
              <form method="POST" action="create-category.php" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="Nom " />
                </div>
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="icon" id="form2Example1" class="form-control" placeholder="icon" />      
                </div>
                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Description</label>
                  <textarea name="description" placeholder="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                </div>
                <div class="form-outline mb-4 mt-4">
                  <label>Image</label>

                  <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php"; ?>
