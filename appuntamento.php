<?php

include('./inc/auth-check.php');

if(isset($_POST['submit'])){
    require_once('./config.php');

    $data = $_POST["data"];
    $ora = $_POST["ora"];
    $chilometraggioSostenuto = $_POST["chilometraggioSostenuto"];
    $matricola = $_SESSION["matricola"];
    $CF = $_POST["CF"];

    $query = "INSERT INTO appuntamento(data, ora, chilometraggioSostenuto, fkAppMatricola, fkAppCF) VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("ssdis", $data, $ora, $chilometraggioSostenuto, $matricola, $CF);
        if ($stmt->execute()) {
            header('location: index.php');
            exit();
        } else {
            $errore = $stmt->error;
            if($errore == "Cannot add or update a child row: a foreign key constraint fails (`vendite_elettrodomestici`.`appuntamento`, CONSTRAINT `appuntamento_ibfk_2` FOREIGN KEY (`fkAppCF`) REFERENCES `cliente` (`CF`))")
                $errore = "Codice Fiscale del cliente errato!";
        }
        $stmt->close();
    }
}

?>

    <!DOCTYPE HTML>
    <html>
<?php include('./inc/head.php') ?>

<body>

<script type="text/javascript">
    $(function() {
        $("#CF").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "autosuggestioncf.php",
                    minLength: 1,
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                $("#CF").val(ui.item.label);
                return false;
            },
            focus: function(event, ui) {
                console.log(ui.item.label);
                $("#CF").val(ui.item.label);
                return false;
            },
        });
    });
</script>

<?php include('./inc/header.php') ?>
    <div id="vegc-contact">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 animate-box text-center">
                    <h2>Registra appuntamento</h2>

                    <?php if(isset($errore)){ ?>

                        <div class="alert alert-danger alert-dismissible col-md-12" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Errore:</strong> <?php echo $errore ?>
                        </div>

                    <?php } ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <input style="height: 50px" type="date" id="data" name="data" class="form-control" placeholder="Data" required>
                            </div>
                            <div class="col-md-6">
                                <input style="height: 50px" type="time" id="ora" name="ora" class="form-control" placeholder="Ora" required>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-6">
                                <input style="height: 50px" type="number" min="0" step="0.01" maxlength="5" id="chilometraggioSostenuto" name="chilometraggioSostenuto" class="form-control" placeholder="Chilometraggio sostenuto" required>
                            </div>
                            <div class="col-md-6">
                                <input type="text" maxlength="16" id="CF" name="CF" class="form-control" placeholder="Codice fiscale cliente" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Registra" class="btn btn-md btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include('./inc/footer.php') ?>