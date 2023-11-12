<?php

include('./inc/auth-check.php');

if(isset($_POST['submit'])){
    require_once('./config.php');

    $disponibilita = $_POST["disponibilita"];
    $descrizione = $_POST["descrizione"];
    $foto = file_get_contents($_FILES['foto']['tmp_name']);
    $consumiOrari = $_POST["consumiOrari"];
    $dimX = $_POST["dimX"];
    $dimY = $_POST["dimY"];
    $dimZ = $_POST["dimZ"];
    $formato = $_FILES['foto']['type'];

    $query = "INSERT INTO prodotto(disponibilita, descrizione, foto, consumiOrari, dimX, dimY, dimZ, formato) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("isbdddds", $disponibilita, $descrizione, $foto, $consumiOrari, $dimX, $dimY, $dimZ, $formato);
        $stmt->send_long_data(2, $foto);
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
                <div class="col-md-10 col-md-offset-1 animate-box text-center">
                    <h2>Nuovo prodotto</h2>

                    <?php if(isset($errore)){ ?>

                        <div class="alert alert-danger alert-dismissible col-md-12" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Errore:</strong> <?php echo $errore ?>
                        </div>

                    <?php } ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="number" style="height: 50px" maxlength="6" min="1" id="disponibilita" name="disponibilita" class="form-control" placeholder="Disponibilità" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-12">
                                <input type="text" maxlength="255" id="descrizione" name="descrizione" class="form-control" placeholder="Descrizione" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label for="foto" class="col-md-3 col-form-label">Immagine</label>
                            <div class="col-md-5">
                                <input type="file" name="foto" id="foto" size="50" accept="image/*" required />
                            </div>
                            <div class="col-md-4">
                                <input type="number" style="height: 50px" step="0.01" min="0" maxlength="9" id="consumiOrari" name="consumiOrari" class="form-control" placeholder="Consumi orari (in watt)" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-4">
                                <input type="number" style="height: 50px" step="0.01" min="0" maxlength="11" id="dimX" name="dimX" class="form-control" placeholder="Dimensioni dell'asse x (in mm)" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" style="height: 50px" step="0.01" min="0" maxlength="11" id="dimY" name="dimY" class="form-control" placeholder="Dimensioni dell'asse y (in mm)" required>
                            </div>
                            <div class="col-md-4">
                                <input type="number" style="height: 50px" step="0.01" min="0" maxlength="11" id="dimZ" name="dimZ" class="form-control" placeholder="Dimensioni dell'asse z (in mm)" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Invia" class="btn btn-md btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php include('./inc/footer.php') ?>