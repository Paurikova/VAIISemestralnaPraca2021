<?php /** @var Array $data */?>
<div class="row webside">
    <div class="row article">
        <div id="carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php for ($i = 0; $i< 3; $i++) { ?>
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="<?= $i ?>"
                        <?php if ($i == 1) { ?> class="active" <?php } ?> aria-current="true" aria-label="Slide"></button>
                <?php } ?>
            </div>
            <div class="carousel-inner">
                <?php for ($i = 0; $i < 3; $i++) { ?>
                    <div class="carousel-item <?php if ($i == 1) { ?> active <?php } ?>">
                        <img src="<?= \App\Config\Configuration::UPLOAD_DIR_NEWS . $data['new']->getPicture($i + 1)?>" alt="Picture" class="d-block">
                    </div>
                <?php } ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div id = "newBody"></div>
    </div>
</div>