<?php


$id = isset($_GET['id']) ? $_GET['id'] : FALSE;

$miObjetoComic = new Comic();

$comic = $miObjetoComic->producto_x_id($id);


?>

<div class="row">
    <?php if (isset($comic)) { ?>
        <h1 class="text-center my-5"><?=  $comic->getTitulo() ?></h1>

        <div class="col">
            <div class="card mb-3">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="img/covers/<?= $comic->getPortada() ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?=  $comic->getTitulo() ?></h5>
                            <p class="card-text"><?=  $comic->getBajada() ?></p>
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Guion: <?=  $comic->getId_guionista() ?></li>
                            <li class="list-group-item">Arte: <?= $comic->getId_artista() ?> </li>
                            <li class="list-group-item">Publicación: <?= $comic->getPublicacion()?> </li>
                        </ul>
                        <div class="card-body">
                            <p class="fs-3 mb-3 fw-bold text-danger text-center">$<?= $comic->getPrecio() ?></p>
                            <a href="#" class="btn btn-danger w-100 fw-bold">Comprar</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    <?php } else { ?>
        <h2 class="text-center m-5 text-danger">No se encontro el comic deseado</h2>
    <?php }  ?>


</div>