<?php

$config = require 'config.php';
$db = new Database($config['database']);
$heading = 'My Notes';
$notes = $db->query('select * from notes where user_id = ?',[$USER_ID])->findALl();
require 'views/notes.view.php';