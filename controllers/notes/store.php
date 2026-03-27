<?php
use Core\Validator;
use Core\App;
use Core\Database;
$db = App::resolve(Database::class);
$errors = [];
if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 is required';
}
if (! empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => 'Create a Note',
        'errors' => $errors
    ]);
}
$db->query('insert into notes (body, user_id) values (?, ?)', [$_POST['body'], 1]);
header('location: /notes');
exit();