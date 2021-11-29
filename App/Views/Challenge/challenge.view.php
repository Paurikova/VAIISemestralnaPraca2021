<?php /** @var Array $data */ ?>
<div class="col-12 col-sm-12 col-md-8 col-lg-10">
    <div class="row">
        <?php if($data['error'] != "") { ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?= $data['error'] ?>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <?php foreach ($data['mychallenges'] as $mychallenge) {
            $challenge = \App\Models\Challenge::getOne($mychallenge->getChallengeID());?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                    <div class="card-delete">
                        <a href="?c=challenge&a=deleteChallenge&deletedChallenge=<?= $mychallenge->getChallengeID()?>" role="button" class="btn btn-danger btn-circle btn-sm"><i class="fa fa-minus"></i></a>
                    </div>
                    <img class="card-picture" src="<?=\App\Config\Configuration::UPLOAD_DIR . $challenge->getPicture() ?>" alt="Challenge">
                    <div class="card-body">
                        <p class="card-title"><?= $challenge->getTitle() ?></p>
                        <div class="card-text"><?= $challenge->getText() ?></div>
                        <div class="w3-light-grey w3-round-xlarge">
                            <div id="myBar1" class="w3-container w3-round-xlarge"></div>
                        </div>
                        <a href="#" type="button" class="w3-button w3-round-xlarge">Add</a>
                    </div>
                </div>
            </div>
  <?php }?>
        <div class="col-12 col-sm-12 col-md-6 col-lg-4">
            <div class="card">
                <div class="card-delete"></div>
                <div class="card-picture"></div>
                <div class="card-body">
                    <div class="card-title">
                        <a href="?c=challenge&a=newChallenge" role="button" class="btn btn-danger btn-circle btn-xl"><i class="fa fa-plus"></i></a>
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