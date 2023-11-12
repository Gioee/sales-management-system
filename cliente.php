<?php

include('./inc/auth-check.php');

if(isset($_POST['submit'])){
    $CF = $_POST['CF'];
    $cognome = $_POST['cognome'];
    $nome = $_POST['nome'];
    $dataNascita = $_POST['dataNascita'];
    $citta = $_POST['citta'];
    $indirizzo = $_POST['indirizzo'];
    $nTelefono = $_POST['nTelefono'];

    require_once('./config.php');

    $query = "INSERT INTO cliente(CF, cognome, nome, dataNascita, citta, indirizzo, nTelefono) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("sssssss", $CF, $cognome, $nome, $dataNascita, $citta, $indirizzo, $nTelefono);
        if ($stmt->execute()) {
            header('location: index.php');
            exit();
        } else {
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
        <div class="row">
            <div class="col-md-8 col-md-offset-2 animate-box text-center">
                <h2>Nuovo cliente</h2>

                <?php if(isset($errore)){ ?>

                    <div class="alert alert-danger alert-dismissible col-md-12" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Errore:</strong> <?php echo $errore ?>
                    </div>

                <?php } ?>

                <form action="" method="post">
                    <div class="row form-group">
                        <div class="col-md-6">
                            <input type="text" maxlength="16" id="CF" name="CF" class="form-control text-center" placeholder="Codice Fiscale" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" maxlength="30" id="cognome" name="cognome" class="form-control text-center" placeholder="Cognome" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-6">
                            <input type="text" maxlength="30" id="nome" name="nome" class="form-control text-center" placeholder="Nome" required>
                        </div>
                        <div class="col-md-6">
                            <input type="date" style="height: 50px" id="dataNascita" name="dataNascita" class="form-control text-center" placeholder="Data di nascita" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-4">
                            <input type="text" maxlength="50" id="citta" name="citta" class="form-control text-center" placeholder="Citta" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" maxlength="50" id="indirizzo" name="indirizzo" class="form-control text-center" placeholder="Indirizzo" required>
                        </div>
                        <div class="col-md-4">
                            <input type="text" maxlength="15" id="nTelefono" name="nTelefono" class="form-control text-center" placeholder="Numero di telefono" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" value="Invia" class="btn btn-md btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php include('./inc/footer.php') ?>
    </body>