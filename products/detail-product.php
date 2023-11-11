<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php



if (isset($_POST['submit'])) {

    $pro_id = $_POST['pro_id'];
    $pro_title = $_POST['pro_title'];
    $pro_image = $_POST['pro_image'];
    $pro_price = $_POST['pro_price'];
    $pro_qty = $_POST['pro_qty'];
    $pro_subtotal = $_POST['pro_subtotal'];
    $user_id = $_POST['user_id'];

    $insert = $conn->prepare("INSERT INTO cart (pro_id, pro_title, pro_image, pro_price,
        pro_qty, pro_subtotal, user_id) VALUES (:pro_id, :pro_title, :pro_image, :pro_price, :pro_qty, :pro_subtotal, :user_id)");

    $insert->execute([
        ':pro_id' => $pro_id,
        ':pro_title' => $pro_title,
        ':pro_image' => $pro_image,
        ':pro_price' => $pro_price,
        ':pro_qty' => $pro_qty,
        ':pro_subtotal' => $pro_subtotal,
        ':user_id' => $user_id,
    ]);
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $select = $conn->query("SELECT * FROM products WHERE status = 1 AND id='$id'");
    $select->execute();

    $product = $select->fetch(PDO::FETCH_OBJ);

    //relatedproducts

    $relatedProducts = $conn->query("SELECT * FROM products WHERE status = 1 AND
        category_id = '$product->category_id' AND id != '$id'");

    $relatedProducts->execute();

    $allRelatedProducts = $relatedProducts->fetchAll(PDO::FETCH_OBJ);



    //validating cart products
    if (isset($_SESSION['user_id'])) {

        $validate = $conn->query("SELECT * FROM cart WHERE pro_id='$id' AND user_id='$_SESSION[user_id]'");
        $validate->execute();
    }
} else {
    echo "<script> window.location.href='" . APPURL . "/404.php'; </script>";
}

?>
<style>
    .card-img-top {
        width: 100px;
        height: 250px;
    }
</style>
<div id="page-content" class="page-content">
    <div class="banner">
        <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL; ?>/assets/img/bg-header.jpg');">
            <div class="container">
                <h1 class="pt-5">
                    <?php echo $product->title; ?>
                </h1>
                <p class="lead">
                    Gagnez du temps et confiez-nous l'épicerie.
                </p>
            </div>
        </div>
    </div>
    <div class="product-detail">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="slider-zoom">
                        <!-- <a href="<?php echo APPURL; ?>/assets/img/<?php echo $product->image; ?>" class="cloud-zoom" rel="transparentImage: 'data:image/gif;base64,R0lGODlhAQABAID/AMDAwAAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==', useWrapper: false, showTitle: false, zoomWidth:'500', zoomHeight:'500', adjustY:0, adjustX:10" id="cloudZoom"> -->
                        <img alt="Detail Zoom thumbs image" src="<?php echo IMGURLPRODUCT; ?>/<?php echo $product->image; ?>" style="width: 100%;">
                        </a>
                    </div>
                </div>
                <div class="col-sm-6">
                    <p>
                        <strong>Aperçu</strong><br>
                        <?php echo $product->description; ?>
                    </p>
                    <div class="row">
                        <div class="col-sm-6">
                            <p>
                                <strong>Prix</strong> (/Kg)<br>
                                <span class="price"> <?php echo $product->price; ?> DHs</span>
                                <!-- <span class="old-price">Rp 150.000</span> -->
                            </p>
                        </div>

                    </div>
                    <p class="mb-1">
                        <strong>Quantité</strong>
                    </p>
                    <form method="POST" id="form-data">
                        <div class="row">
                            <div class="col-sm-5">
                                <input class="form-control" type="hidden" name="pro_title" value="<?php echo $product->title; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <input class="form-control" type="hidden" name="pro_image" value="<?php echo $product->image; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <input class="pro_price form-control" type="hidden" name="pro_price" value="<?php echo $product->price; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <input class="form-control" type="hidden" name="user_id" value="<?php echo (isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''); ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <input class="form-control" type="hidden" name="pro_id" value="<?php echo $product->id; ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <input class="pro_qty form-control" type="number" min="1" data-bts-button-down-class="btn btn-primary" data-bts-button-up-class="btn btn-primary" value="<?php echo $product->quantity; ?>" name="pro_qty">
                            </div>
                            <div class="col-sm-6"><span class="pt-1 d-inline-block">Paquet (1000 gram)</span></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <input class="subtotal_price form-control" type="hidden" name="pro_subtotal" value="<?php echo $product->price * $product->quantity; ?>">
                            </div>
                        </div>
                        <?php if (isset($_SESSION['username'])) : ?>
                            <?php if ($validate->rowCount() > 0) : ?>
                                <button name="submit" type="submit" class="btn-insert mt-3 btn btn-primary btn-lg" disabled>
                                    <i class="fa fa-shopping-basket"></i> Ajouté au panier
                                </button>
                            <?php else : ?>
                                <button name="submit" type="submit" class="btn-insert mt-3 btn btn-primary btn-lg">
                                    <i class="fa fa-shopping-basket"></i> Ajouté au panier
                                </button>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="mt-5 alert alert-success bg-success text-white text-center">
                                connectez-vous pour acheter ce produit ou l'ajouter au panier
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section id="related-product">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="title">Produits connexes</h2>
                    <div class="product-carousel owl-carousel">
                        <?php foreach ($allRelatedProducts as $products) : ?>
                            <div class="item">
                                <div class="card card-product">
                                    <div class="card-ribbon">
                                        <div class="card-ribbon-container right">
                                            <span class="ribbon ribbon-primary">SPECIAL</span>
                                        </div>
                                    </div>
                                    <div class="card-badge">
                                        <div class="card-badge-container left">
                                            <span class="badge badge-default">
                                                Jusqu'à <?php echo $products->exp_date; ?>
                                            </span>
                                            <span class="badge badge-primary">
                                                20% OFF
                                            </span>
                                        </div>
                                        <img src="<?php echo IMGURLPRODUCT; ?>/<?php echo $products->image; ?>" alt="Card image 2" class="card-img-top">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="detail-product.html"><?php echo $products->title; ?></a>
                                        </h4>
                                        <div class="card-price">
                                            <!-- <span class="discount">Rp. 300.000</span> -->
                                            <span class="reguler"> <?php echo $products->price; ?> DHs</span>
                                        </div>
                                        <a href="<?php echo APPURL; ?>/products/detail-product.php?id=<?php echo $products->id; ?>" class="btn btn-block btn-primary">
                                            Ajouter au panier
                                        </a>

                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php require "../includes/footer.php"; ?>

<script>
    //tsala lapage bl9raya
    $(document).ready(function() {
    //min value 1
        $(".form-control").keyup(function() {
            var value = $(this).val();
            value = value.replace(/^(0*)/, "");
            $(this).val(1);
        });

        $(".btn-insert").on("click", function(e) {
            e.preventDefault();
//serialize katjib data li flform 
            var form_data = $("#form-data").serialize() + '&submit=submit';

            $.ajax({
                url: "detail-product.php?id=<?php echo $id; ?>",
                method: "post",
                data: form_data,

                success: function() {
                    alert("product Ajouté au panier");
                    $(".btn-insert").html("<i class='fa fa-shopping-basket'></i> Ajouté au panier").prop("disabled", true);
                    withRef();
                }
            });

        });


        function withRef() {
            $("body").load("detail-product.php?id=<?php echo $id; ?>");
        }

        $(".pro_qty").mouseup(function() {


// kayjib l form 
            var $el = $(this).closest('form');


            var pro_qty = $el.find(".pro_qty").val();
            var pro_price = $el.find(".pro_price").val();

            var subtotal = pro_qty * pro_price;
            $el.find(".subtotal_price").val("");

            $el.find(".subtotal_price").val(subtotal);
        });



    })
</script>