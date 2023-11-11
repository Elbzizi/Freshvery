<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>
<?php 

    //categories 
    $categories = $conn->query("SELECT * FROM categories");
    $categories->execute();

    $allCategories = $categories->fetchAll(PDO::FETCH_OBJ);

    //most wanted products
    $mostProducts = $conn->query("SELECT * FROM products WHERE status = 1");
    $mostProducts->execute();

    $allmostProducts = $mostProducts->fetchAll(PDO::FETCH_OBJ);


    //LÉGUMES
    $vigies = $conn->query("SELECT * FROM products WHERE status = 1 AND category_id = 1");
    $vigies->execute();

    $allVigies = $vigies->fetchAll(PDO::FETCH_OBJ);


    //VIANDES
     $meats = $conn->query("SELECT * FROM products WHERE status = 1 AND category_id = 2");
     $meats->execute();
 
     $allMeats = $meats->fetchAll(PDO::FETCH_OBJ);


    //POISSONS
    $fishes = $conn->query("SELECT * FROM products WHERE status = 1 AND category_id = 3");
    $fishes->execute();
    
    $allFishes = $fishes->fetchAll(PDO::FETCH_OBJ);



    //FRUITS
    $fruits = $conn->query("SELECT * FROM products WHERE status = 1 AND category_id = 4");
    $fruits->execute();
       
    $allFruits = $fruits->fetchAll(PDO::FETCH_OBJ);
 



    

?>
<style>
    .card-img-top{
        width: 100px;
        height: 250px;
    }
</style>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                    Page d'achat
                    </h1>
                    <p class="lead">
                    Gagnez du temps et confiez-nous l'épicerie.
                    </p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shop-categories owl-carousel mt-5">
                        <?php foreach($allCategories as $category) : ?>
                            <div class="item">
                                <a href="shop.php">
                                    <div class="media d-flex align-items-center justify-content-center">
                                        <span class="d-flex mr-2"><i class="sb-<?php echo $category->icon; ?>"></i></span>
                                        <div class="media-body">
                                            <h5><?php echo $category->name; ?></h5>
                                            <p><?php echo substr($category->description, 1, 30); ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                        
                    </div>
                </div>
            </div>
        </div>

        <section id="most-wanted">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Le plus recherché</h2>
                        <div class="product-carousel owl-carousel">
                            <?php foreach($allmostProducts as $allmostProduct) : ?>
                                <div class="item">
                                    <div class="card card-product">
                                        <div class="card-ribbon">
                                            <div class="card-ribbon-container right">
                                                <span class="ribbon ribbon-primary">SPÉCIALE</span>
                                            </div>
                                        </div>
                                        <div class="card-badge">
                                            <div class="card-badge-container left">
                                                <span class="badge badge-default">
                                                    Jusqu'à <?php echo $allmostProduct->exp_date; ?>
                                                </span>
                                                <span class="badge badge-primary">
                                                    Sold 20% 
                                                </span>
                                            </div>
                                            <img src="<?php echo IMGURLPRODUCT; ?>/<?php echo $allmostProduct->image; ?>" alt="Card image 2" class="card-img-top">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="detail-product.html"><?php echo $allmostProduct->title; ?></a>
                                            </h4>
                                            <div class="card-price">
                                                <!-- <span class="discount">Rp. 300.000</span> -->
                                                <span class="reguler"><?php echo $allmostProduct->price; ?> DHs</span>
                                            </div>
                                            <a href="<?php echo APPURL; ?>/products/detail-product.php?id=<?php echo $allmostProduct->id; ?>" class="btn btn-block btn-primary">
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

        <section id="vegetables" class="gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Légumes</h2>
                        <div class="product-carousel owl-carousel">
                            <?php foreach($allVigies as $allvigi) : ?>
                                <div class="item">
                                    <div class="card card-product">
                                        <div class="card-ribbon">
                                            <div class="card-ribbon-container right">
                                                <span class="ribbon ribbon-primary">SPÉCIALE</span>
                                            </div>
                                        </div>
                                        <div class="card-badge">
                                            <div class="card-badge-container left">
                                                <span class="badge badge-default">
                                                    Jusqu'à <?php echo $allvigi->exp_date; ?>
                                                </span>
                                                <span class="badge badge-primary">
                                                    Sold 20% 
                                                </span>
                                            </div>
                                            <img src="<?php echo IMGURLPRODUCT; ?>/<?php echo $allvigi->image; ?>" alt="Card image 2" class="card-img-top">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="detail-product.html"><?php echo $allvigi->title; ?></a>
                                            </h4>
                                            <div class="card-price">
                                                <!-- <span class="discount">Rp. 300.000</span> -->
                                                <span class="reguler"><?php echo $allvigi->price; ?> DHs</span>
                                            </div>
                                            <a href="<?php echo APPURL; ?>/products/detail-product.php?id=<?php echo $allvigi->id; ?>" class="btn btn-block btn-primary">
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

        <section id="meats">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Viandes</h2>
                        <div class="product-carousel owl-carousel">
                           <?php foreach($allMeats as $meat) : ?> 
                            <div class="item">
                                <div class="card card-product">
                                    <div class="card-ribbon">
                                        <div class="card-ribbon-container right">
                                            <span class="ribbon ribbon-primary">SPÉCIALE</span>
                                        </div>
                                    </div>
                                    <div class="card-badge">
                                        <div class="card-badge-container left">
                                            <span class="badge badge-default">
                                                Jusqu'à <?php echo $meat->exp_date; ?>
                                            </span>
                                            <span class="badge badge-primary">
                                                Sold 20% 
                                            </span>
                                        </div>
                                        <img src="<?php echo IMGURLPRODUCT; ?>/<?php echo $meat->image; ?>" alt="Card image 2" class="card-img-top">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <a href="detail-product.html"><?php echo $meat->title; ?></a>
                                        </h4>
                                        <div class="card-price">
                                            <!-- <span class="discount">Rp. 300.000</span> -->
                                            <span class="reguler"> <?php echo $meat->price; ?> DHs</span>
                                        </div>
                                        <a href="<?php echo APPURL; ?>/products/detail-product.php?id=<?php echo $meat->id; ?>" class="btn btn-block btn-primary">
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

        <section id="fishes" class="gray-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Des poissons</h2>
                        <div class="product-carousel owl-carousel">
                            <?php foreach($allFishes as $fish) : ?>
                                <div class="item">
                                    <div class="card card-product">
                                        <div class="card-ribbon">
                                            <div class="card-ribbon-container right">
                                                <span class="ribbon ribbon-primary">SPÉCIALE</span>
                                            </div>
                                        </div>
                                        <div class="card-badge">
                                            <div class="card-badge-container left">
                                                <span class="badge badge-default">
                                                    Jusqu'à <?php echo $fish->exp_date; ?>
                                                </span>
                                                <span class="badge badge-primary">
                                                    Sold 20% 
                                                </span>
                                            </div>
                                            <img src="<?php echo IMGURLPRODUCT; ?>/<?php echo $fish->image; ?>" alt="Card image 2"  class="card-img-top">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="detail-product.html"><?php echo $fish->title; ?></a>
                                            </h4>
                                            <div class="card-price">
                                                <!-- <span class="discount">Rp. 300.000</span> -->
                                                <span class="reguler"><?php echo $fish->price; ?> DHs</span>
                                            </div>
                                            <a href="<?php echo APPURL; ?>/products/detail-product.php?id=<?php echo $fish->id; ?>" class="btn btn-block btn-primary">
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

        <section id="fruits">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title">Fruits</h2>
                        <div class="product-carousel owl-carousel">
                           <?php foreach($allFruits as $fruit) : ?> 
                                <div class="item">
                                    <div class="card card-product">
                                        <div class="card-ribbon">
                                            <div class="card-ribbon-container right">
                                                <span class="ribbon ribbon-primary">SPÉCIALE</span>
                                            </div>
                                        </div>
                                        <div class="card-badge">
                                            <div class="card-badge-container left">
                                                <span class="badge badge-default">
                                                    Jusqu'à <?php echo $fruit->exp_date; ?>
                                                </span>
                                                <span class="badge badge-primary">
                                                    Sold 20% 
                                                </span>
                                            </div>
                                            <img src="<?php echo IMGURLPRODUCT; ?>/<?php echo $fruit->image; ?>" alt="Card image 2" class="card-img-top">
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <a href="detail-product.html"><?php echo $fruit->title; ?></a>
                                            </h4>
                                            <div class="card-price">
                                                <!-- <span class="discount">Rp. 300.000</span> -->
                                                <span class="reguler"> <?php echo $fruit->price; ?> DHs</span>
                                            </div>
                                            <a href="<?php echo APPURL; ?>/products/detail-product.php?id=<?php echo $fruit->id; ?>" class="btn btn-block btn-primary">
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
<?php require "includes/footer.php"; ?>

