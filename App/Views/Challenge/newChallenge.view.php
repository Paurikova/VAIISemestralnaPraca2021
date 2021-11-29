<?php /** @var Array $data */ ?>
<div class="col-12 col-sm-12 col-md-8 col-lg-10">
    <div class="row">
        <?php
        foreach ($data['challenges'] as $challenge) {
        $find = false;
        foreach ($data['mychallenges'] as $mychallenge) {
            if ($challenge->getId() == $mychallenge->getChallengeID()) {
                $find = true;
                break;
            }
        }
        if (!$find) { ?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <img class="card-picture" src="<?=\App\Config\Configuration::UPLOAD_DIR . $challenge->getPicture() ?>" alt="Challenge">
                <div class="card-body">
                    <p class="card-title"><?= $challenge->getTitle() ?></p>
                    <div class="card-text"><?= $challenge->getText() ?></div>
                    <a href="?c=challenge&a=addChallenge&challengeID=<?= $challenge->getId() ?>" type="button" class="btn btn-danger btn-circle btn-xl"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
    <?php }
        }?>
    </div>
</div>