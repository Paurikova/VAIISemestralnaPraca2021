<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-4 col-lg-4 offset-sm-12 offset-md-4 offset-lg-4">
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
            <form method="post" class="form-group" action="?c=auth&a=login">
                <div class="mb-3">
                    <label for="ControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="login" id="ControlInput1" required>
                </div>
                <div class="mb-3">
                    <label for="ControlInput2" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="ControlInput2" required>
                </div>
                <div class="mb-3 textCenter">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a href="?c=auth&a=registrationForm">Create account</a>
                </div>
            </form>
        </div>
    </div>
</div>
