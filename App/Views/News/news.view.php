<?php /** @var Array $data */ ?>
<div class="row webside">
    <div class="row">
        <?php if($data['error'] != "") { ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                <?= $data['error'] ?>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <?php foreach ($data['news'] as $new) { ?>
            <div class="col-12 col-sm-12 col-md-6 col-lg-4">
                <div class="card">
                    <img class="card-picture" src="<?= App\Config\Configuration::UPLOAD_DIR_NEWS . $new->getPictureTitle() ?>" alt="Picture1">
                    <div class="card-body">
                        <div class="card-article">
                            <a href="?c=news&a=new&newID=<?= $new->getId() ?>"> <?= $new->getTitle() ?></a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>