<?php /** @var Array $data */ ?>
<div class="col-12 col-sm-12 col-md-10 col-lg-10">
    <div class="row">
        <?php if($data['error'] != "") { ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?= $data['error'] ?>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <?php foreach ($data['pins'] as $pin) { ?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-delete">
                        <a href="?c=pin&a=deletePin&deletedPin=<?= $pin->getId()?>" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-minus"></i></a>
                    </div>
                    <img class="card-picture" src="<?= \App\Config\Configuration::UPLOAD_DIR . $pin->getPicture() ?>" alt="Book">
                    <div class="card-body">
                        <p class="card-title"> <?= $pin->getTitle() ?></p>
                        <div class="card-text"><?= $pin->getText() ?></div>
                        <div class="ratings">
                            <?php
                            $pocet = 0;
                            for ($i = 0; $i < $pin->getStars(); $i++) { ?>
                                <i class="fa fa-star rating-color"></i>
                                <?php $pocet += 1;
                            } for ($i = 0; $i < (5-$pocet); $i++) { ?>
                                <i class="fa fa-star"></i>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        } ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-delete"></div>
                <div class="card-picture"></div>
                <div class="card-body">
                    <div class="card-title">
                        <a href="?c=pin&a=newPin" role="button" class="btn btn-danger btn-circle btn-xl"><i class="fa fa-plus"></i></a>
                    </div>
                    <div class="card-text"></div>
                    <div class="ratings">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col col-sm-0 col-md-4 col-lg-2">
    <div class="sidebar">
        <h2>News</h2>
        <?php foreach($data['news'] as $new) { ?>
            <a href="?c=news&a=new&newID=<?= $new->getId() ?> "><?= $new->getTitle() ?></a>
        <?php } ?>
    </div>
</div>



