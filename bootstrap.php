<?php
define('ROOTDIR', __DIR__ . DIRECTORY_SEPARATOR);
session_start();
require_once ROOTDIR . 'autoload.php';
require_once ROOTDIR . 'src/helpers.php';
$PDO = (new \CT275\Labs\PDOFactory())->create([
'dbhost' => 'localhost',
'dbname' => 'ct275_comic',
'dbuser' => 'root',
'dbpass' => ''
]); 