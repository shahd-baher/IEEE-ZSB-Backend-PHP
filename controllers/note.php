<?php

$config = require 'config.php';
$db = new Database($config['database']);
$heading = 'Note';
$NOTE_ID = $_GET['id'];
$note = $db->query('select * from notes where id = ?', [$NOTE_ID])->findOrFail();
authorize($note['user_id'] === $USER_ID);
require 'views/note.view.php';