<?php

include('./inc/auth-check.php');

require_once("./config.php");

$query = "SELECT codice, disponibilita, descrizione, consumiOrari, dimX, dimY, dimZ FROM prodotto";

$ris = $mysqli->query($query);

?>

<!DOCTYPE HTML>
<html>
<?php include('./inc/head.php') ?>

<body>
    <?php include('./inc/header-index.php') ?>
    <div class="vegc-blog" id="elenco">
        <div class="container">
            <div class="row">

                <?php

                while ($row = $ris->fetch_row()) {
                    $i = 0;
                    if ($i > 1 && ($i % 3) == 1)
                        echo "</div><div class='row'>";
                ?>
                    <div class="col-md-4 animate-box">
                        <article>
                            <img class="img-thumbnail img-circle" style="" src="foto.php?codice=<?php echo $row[0] ?>"/>
                            <br/>
                            <br/>
                            <h4 style="height: 4.0em;" class="author-wrap">
                                <span><?php echo $row[2] ?></span>
                            </h4>

                                <p style="height: 1em;">Disponibilità: <?php echo $row[1] ?></p>
                                <p style="height: 1em;">Potenza assorbita: <?php echo $row[3] ?> watt</p>
                                <p style="height: 3em;"><?php echo $row[4] ?>x<?php echo $row[5] ?>x<?php echo $row[6] ?>mm</p>

                            <?php if ($row[1] != 0) { ?>
                                <p style="height: 1em;" class="text-center">
                                    <a class="btn btn-primary btn-sm btn-custom" href="ordinare.php?codice=<?php echo $row[0] ?>">Ordina</a>
                                </p>
                            <?php } ?>
                        </article>
                    </div>
                <?php
                    $i++;
                }

                ?>



            </div>
        </div>

        <?php include('./inc/footer.php') ?>
</body>

</html>