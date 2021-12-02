<?php /** @var Array $data */ ?>
<div class="row webside">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 offset-sm-4">
                <?php if($data['error'] != "") { ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <?= $data['error'] ?>
                    </div>
                <?php } ?>
                <?php if($data['success'] != "") { ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <?= $data['success'] ?>
                    </div>
                <?php } ?>
                <form method="post" class="form-group" action="?c=auth&a=modifyAccount">
                    <div class="mb-3">
                        <label for="FormControlInput1" class="form-label">Name</label>
                        <input type="text" class="form-control" maxlength="<?= \App\Config\Configuration::MAX_LENGTH_30?>" name="name" id="FormControlInput1" placeholder="<?=$data['myAccount']->getName() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="FormControlInput2" class="form-label">Surname</label>
                        <input type="text" class="form-control" maxlength="<?= \App\Config\Configuration::MAX_LENGTH_30?>" name="surname" id="FormControlInput2" placeholder="<?=$data['myAccount']->getSurname() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="FormControlInput3" class="form-label">Email</label>
                        <input type="email" class="form-control" maxlength="<?= \App\Config\Configuration::MAX_LENGTH_30?>" name="mail" id="FormControlInput3" placeholder="<?=$data['myAccount']->getMail() ?>">
                    </div>
                    <div class="mb-3">
                        <label for="FormControlInput4" class="form-label">Password</label>
                        <input type="password" class="form-control" maxlength="<?= \App\Config\Configuration::MAX_LENGTH_30?>" name="password1" id="FormControlInput4">
                    </div>
                    <div class="mb-3">
                        <label for="FormControlInput5" class="form-label">Password verification</label>
                        <input type="password" class="form-control" maxlength="<?= \App\Config\Configuration::MAX_LENGTH_30?>" name="password2" id="FormControlInput5">
                    </div>
                    <div class="mb-3 textCenter">
                        <button type="submit" class="btn btn-primary">Modify</button>
                        <a href="?c=auth&a=deleteAccount">Remove</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
