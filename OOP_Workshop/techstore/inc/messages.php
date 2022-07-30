<?php  require_once("app.php")?>

<?php if($session->has("errors")): ?>
    <div class="alert alert-danger">
        <?php foreach($session->get("errors") as $error): ?>
            <p class="mb-0"><?= $error ?></p>
        <?php endforeach; $session->remove("errors");?>
    </div>
<?php endif; ?>


<?php if($session->has("success")): ?>
    <div class="alert alert-success">
        <p class="mb-0"><?= $session->get("success") ?></p>
    </div>
<?php endif; $session->remove("success");?>