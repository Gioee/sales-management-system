<?php

include('./inc/auth-check.php');

if(isset($_POST['submit'])){
    require_once('./config.php');

    $CF = $_POST["CF"];

    $query = "SELECT idOrd, data FROM ordinare, cliente WHERE fkOrdCF = ? AND EXTRACT(YEAR_MONTH FROM data) = EXTRACT(YEAR_MONTH FROM NOW()) GROUP BY idOrd";

    if ($stmt = $mysqli->prepare($query)) {
        $stmt->bind_param("s", $CF);
        if($stmt->execute()){
            $ris = $stmt->get_result();
        } else {
            $errore = $stmt->error;
        }
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
                    <h2>Interrogazione del punto 4A</h2>
                    <h5 class="text-center">Dato in input il codice di un cliente, visualizzare codice e data degli ordini effettuati nell’ultimo mese.</h5>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row form-group">
                            <div class="col-md-offset-3 col-md-6">
                                <input type="text" maxlength="16" id="CF" name="CF" class="form-control text-center" placeholder="Codice fiscale del cliente" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Interroga" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php if(isset($ris)){ ?>

            <h3 class="text-center">Risultato interrogazione</h3>
            <?php if ($ris->num_rows>0) { ?>
                <div class="col-md-offset-5 text-center">
                <table class="table-condensed">
                    <tbody><tr><td>Codice ordine</td><td>Data ordine</td></tr>

                    <?php
                    while ($tab = $ris->fetch_row()) {
                        echo '<tr><td>' . $tab[0] . '</td><td>' . $tab[1] . ' </td></tr>';
                    }
                    ?>
                </table>
                </div>
                <?php
            } else {
                ?>
                <p class="text-center">Nessun risultato per questo codice fiscale</p>
            <?php }
        $stmt->close();
        } else {
            if(isset($errore)){ ?>
                <p class="text-center"><?php echo $errore ?></p>
            <?php }
        } ?>
    </div>
<?php include('./inc/footer.php') ?>