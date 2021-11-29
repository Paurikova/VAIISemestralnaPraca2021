<?php /** @var Array $data */?>
<div class="row article">
    <div id="demo" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <?php for ($i = 0; $i< 3; $i++) { ?>
                <button type="button" data-bs-target="#demo" data-bs-slide-to="<?php $i ?>
                   <?php if ($i == 1) { ?> class="active" <?php } ?> </button>
            <?php } ?>
        </div>
        <div class="carousel-inner">
            <?php for ($i = 0; $i < 3; $i++) { ?>
                <div class="carousel-item active">
                    <img src="<?= \App\Config\Configuration::UPLOAD_DIR .$data['new']->getPicture($i + 1)?>" alt="Picture" class="d-block" style="width:100%">
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row">
        <h3> <?= $data['new']->getTitle() ?> </h3>
        <h4> Author: <?= $data['new']->getAuthor() ?> </h4>
        <p> <?= $data['new']->getText() ?> </p>
    </div>
</div>