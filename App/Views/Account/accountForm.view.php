<div class="container">
    <div class="row">
        <div class="col-sm-4 offset-sm-4">
            <form method="post" action="?c=auth&a=login">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Email</label>
                    <input type="email" class="form-control" name="mail" id="exampleFormControlInput1" required>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput2" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="exampleFormControlInput2" required>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Login</button>
                    <a id="createAccount" href="new.html">Create account</a>
                </div>
            </form>
        </div>
    </div>
</div>