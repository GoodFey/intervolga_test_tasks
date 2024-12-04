<?php
require_once __DIR__ . '/../../vendor/autoload.php';
use App\models\Comment;

$commentRequest = $_POST;

Comment::store($commentRequest);
