<?php 

    if(!isset($_SERVER['HTTP_REFERER'])){
        // redirigez-les vers l'emplacement souhaité
        header('location: http://localhost/freshcery/index.php');
        exit;
    }

?>
<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 
    if(!isset($_SESSION['username'])) {
                
        echo "<script> window.location.href='".APPURL."'; </script>";

    }




    $products = $conn->query("SELECT * FROM cart WHERE user_id='$_SESSION[user_id]'");
    $products->execute();

    $allProducts = $products->fetchAll(PDO::FETCH_OBJ);

    if(isset($_SESSION['price'])) {
        $_SESSION['total_price'] = 20 + $_SESSION['price'] ;
    }

    if(isset($_POST['submit'])) {

        if(empty($_POST['name']) OR empty($_POST['lname']) OR empty($_POST['company_name'])
        OR empty($_POST['address']) OR empty($_POST['city']) OR empty($_POST['country'])
        OR empty($_POST['zip_code']) OR empty($_POST['email']) OR empty($_POST['phone_number'])
        OR empty($_POST['order_notes'])) {

            echo "<script>alert('une ou plusieurs entrées sont vides')</script>";

        } else {


            $name = $_POST['name'];
            $lname = $_POST['lname'];
            $company_name = $_POST['company_name'];
            $address = $_POST['address'];
            $city = $_POST['city'];
            $country = $_POST['country'];
            $zip_code = $_POST['zip_code'];
            $email = $_POST['email'];
            $phone_number = $_POST['phone_number'];
            $order_notes = $_POST['order_notes'];
            $price = $_SESSION['total_price'];
            $user_id = $_SESSION['user_id'];

            $insert = $conn->prepare("INSERT INTO orders(name, lname, company_name, address, city,
           country, zip_code, email, phone_number, order_notes,  price, user_id)
            VALUES(:name, :lname, :company_name, :address, :city, :country, :zip_code, :email, :phone_number,
            :order_notes, :price, :user_id)");

            $insert->execute([
                ":name" => $name,
                ":lname" => $lname,
                ":company_name" => $company_name,
                ":address" => $address,
                ":city" => $city,
                ":country" => $country,
                ":zip_code" => $zip_code,
                ":email" => $email,
                ":phone_number" => $phone_number,
                ":order_notes" => $order_notes,
                ":price" => $price,
                ":user_id" => $user_id,
            ]);

            echo "<script> window.location.href='".APPURL."/products/charge.php'; </script>";

        }
    }



?>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL; ?>/assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                    le paiement 
                    </h1>
                    <p class="lead">
                    Gagnez du temps et confiez-nous l'épicerie.
                    </p>
                </div>
            </div>
        </div>

        <section id="checkout">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-7">
                        <h5 class="mb-3">DÉTAILS DE LA FACTURATION</h5>
                        <!-- Bill Detail of the Page -->
                        <form action="checkout.php" method="POST" class="bill-detail">
                            <fieldset>
                                <div class="form-group row">
                                    <div class="col">
                                        <input class="form-control" placeholder="Prénom" type="text" name="name">
                                    </div>
                                    <div class="col">
                                        <input class="form-control" placeholder="Nom" type="text" name="lname">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Nom de l'entreprise" type="text" name="company_name">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="address" placeholder="Adresse"></textarea>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="city" placeholder="Ville " type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="country" placeholder="État / Pays" type="text">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" name="zip_code" placeholder="Code postal" type="text">
                                </div>
                                <div class="form-group row">
                                    <div class="col">
                                        <input class="form-control" name="email" placeholder="Email Adress" type="email">
                                    </div>
                                    <div class="col">
                                        <input class="form-control" name="phone_number" placeholder="Télephone" type="tel">
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <textarea class="form-control" name="order_notes" placeholder="Notes d'ordre"></textarea>
                                </div>
                            </fieldset>
                            <button name="submit" type="submit" class="btn btn-primary float-left">PASSER À LA CAISSE<i class="fa fa-check"></i></button>

                        </form>
                        <!-- Bill Detail of the Page end -->
                    </div>
                    <div class="col-xs-12 col-sm-5">
                        <div class="holder">
                            <h5 class="mb-3">VOTRE COMMANDE</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>produits</th>
                                            <th class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($allProducts as $product) : ?>
                                            <tr>
                                                <td>
                                                    <?php echo $product->pro_title; ?> x<?php echo $product->pro_qty; ?>
                                                </td>
                                                <td class="text-right">
                                                     <?php echo $product->pro_price; ?> DHs
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                       
                                    </tbody>
                                    <tfooter>
                                        <tr>
                                            <td>
                                                <strong>Sous-total du panier</strong>
                                            </td>
                                            <td class="text-right">
                                                <?php if(isset($_SESSION['price'])) : ?>
                                                    <?php echo $_SESSION['price']; ?>  DHs
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>Livraison</strong>
                                            </td>
                                            <td class="text-right">
                                                20 DHs
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <strong>TOTAL DE LA COMMANDE</strong>
                                            </td>
                                            <td class="text-right">
                                                <strong> <?php echo   20+ $_SESSION['price'];  ?> DHs</strong>
                                            </td>
                                        </tr>
                                    </tfooter>
                                </table>
                            </div>

                         
                        </div>
                        <!-- <p class="text-right mt-3">
                            <input checked="" type="checkbox"> I’ve read &amp; accept the <a href="#">terms &amp; conditions</a>
                        </p> -->
                        <div class="clearfix">
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php require "../includes/footer.php"; ?>

