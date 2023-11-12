</div>
</div>
<footer id="vegc-footer">
    <div class="container">
        <div class="row row-pb-md">
            <div class="col-md-3 vegc-widget">
                <h4>VENDITA ELETTRODOMESTICI</h4>
                <p>Applicazione didattica per la vendita di elettrodomestici</p>
            </div>
            <div class="col-md-3 vegc-widget">
                <h4>Informazioni</h4>
                <p>
                <ul class="vegc-footer-links">
                    <li><a href="index.php"><i class="icon-check"></i> Home</a></li>
                    <li><a href="cliente.php"><i class="icon-check"></i>Nuovo cliente</a></li>
                    <li><a href="prodotto.php"><i class="icon-check"></i>Nuovo prodotto</a></li>
                    <li><a href="appuntamento.php"><i class="icon-check"></i>Registra appuntamento</a></li>
                    <li><a href="interrogazionea.php"><i class="icon-question"></i>Interrogazione 4A</a></li>
                    <li><a href="interrogazioneb.php"><i class="icon-question"></i>Interrogazione 4B</a></li>
                </ul>
                </p>
            </div>

            <div class="col-md-3 vegc-widget">
                <h4>Nuovi prodotti</h4>
                <?php

                require_once('./config.php');

                $query = "SELECT MAX(codice) FROM prodotto";

                if ($stmt = $mysqli->prepare($query)) {
                    if ($stmt->execute())
                        $ris = $stmt->get_result();
                    $stmt->close();
                }

                $n = $ris->fetch_row()[0];

                $query = "SELECT disponibilita, descrizione FROM prodotto WHERE codice = ?";

                if ($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_param("i", $n);
                    if ($stmt->execute())
                        $ris = $stmt->get_result();
                    $stmt->close();
                }

                $t = $ris->fetch_row();

                $disponibilita = $t[0];
                $descrizione = $t[1];

                ?>
                <div class="f-blog">
                    <a href="ordinare.php?codice=<?php echo $n ?>" class="blog-img" style="background-image: url(foto.php?codice=<?php echo $n ?>);">
                    </a>
                    <div class="desc">
                        <h2><a href="ordinare.php?codice=<?php echo $n ?>"><?php echo $descrizione ?></a></h2>
                        <p class="admin"><span>Disponibilità: <?php echo $disponibilita ?></span></p>
                    </div>
                </div>

                <?php
                $n--;
                $query = "SELECT disponibilita, descrizione FROM prodotto WHERE codice = ?";

                if ($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_param("i", $n);
                    if ($stmt->execute())
                        $ris = $stmt->get_result();
                    $stmt->close();
                }

                $t = $ris->fetch_row();

                $disponibilita = $t[0];
                $descrizione = $t[1];

                ?>

                <div class="f-blog">
                    <a href="ordinare.php?codice=<?php echo $n ?>" class="blog-img" style="background-image: url(foto.php?codice=<?php echo $n ?>);">
                    </a>
                    <div class="desc">
                        <h2><a href="ordinare.php?codice=<?php echo $n ?>"><?php echo $descrizione ?></a></h2>
                        <p class="admin"><span>Disponibilità: <?php echo $disponibilita ?></span></p>
                    </div>
                </div>

                <?php
                $n--;
                $query = "SELECT disponibilita, descrizione FROM prodotto WHERE codice = ?";

                if ($stmt = $mysqli->prepare($query)) {
                    $stmt->bind_param("i", $n);
                    if ($stmt->execute())
                        $ris = $stmt->get_result();
                    $stmt->close();
                }

                $t = $ris->fetch_row();

                $disponibilita = $t[0];
                $descrizione = $t[1];

                ?>

                <div class="f-blog">
                    <a href="ordinare.php?codice=<?php echo $n ?>" class="blog-img" style="background-image: url(foto.php?codice=<?php echo $n ?>);">
                    </a>
                    <div class="desc">
                        <h2><a href="ordinare.php?codice=<?php echo $n ?>"><?php echo $descrizione ?></a></h2>
                        <p class="admin"><span>Disponibilità: <?php echo $disponibilita ?></span></p>
                    </div>
                </div>
            </div>

            <div class="col-md-3 vegc-widget">
                <h4>Contatti</h4>
                <ul class="vegc-footer-links">
                    <li>Via G. Battista Ricci, 14, <br> Novara NO 28100</li>
                    <li><a href="tel://0321482419"><i class="icon-phone"></i> 0321 482419</a></li>
                    <li><a href="mailto:info@fauser.edu"><i class="icon-envelope"></i> info@fauser.edu</a></li>
                    <li><a href="https://www.fauser.edu/"><i class="icon-location4"></i> fauser.edu</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="copy">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | Gestione di vendite di elettrodomestici per bar e ristoranti <i class="icon-food" aria-hidden="true"></i> by Cantoni Gioele
                        <br>
                        Prodotti demo: <a href="https://www.ristoforniture.com/" target="_blank">Ristoforniture.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
</div>
