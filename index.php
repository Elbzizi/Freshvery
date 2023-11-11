<?php require "includes/header.php"; ?>
<?php require "config/config.php"; ?>
<?php 

    $categories = $conn->query("SELECT * FROM categories");
    $categories->execute();

    $allCategories = $categories->fetchAll(PDO::FETCH_OBJ);

?>
    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-video text-center bg-dark mb-0 rounded-0">
                <video width="100%" preload="auto" loop autoplay muted>
                    <source src='assets/media/explore.mp4' type='video/mp4' />
                    <!-- <source src='assets/media/explore.webm' type='video/webm' /> -->
                </video>
                <div class="container">
                    <h1 class="pt-5">
                    Gagnez du temps et laissez le<br>
                         l'épicerie pour nous.
                    </h1>
                    <p class="lead">
                    Toujours frais tous les jours.
                    </p>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="card-icon">
                                    <div class="card-icon-i">
                                        <i class="fa fa-shopping-basket"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                    Acheter
                                    </h4>
                                    <p class="card-text">
                                    Cliquez simplement pour acheter sur le produit que vous voulez et soumettez votre commande lorsque vous avez terminé.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="card-icon">
                                    <div class="card-icon-i">
                                        <i class="fas fa-leaf"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                    Récolte
                                    </h4>
                                    <p class="card-text">
                                    Notre équipe s'assure que la qualité des produits est conforme à nos normes et livrée à votre porte dans les 24 heures suivant le jour de la récolte.
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card border-0 text-center">
                                <div class="card-icon">
                                    <div class="card-icon-i">
                                        <i class="fa fa-truck"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title">
                                    Livraison
                                    </h4>
                                    <p class="card-text">
                                    Les agriculteurs reçoivent vos commandes deux jours à l'avance afin qu'ils puissent préparer la récolte exactement comme vos commandes - pas de gaspillage de produits.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section id="why">
            <h2 class="title">Pourquoi Freshcery</h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card border-0 text-center gray-bg">
                            <div class="card-icon">
                                <div class="card-icon-i text-success">
                                    <i class="fas fa-leaf"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                En direct de la ferme
                                </h4>
                                <p class="card-text">
                                Notre concept de la ferme à la table met l'accent sur l'acheminement des produits frais directement des fermes locales à vos tables en une journée, vous savez donc que vous obtenez les produits les plus frais directement de la récolte.
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 text-center gray-bg">
                            <div class="card-icon">
                                <div class="card-icon-i text-success">
                                    <i class="fa fa-question"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                Connaissez vos agriculteurs
                                </h4>
                                <p class="card-text">
                                Nous voulons que vous sachiez exactement qui cultive votre nourriture en affichant le profil des agriculteurs sur chaque article et la page des agriculteurs. Vous êtes invités à visiter les fermes et à voir l'amour qu'elles mettent à cultiver votre nourriture.
                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 text-center gray-bg">
                            <div class="card-icon">
                                <div class="card-icon-i text-success">
                                    <i class="fas fa-smile"></i>
                                </div>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title">
                                Améliorer les moyens de subsistance des agriculteurs
                                </h4>
                                <p class="card-text">
                                Lentement mais sûrement, en coupant la chaîne d'approvisionnement complexe et le système alimentaire, nous espérons améliorer le bien-être des agriculteurs en leur donnant les revenus qu'ils méritent pour leur travail acharné.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 mt-5 text-center">
                        <a href="shop.php" class="btn btn-primary btn-lg">ACHETEZ MAINTENANT</a>
                    </div>
                </div>
            </div>
        </section>

        <section id="categories" class="pb-0 gray-bg">
            <h2 class="title">Catégories</h2>
            <div class="landing-categories owl-carousel">
              <?php foreach($allCategories as $category) : ?>  
                <div class="item">
                    <div class="card rounded-0 border-0 text-center">
                        <img src="<?php echo IMGURLCATEGORY; ?>/<?php echo $category->image; ?>">
                        <div class="card-img-overlay d-flex align-items-center justify-content-center">
                            <!-- <h4 class="card-title">Vegetables</h4> -->
                            <a href="shop.php" class="btn btn-primary btn-lg"><?php echo $category->name; ?></a>
                        </div>
                    </div>
                </div>
               <?php endforeach; ?>
            </div>
        </section>
    </div>
<?php require "includes/footer.php"; ?>
