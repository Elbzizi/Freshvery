<?php require "../layouts/header.php"; ?>
<?php require "../../config/config.php"; ?>

<?php

if (!isset($_SESSION['adminname'])) {

  echo "<script> window.location.href='" . ADMINURL . "/admins/login-admins.php'; </script>";
}


//fetching categories 

$categories = $conn->query("SELECT * FROM categories");
$categories->execute();

$allCategories = $categories->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST['submit'])) {

  if (
    empty($_POST['title']) or empty($_POST['price'])  or empty($_POST['description'])
    or empty($_POST['category_id']) or empty($_POST['exp_date'])
  ) {

    echo "<script>alert('one or more inputs are empty')</script>";
  } else {



    $title = $_POST['title'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $exp_date = $_POST['exp_date'];
    $image = $_FILES['image']['name'];

    $dir = "img_product/" . basename($image);

    $insert = $conn->prepare("INSERT INTO products(title, price, description, category_id, exp_date, image)
            VALUES(:title, :price, :description, :category_id, :exp_date, :image)");

    $insert->execute([
      ":title" => $title,
      ":price" => $price,
      ":description" => $description,
      ":category_id" => $category_id,
      ":exp_date" => $exp_date,
      ":image" => $image,
    ]);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
      echo "<script> window.location.href='" . ADMINURL . "/products-admins/show-products.php'; </script>";
    }
  }
}


?>
<div class="row">
  <div class="col">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title mb-5 d-inline">Créer produit</h5>
        <form method="POST" action="create-products.php" enctype="multipart/form-data">
          <!-- Email input -->
          <div class="form-outline mb-4 mt-4">
            <label>Title</label>

            <input type="text" name="title" id="form2Example1" class="form-control" placeholder="title" />
          </div>

          <div class="form-outline mb-4 mt-4">
            <label>Peix</label>

            <input type="text" name="price" id="form2Example1" class="form-control" placeholder="price" />
          </div>

          <div class="form-group">
            <label for="exampleFormControlTextarea1">Description</label>
            <textarea name="description" placeholder="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1">Sélectionnez Categories</label>
            <select name="category_id" class="form-control" id="exampleFormControlSelect1">
              <option>--Sélectionnez Categories--</option>
              <?php foreach ($allCategories as $category) : ?>
                <option value="<?php echo $category->id; ?>"><?php echo $category->name; ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleFormControlSelect1">Sélectionnez la date d'expiration</label>
            <select name="exp_date" class="form-control" id="exampleFormControlSelect1">
              <option>--Sélectionnez la date d'expiration--</option>
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>

            </select>
          </div>

          <div class="form-outline mb-4 mt-4">
            <label>Image</label>

            <input type="file" name="image" id="form2Example1" class="form-control" placeholder="image" />
          </div>



          <!-- Submit button -->
          <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>


        </form>

      </div>
    </div>
  </div>
</div>
<?php require "../layouts/footer.php"; ?>