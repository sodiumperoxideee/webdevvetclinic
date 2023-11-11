<?php
    session_start();

    if(isset($_SESSION['user']) && $_SESSION['user'] == 'customer'){
        header('location: sample.php');
    }

    require_once 'classes/account.class.php';
    if(isset($_POST['login'])){
        $user = new Account();
        //sanitize
        $user->email = htmlentities($_POST['email']);
        $user->password = htmlentities($_POST['password']);
        if($user->sign_in_customer()){
            $_SESSION['user'] = 'customer';
            header('location: sample.php');
        }else{
            $error = 'Invalid email/password';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<?php
    $title = 'Login';
    require_once('include/head.php');
?>
<body>
    <?php
        require_once('include/header.user.php');
    ?>
    <main class="vh-100 d-flex align-items-center">
        <div class="container admin-login p-4">
            <h1 class="h2 brand-color mb-3 text-center">Login to your account</h1>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php if(isset($_POST['password'])){ echo $_POST['password']; } ?>">
                </div>
                <div class="mb-3">
                    <button type="submit" name="login" class="btn btn-primary brand-bg-color btn-create-account">Login</button>
                </div>
                <?php
                if(isset($_POST['login']) && isset($error)){
                ?>
                    <p class="text-danger text-center">
                        <?= $error ?>
                    </p>
                <?php
                }
                ?>
            </form>
        </div>
    </main>
    <?php
        require_once('include/js.php')
    ?>
</body>
</html>