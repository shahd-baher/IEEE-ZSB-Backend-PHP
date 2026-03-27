<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$errors = [];

if (! Validator::email($email)) {
    $errors['email'] = 'Provide a valid email';
}

if (! Validator::string($password, 7, 255)) {
    $errors['password'] = 'Provide a valid password (7-255 characters)';
}

if (! empty($errors)) {
    view('/registration/create.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = ?', [$email])->find();

if ($user) {
    header('location: /');
    exit();
}

else {
    $db->query('insert into users (email, password) values (?, ?) ', [$email, password_hash($password, PASSWORD_BCRYPT)]);

    login([
        'email' => $email
    ]);

    header('location: /');
    exit();
}