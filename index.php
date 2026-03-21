<?php
require "functions.php";
require "router.php";
require "database.php";
$config = require 'config.php';
$db = new database($config['database']);
$id=$_GET['id'];
$query="select * from posts  where id = ?";
$posts = $db->query($query,[$id])->fetch();
dd($posts);