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

if (! Validator::string($password)) {
    $errors['password'] = 'Provide a valid password';
}

if (! empty($errors)) {
    view('/session/create.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = ?', [$email])->find();

if ($user) {
    if (password_verify($password, $user['password'])) {
        login([
            'email' => $email
        ]);

        header('location: /');
        exit();
    }
}

return view('/session/create.view.php',[ 
    'errors' => [
        'email' => 'No matching account for this email and password'
    ]
]);