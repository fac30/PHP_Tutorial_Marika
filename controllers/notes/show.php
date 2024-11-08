<?php

use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 25;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$note = $db->query('select * from notes where id = :id', [
'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

$db->query('delete from notes where id = :id', [
'id' => $_GET['id']
]);

exit();
} else {
$note = $db->query('select * from notes where id = :id', [
'id' => $_GET['id']
])->findOrFail();

authorize($note['user_id'] === $currentUserId);

view("notes/show.view.php", [
'heading' => 'Note',
'note' => $note
]);
}


