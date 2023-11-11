<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 

    if(!isset($_SESSION['username'])) {
            
        echo "<script> window.location.href='".APPURL."'; </script>";

    }

    $products = $conn->query("SELECT * FROM cart WHERE user_id='$_SESSION[user_id]'");
    $products->execute();

    $allProducts = $products->fetchAll(PDO::FETCH_OBJ);

    if(isset($_POST['submit'])) {
        $inp_price = $_POST['inp_price'];

        $_SESSION['price'] = $inp_price;

        echo "<script> window.location.href='".APPURL."/products/checkout.php'; </script>";

    }


?>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL; ?>/assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                    Votre panier
                    </h1>
                    <p class="lead">
                    Gagnez du temps et confiez-nous l'épicerie.
                    </p>
                </div>
            </div>
        </div>

        <section id="cart">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table text-center">
                                <thead>
                                    <tr>
                                        <th width="10%"></th>
                                        <th>produits</th>
                                        <th>Prix ​​en DHs</th>
                                        <th width="15%">Quantité</th>
                                        <th width="15%">modifier</th>
                                        <th>Sous-total en DHs</th>
                                        <th>Supprimer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php if(count($allProducts) > 0) : ?>  
                                    <?php foreach($allProducts as $product) : ?>  
                                        <tr>
                                            <td>
                                                <img src="<?php echo IMGURLPRODUCT; ?>/<?php echo $product->pro_image; ?>" width="60">
                                            </td>
                                            <td>
                                            <?php echo $product->pro_title; ?><br>
                                                <small>1000g</small>
                                            </td>
                                            <td class="pro_price">
                                               <?php echo $product->pro_price; ?>
                                            </td>
                                            <td>
                                                <input class="pro_qty form-control" type="number" min="1" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="<?php echo $product->pro_qty; ?>" name="vertical-spin">
                                            </td>

                                            <td>
                                                <button value="<?php echo $product->id; ?>" class="btn-update btn btn-primary">modifier</button>
                                            </td>
                                            <td class="subtotal_price">
                                               <?php echo $product->pro_price * $product->pro_qty; ?>
                                            </td>
                                            <td>
                                                <button value="<?php echo $product->id; ?>" class="btn-delete btn btn-primary">Supprimer</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>  
                                  <?php else : ?>
                                    <div class="alert alert-success bg-success text-white text-center">
                                    il n'y a pas encore de produits dans le panier
                                    </div>
                                  <?php endif; ?>    
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col">
                        <a href="<?php echo APPURL; ?>/shop.php" class="btn btn-default">Continuer vos achats</a>
                    </div>
                    <div class="col text-right">
                   
                        <div class="clearfix"></div>
                        <h6 class="full_price mt-3"></h6>
                        <form method="POST" action="cart.php">
                            <input class="inp_price form-control" type="hidden" value="" name="inp_price">
                            <?php if(count($allProducts) > 0) : ?>  

                                <button type="submit" name="submit" class="btn btn-lg btn-primary">le paiement  <i class="fa fa-long-arrow-right"></i></button>
                            <?php endif; ?>
                        </form>    
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php require "../includes/footer.php"; ?>


<script>
        $(document).ready(function() {

            $(".form-control").keyup(function(){
                var value = $(this).val();
                value = value.replace(/^(0*)/,"");
                $(this).val(1);
            });


            $(".pro_qty").mouseup(function () {
                //   a9rab tr
                  var $el = $(this).closest('tr');

        

                  var pro_qty = $el.find(".pro_qty").val();
                  var pro_price = $el.find(".pro_price").html();

                  var subtotal = pro_qty * pro_price ;
                  $el.find(".subtotal_price").html("") ;        

                  $el.find(".subtotal_price").append(subtotal);

                  $(".btn-update").on('click', function(e) {

                      var id = $(this).val();
                    

                      $.ajax({
                        type: "POST",
                        url: "update-product.php",
                        data: {
                          update: "update",
                          id: id,
                          pro_qty: pro_qty,
                          subtotal: subtotal
                        },

                        success: function() {
                          alert("bien modifier le Quantité");
                          //reload();
                        }
                      })
                      
                });
                 
                
                fetch();     
            });


            $(".btn-delete").on('click', function(e) {

                var id = $(this).val();


                $.ajax({

                    type: "POST",
                    url: "delete-product.php",
                    data: {
                        delete: "delete",
                        id: id,
                    },

                    success: function() {
                        alert("Le produit a été supprimé avec succès");
                        reload();
                    }
                    })
            });

            fetch();

            function fetch() {

                setInterval(function () {
                        var sum = 0.0;
                        // check subtotal
                        $('.subtotal_price').each(function()
                        {
                            // kat7awl lfloat
                            sum += parseFloat($(this).text());
                        });
                        $(".full_price").html('Total Prix in DHs: ' +sum);
                        $(".inp_price").val(sum);
                    


                }, 4000);
            } 
            


            function reload() {
                $("body").load("cart.php");
            }

        })
</script>

