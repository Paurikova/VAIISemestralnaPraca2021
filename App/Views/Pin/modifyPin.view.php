<?php /** @var Array $data */ ?>
<div class="col-sm-12 col-md-4 col-lg-4 offset-sm-12 offset-md-4 offset-lg-4">
    <div class="row">
        <div class="form-group">
            <?php if($data['error'] != "") { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?= $data['error'] ?>
                </div>
            <?php } ?>
        </div>
        <form class="changePin" method="post" action="?c=pin&a=changePin">
            <div class="form-group">
                <label for="idPin">Your pins</label>
                <select class="form-select" name="idPin">
                    <?php
                    foreach($data['pins'] as $pin) { ?>
                        <option value="<?= $pin->getId()?>"><?= $pin->getTitle()?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Title">Title</label>
                <input name="title" maxlength="<?= \App\Config\Configuration::MAX_LENGTH_30?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Notes">Notes</label>
                <textarea class="form-control" maxlength="<?= \App\Config\Configuration::MAX_LENGTH_95?>" name="text" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="Stars">Number of stars</label>
                <select class="form-select" name="stars">
                    <option></option>
                    <?php for($i=0; $i<=5; $i++) { ?>
                        <option><?= $i ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="File">File input</label>
                <input type="file" class="form-control-file" maxlength="<?= \App\Config\Configuration::MAX_LENGTH_30?>" name="file">
            </div>
            <div class="form-group">
                <input role="button" type="submit" class="btn btn-primary" name="pin" value="Modify">
            </div>
        </form>
    </div>
</div>