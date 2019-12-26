<div class="login_wrapper">
    <div class="animate form login_form">
        <section class="login_content">
            <form action="/login/login" method="post">
                <h1>Login Form</h1>
                <div>
                    <input type="text" name="name" class="form-control" placeholder="Username" required="" />
                </div>
                <div>
                    <input type="password" name="password" class="form-control" placeholder="Password" required="" />
                </div>
                <div>
                    <button type="submit" class="btn btn-default submit">Log in</button>
                </div>
                <?php
                $login_error = session('login_error');
                $name_error = session('name_error');
                $password_error = session('password_error');
                if($login_error){?>
                <div class="alert alert-danger" role="alert">
                    <?= $login_error ?>
                </div>
                <?php } else if($password_error){?>
                <div class="alert alert-danger" role="alert">
                    <?= $password_error ?>
                </div>
                <?php } else if($name_error){?>
                <div class="alert alert-danger" role="alert">
                    <?= $name_error ?>
                </div>
                <?php } ?>
            </form>
        </section>
    </div>
</div>