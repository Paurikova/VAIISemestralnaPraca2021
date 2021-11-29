<?php /** @var Array $data */ ?>
<div class="container">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <?php if($data['error'] != "") { ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <?= $data['error'] ?>
                </div>
            <?php } ?>
            <form method="post" action="?c=auth&a=registration">
                <div class="mb-3">
                    <label for="FormControlInput1" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="FormControlInput1" required>
                </div>
                <div class="mb-3">
                    <label for="FormControlInput2" class="form-label">Surname</label>
                    <input type="text" class="form-control" name="surname" id="FormControlInput2" required>
                </div>
                <div class="mb-3">
                    <label for="FormControlInput3" class="form-label">Email</label>
                    <input type="email" class="form-control" name="mail" id="FormControlInput3" required>
                </div>
                <div class="mb-3">
                    <label for="FormControlInput4" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password1" id="FormControlInput4" required>
                </div>
                <div class="mb-3">
                    <label for="FormControlInput5" class="form-label">Password verification</label>
                    <input type="password" class="form-control" name="password2" id="FormControlInput5" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
