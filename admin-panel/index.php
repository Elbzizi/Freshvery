<?php require "layouts/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 


  if(!isset($_SESSION['adminname'])) {
        
    echo "<script> window.location.href='".ADMINURL."/admins/login-admins.php'; </script>";

  }

  //products
  $products = $conn->query("SELECT COUNT(*) as products_num FROM products");
  $products->execute();

  $num_products = $products->fetch(PDO::FETCH_OBJ);

  //orders
  $orders = $conn->query("SELECT COUNT(*) as orders_num FROM orders");
  $orders->execute();

  $num_orders = $orders->fetch(PDO::FETCH_OBJ);

  //categories
  $categories = $conn->query("SELECT COUNT(*) as categories_num FROM categories");
  $categories->execute();

  $num_categories = $categories->fetch(PDO::FETCH_OBJ);

  //admins
  $admins = $conn->query("SELECT COUNT(*) as admins_num FROM admins");
  $admins->execute();

  $num_admins = $admins->fetch(PDO::FETCH_OBJ);



?>
<style>
/* .row{
  display: flex;
  justify-content: space-around;
  margin: 30px;
  padding: 30px;
} */
.card-body{
  width: 260px;
  height: 140px;
  text-align: center;
}
.card-text{
  font-size: 16px;
  font-weight: bold;
  color: whitesmoke;

}
</style>      
      <div class="row">
        <div class="col-md-3">
          <div class="card">
            <div class="card-body bg-info">
              <h3 class="card-title mb-4 mb-4"> produits</h3>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">nombre de produits:<br> <?php echo $num_products->products_num; ?></p>
             
            </div>
          </div>
        </div>
        <div class="col-md-3 ">
          <div class="card">
            <div class="card-body bg-warning">
              <h3 class="card-title mb-4">Commandes</h3>
              <!-- <h6 class="card-subtitle mb-2 text-muted">Bootstrap 4.0.0 Snippet by pradeep330</h6> -->
              <p class="card-text">nombre de commandes :<br> <?php echo $num_orders->orders_num; ?></p>
             
            </div>
          </div>
       
        
      </div>
     
        <div class="col-md-3 ">
          <div class="card">
            <div class="card-body bg-danger">
              <h3 class="card-title mb-4">Catégories</h3>
              
              <p class="card-text">nombre de catégories :<br> <?php echo  $num_categories->categories_num; ?></p>
              
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card">
            <div class="card-body bg-success">
              <h3 class="card-title mb-4 ">Administrateurs</h3>
              
              <p class="card-text">nombre d'administrateurs :<br> <?php echo $num_admins->admins_num; ?></p>
              
            </div>
          </div>
        </div>
      </div>
  
          <div class="row">
        <div class="col">
          <div class="card">
          <?php 

$products = $conn->query("SELECT * FROM products where price < 20");
$products->execute();

$allProducts = $products->fetchAll(PDO::FETCH_OBJ);


?>
    <div class="row">
      <div class="col">
        <div class="card">
         
            <table class="table  table table-bordered table-striped">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">product</th>
                  <th scope="col">Prix in DHs</th>
                  <th scope="col"> la date d'expiration</th>
                  <th scope="col">status</th>
                  <th scope="col">supprimer</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($allProducts as $product) : ?> 
                  <tr>
                    <th scope="row"><?php echo $product->id; ?></th>
                    <td><?php echo $product->title; ?></td>
                    <td><?php echo $product->price; ?></td>
                    <td><?php echo $product->exp_date; ?></td>
                    <?php if($product->status == 0) : ?>
                      <td><a href="<?php echo ADMINURL; ?>/products-admins/status.php?id=<?php echo $product->id; ?>&status=<?php echo $product->status; ?>" class="btn btn-warning  text-center ">indisponible</a></td>
                    <?php else : ?>
                      <td><a href="<?php echo ADMINURL; ?>/products-admins/status.php?id=<?php echo $product->id; ?>&status=<?php echo $product->status; ?>" class="btn btn-success  text-center ">disponible</a></td>
                    <?php endif; ?>  
                    <td><a href="<?php echo ADMINURL; ?>/products-admins/delete-products.php?id=<?php echo $product->id; ?>" class="btn btn-danger  text-center ">delete</a></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table> 
          </div>
        </div>
      </div>
    </div>

            </div>
          </div>
        </div>
      </div>
   
    </div>
<?php require "layouts/footer.php"; ?>
