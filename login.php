<?php

session_start();

if (isset($_SESSION["matricola"]) && $_SESSION["autenticato"] === TRUE) {
    header("location: index.php");
    exit;
}

if(isset($_POST['submit'])){
    require_once('./config.php');

    $matricola = $_POST["matricola"];
    $password = $_POST["password"];

    $query = "SELECT matricola FROM commerciale WHERE matricola = ? AND SHA2(CONCAT(salt, ?), 256) = password_hash";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("is", $matricola, $password);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();
            if(isset($row['matricola'])){
                $_SESSION['matricola'] = $row['matricola'];
                $_SESSION['autenticato'] = TRUE;
                header('location: index.php');
                exit();
            }
            else{
                $errore = "matricola o password errate!";
            }
        } else{
            $errore = $stmt->error;
        }
        $stmt->close();
    }
}

?>

    <!DOCTYPE HTML>
    <html>
<?php include('./inc/head.php') ?>

<body>
<?php include('./inc/header.php') ?>
    <div id="vegc-contact">
        <div class="container">
                <div class="text-center animate-box">
                    <h2>Accesso alla gestione di vendite</h2>

                    <?php if(isset($errore)){ ?>

                    <div class="alert alert-danger alert-dismissible col-md-offset-4 col-md-4" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Errore:</strong> <?php echo $errore ?>
                    </div>

                    <?php } ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-md-offset-4 col-md-4">
                                <input type="text" maxlength="5" id="matricola" name="matricola" class="form-control text-center" placeholder="Matricola" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-offset-4 col-md-4">
                                <input style="height: 50px" type="password" id="password" name="password" class="form-control text-center" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="LOGIN" class="btn btn-primary">
                        </div>
                    </form>
                </div>
        </div>
    </div>
<?php include('./inc/footer.php') ?>