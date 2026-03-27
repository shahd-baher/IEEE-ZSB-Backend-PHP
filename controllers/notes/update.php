<?php
use Core\App;
use Core\Database;
use Core\Validator;
$db = App::resolve(Database::class);
$currentUserId = 1;
$note = $db->query('select * from notes where id = ?', [$_POST['id']])->findOrFail();
authorize($note['user_id'] === $currentUserId);
$errors = [];
if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1,000 is required';
}
if (! empty($errors)) {
    view("notes/edit.view.php", [
    'heading' => 'Edit note!',
    'errors' => $errors,
    'note' => $note
    ]);
}
$db->query('update notes set body = ? where id = ?', [$_POST['body'], $_POST['id']]);
header('location: /notes');
exit();