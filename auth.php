<?php
include "include/header.php";

$error = false;

$email_user = 'user@gmail.com';
$password_user = '123456';

$is_authorized = isset($_SESSION['user']['auth']) && $_SESSION['user']['auth'] == 1;
if($is_authorized) {
    header("Location: /profile.php", true, 301);
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if($email == $email_user && $password == $password_user) {
    $_SESSION = [
        'user' => [
            'name' => 'Константин',
            'auth' => 1,
        ],
    ];
    header("Location: /profile.php", true, 301);
    exit;
} elseif(isset($_POST['email'])) {
    $error = 'Неверная почта или пароль';
}

?>
    <h1>Авторизация</h1>
    <div class="row mb-3">
        <div class="col-md-4 offset-4">
            <form method="post" action="/auth.php">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $email; ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php if($error) { ?>
                <div class="alert alert-danger mt-3" role="alert"><?php echo $error; ?></div>
            <?php } ?>
        </div>
    </div>
<?php include "include/footer.php" ?>
