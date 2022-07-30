<?php if($session->has("errors")): ?>
    <div class="alert alert-danger text-center">
        <?php foreach($session->get("errors") as $error): ?>
            <p class="mb-0"><?= $error ?></p>
        <?php endforeach; $session->remove("errors");?>
    </div>
<?php endif; ?>


<?php if($session->has("success")): ?>
    <div class="alert alert-success text-center">
        <p class="mb-0"><?= $session->get("success") ?></p>
    </div>
<?php endif; $session->remove("success");?>

