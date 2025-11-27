<?php 


    $id = $_GET['id'] ?  $_GET['id'] : FALSE;

    $personaje = (new Personaje())->get_x_id($id);

?>


<div class="row my-5 g-3">

    <h1 class="text-center mb-5 fw-bold">¿Estas seguro que desea Eliminar el personaje?</h1>

    <div class="col-6">
            <img class="img-fluid rounded d-block mx-auto mb-3" src="../img/personajes/<?= $personaje->getImagen() ?>" alt="">
    </div>

    <div class="col-6">
        <h2 class="fs-6">Nombre del personaje</h2>
        <p><?= $personaje->getNombre() ?></p>

         <h2 class="fs-6">Alias del personaje</h2>
         <p><?= $personaje->getAlias() ?></p>

         <a class="btn btn-danger d-block mt-4" href="actions/delete_personaje_acc.php?id=<?= $personaje->getId() ?>">ELIMINAR</a>

        
        

    </div>
</div>