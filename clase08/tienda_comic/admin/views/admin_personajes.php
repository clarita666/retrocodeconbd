<?php 

    $personajes = (new Personaje())->lista_completa();

?>

<div class="row my-5">
    <h1 class="text-center mb-5 fw-bold">Administracion de los Personajes</h1>
    <div class="row mb-5 d-flex align-items-center">

        <div>
            <?=  (new Alerta())->get_alertas() ?>
        </div>
        
        <table class="table" >
             <thead>
                 <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Alias</th>
                    <th scope="col">Creador</th>
                    <th scope="col">Biografia</th>
                    <th scope="col">Acciones</th>
                 </tr>
             </thead>
             <tbody>
                    <?php foreach($personajes as $p){  ?>
                        <tr>
                            <td><img src="../img/personajes/<?= $p->getImagen() ?>" alt="" class="img-fluid rounded"></td>
                            <th scope="row"> <?= $p->getId() ?> </th>
                            <td><?= $p->getNombre() ?> </td>
                            <td><?= $p->getAlias() ?> </td>
                            <td><?= $p->getCreador() ?> </td>
                            <td><?= $p->getBiografia() ?> </td>
                            <td>
                                <a href="index.php?sec=edit_personajes&id=<?= $p->getId() ?>" class="btn btn-warning">Editar</a>
                                <a href="index.php?sec=delete_personajes&id=<?= $p->getId() ?>" class="btn btn-danger">Borrar</a>
                            </td>
                        </tr>

                    <?php  } ?>
             </tbody>
        </table>
            
            <a href="index.php?sec=add_personajes" class="btn btn-primary mt-5">Cargar Nuevo Personaje</a>

    </div>

</div>