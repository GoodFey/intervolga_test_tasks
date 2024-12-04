<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\models\Comment;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Comments</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

<div class="container">
    <h1>Все комментарии</h1>
    <table class="table table-striped">
        <?php
        //        При первом запуске провести миграцию в бд и seed для первоначального отображения
        //        Comment::commentsMigrate();
        //        Comment::commentsSeed(10);

        foreach (Comment::getComments() as $comment) {
            echo '<tr>';
            echo '<th scope="row">' . Comment::safeOutput($comment['nick_name']) . '</th>';
            echo '<td>' . Comment::safeOutput($comment['body_of_comment']) . '</td>';
            echo '</tr>';
        }
        ?>
    </table>

    <form action="app/requests/commentRequest.php" class="row" id="inputCommentForm" method="POST">
        <div class="col-auto">
            <label for="inputComment" class="form-label">Ваш никнейм</label>
            <input type="text" class="form-control" id="inputComment" name="nick_name" required>
        </div>
        <div class="col">
            <label for="inputComment" class="form-label">Ваш комментарий</label>
            <input type="text" class="form-control" id="inputComment" name="body_of_comment" required>
        </div>
    </form>
    <div class="row justify-content-end mt-3">
        <div class="col-auto">
            <button class="btn btn-primary" form="inputCommentForm" type="submit">Отправить</button>
        </div>
    </div>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>




