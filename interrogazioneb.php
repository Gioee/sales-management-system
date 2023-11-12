<?php

include('./inc/auth-check.php');

require_once('./config.php');

$query = "SELECT CF, cognome, nome, COUNT(idOrd) AS 'numero di ordini' FROM ordinare, cliente WHERE fkOrdCF = CF GROUP BY CF HAVING COUNT(idOrd) > 3 ";

if ($stmt = $mysqli->prepare($query)) {
    if($stmt->execute()){
        $ris = $stmt->get_result();
    } else {
        $errore = $stmt->error;
    }
}


?>

    <!DOCTYPE HTML>
    <html>
<?php include('./inc/head.php') ?>
<body>

<?php include('./inc/header.php') ?>
<div id="vegc-contact">
    <?php if(isset($ris)){ ?>

        <h2 class="text-center">Interrogazione del punto 4B</h2>
        <h5 class="text-center">Visualizzare i clienti che hanno effettuato più di 3 ordini ed il numero di ordini.</h5>
        <?php if ($ris->num_rows>0) { ?>
            <div class="col-md-offset-4 text-center">
                <table class="table-condensed">
                    <tbody><tr><td>CF</td><td>Cognome</td><td>Nome</td><td>Numero di ordini</td></tr>

                    <?php
                    while ($tab = $ris->fetch_row()) {
                        echo '<tr><td>' . $tab[0] . '</td><td>' . $tab[1] . ' </td><td>' . $tab[2] . ' </td><td>' . $tab[3] . ' </td></tr>';
                    }
                    ?>
                </table>
            </div>
            <?php
        } else {
            ?>
            <p class="text-center">Nessun cliente ha effettuato pi&ugrave; di tre ordini.</p>
        <?php }
        $stmt->close();
    } else {
        if(isset($errore)){ ?>
            <p class="text-center"><?php echo $errore ?></p>
        <?php }
    } ?>
</div>
<?php include('./inc/footer.php') ?>