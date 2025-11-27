<?php

    
    $id_personaje = isset($_GET['pj']) ? $_GET['pj'] : FALSE;

    $miObjectoComic = new Comic();

    $productos = $miObjectoComic->catalogo_x_personaje($id_personaje);

    $serie = (new Personaje())->get_x_id($id_personaje);



?>


<h1 class="text-center my-5">Comics de <?= $serie->getTitulo(true) ?>  </h1>


<div class="row">
    <?php  if(count($productos)){  ?>
    <?php foreach($productos as $comic){  ?>
    <div class="col-3">
        <div class="card mb-3" >
            <img src="img/covers/<?=  $comic->getPortada() ?>" class="card-img-top" alt="<?=  $comic->getTitulo() ?>">
            <div class="card-body">
                <p class="fs-6 fw-bold text-danger"><?= $comic->nombreCompleto() ?></p>
                <h5 class="card-title"><?=  $comic->getTitulo() ?></h5>
                <p class="card-text"><?=  substr($comic->getBajada(),0,60) ?>...</p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Guion: <?=  $comic->getGuion() ?></li>
                <li class="list-group-item">Arte: <?=  $comic->getArte() ?> </li>
                <li class="list-group-item">Publicación: <?=  $comic->getPublicacion() ?> </li>
            </ul>
            <div class="card-body">
                <p class="fs-3 mb-3 fw-bold text-danger text-center">$<?=  $comic->getPrecio() ?></p>
                <a href="index.php?sec=producto&id=<?= $comic->getId()  ?>" class="btn btn-danger w-100 fw-bold">Ver mas</a>
            </div>
        </div>
    </div>
    <?php } ?>

    <?php }else{ ?>
        <div class="col-12">
            <h2 class="text-center text-danger mb-5"> No se encontraron los comics</h2>
        </div>
    
    <?php } ?>   

</div>