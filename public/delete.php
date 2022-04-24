<?php
require_once '../bootstrap.php';
use CT275\Labs\Comic;
$contact = new Comic($PDO);
if (
$_SERVER['REQUEST_METHOD'] === 'POST'
&& isset($_POST['id'])
&& ($contact->find($_POST['id'])) !== null
) {

$contact->delete();
}
redirect('/');