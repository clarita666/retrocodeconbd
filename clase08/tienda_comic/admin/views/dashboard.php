<div class="d-flex justify-content-center p-5">
    <div>
        <h1 class="text-center mb-5 fw-bold">PANEL DE CONTROL</h1>

        <div>
            <?=  (new Alerta)->get_alertas() ?>
        </div>

        <h2 class="text-center text-success"><?=  $userData['username'] ?></h2>
    </div>

</div>

