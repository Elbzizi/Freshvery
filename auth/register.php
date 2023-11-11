<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 

    if(isset($_SESSION['username'])) {
        
        echo "<script> window.location.href='".APPURL."'; </script>";

    }
    
    if(isset($_POST['submit'])) {

        if(empty($_POST['fullname']) OR empty($_POST['email']) OR empty($_POST['password'])
        OR empty($_POST['username'])) {

            echo "<script>alert('Une ou plusieurs entrées sont vides')</script>";

        } else {

            if($_POST['password'] == $_POST['confirm_password']) {

                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $username = $_POST['username'];
                $image = "user.png";

                $insert = $conn->prepare("INSERT INTO users(fullname, email, username, mypassword, image)
                VALUES(:fullname, :email, :username, :mypassword, :image)");

                $insert->execute([
                    ":fullname" => $fullname,
                    ":email" => $email,
                    ":mypassword" => password_hash($password, PASSWORD_DEFAULT),
                    ":username" => $username,
                    ":image" => $image
                ]);


               // header("Location: login.php");

               echo "<script> window.location.href='login.php'; </script>";

            } else {
                echo "<script>alert('Le mot de passe ne correspond pas, écrivez le mot de passe correct');</script>";

            }

          

        }
    }

?>

    <div id="page-content" class="page-content">
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL; ?>/assets/img/bg-header.jpg');">
                <div class="container">
                    <h1 class="pt-5">
                    S'inscrire
                    </h1>
                    <p class="lead">
                    Gagnez du temps et confiez-nous l'épicerie.
                    </p>

                    <div class="card card-login mb-5">
                        <div class="card-body">
                            <form class="form-horizontal" method="POST" action="register.php">
                                <div class="form-group row mt-3">
                                    <div class="col-md-12">
                                        <input class="form-control" name="fullname" type="text" required="" placeholder="Nom et prénom">
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="col-md-12">
                                        <input class="form-control" name="email" type="email" required="" placeholder="Email">
                                    </div>
                                </div>
                                
                                <div class="form-group row mt-3">
                                    <div class="col-md-12">
                                        <input class="form-control" name="username" type="text" required="" placeholder="Nom d'utilisateur">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input class="form-control" name="password" type="password" required="" placeholder="Mot de passe">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <input class="form-control" name="confirm_password" type="password" required="" placeholder="Confirmez le mot de passe">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!-- <div class="col-md-12">
                                        <div class="checkbox">
                                            <input id="checkbox0" type="checkbox" name="terms">
                                            <label for="checkbox0" class="mb-0">I Agree with <a href="terms.html" class="text-light">Terms & Conditions</a> </label>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="form-group row text-center mt-4">
                                    <div class="col-md-12">
                                        <button type="submit" name="submit" class="btn btn-primary btn-block text-uppercase">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require "../includes/footer.php"; ?>

