<?php 

    if(!isset($_SERVER['HTTP_REFERER'])){
        //redirigez-les vers l'emplacement souhaité
        header('location: http://localhost/freshcery/index.php');
        exit;
    }

?>

<?php require "../includes/header.php"; ?>

<?php 

    if(!isset($_SESSION['username'])) {
                
        echo "<script> window.location.href='".APPURL."'; </script>";

    }
    // 5379861000958477|06|2028|040
    // 5379861000958477|06|2028|040 
    // 5379861000954260|06|2028|600
?>
        <div class="banner">
            <div class="jumbotron jumbotron-bg text-center rounded-0" style="background-image: url('<?php echo APPURL; ?>/assets/img/bg-header.jpg');">
                <div class="container m-auto">
                    <h1 class="pt-5">
                    Payer avec la page Paypal
                    </h1>
                    <p class="lead">
                    Gagnez du temps et confiez-nous l'épicerie.
                    </p>
                    <!-- Replace "test" with your own sandbox Business account app client ID -->
                    <script src="https://www.paypal.com/sdk/js?client-id=AYlz4r_PV3z15ky3AmEeuQRq14d4Dn73euYutlCrITo18PmtjP53VT-w5sTnVY48KEJKWpIKyp-wEc9x&currency=USD"></script>
                    <!-- Set up a container element for the button -->
                    <div id="paypal-button-container">
                       
                    </div>
                    <script>
                        paypal.Buttons({
                        // Configure la transaction lorsqu'un bouton de paiement est cliqué
                        createOrder: (data, actions) => {
                            return actions.order.create({
                            purchase_units: [{
                                amount: {
                                value: '<?php echo $_SESSION['total_price']; ?>' // Can also reference a variable or function
                                }
                            }]
                            });
                        },
                        // Finaliser la transaction après l'approbation du payeur
                        onApprove: (data, actions) => {
                            return actions.order.capture().then(function(orderData) {
                           
                             window.location.href='success.php';
                            });
                        }
                        }).render('#paypal-button-container');
                    </script>
                  
                </div>
            </div>
        </div>


<?php require "../includes/footer.php"; ?>
