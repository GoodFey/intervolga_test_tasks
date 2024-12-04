<?php

namespace App\models;

use Carbon\Carbon;
use mysqli;

class Comment
{
    public static function connectionToDB()
    {
        return new mysqli("MySQL-8.2", "root", "", "task_2", 3306);
    }

    public static function commentsMigrate()
    {
        $sqlQueryDrop = "DROP TABLE IF EXISTS comments";
        $sqlQueryCreate = "CREATE TABLE IF NOT EXISTS comments( id int PRIMARY KEY AUTO_INCREMENT, 
            nick_name varchar(30) NOT NULL, post_date datetime NOT NULL, body_of_comment text NOT NULL);";

        $mysqli = self::connectionToDB();
        $mysqli->query($sqlQueryDrop);
        $mysqli->query($sqlQueryCreate);
    }

    public static function commentsSeed($count)
    {
        $mysqli = self::connectionToDB();
        $date = Carbon::now();

        for ($i = 1; $i <= $count; $i++) {
            $sqlQuery = "INSERT INTO comments (`nick_name`,`post_date`,`body_of_comment`) 
                VALUES ('nickname-{$i}', '{$date}', 'cool film Форсаж {$i}');";
            $mysqli->query($sqlQuery);
        }
    }

    public static function safeOutput($text)
    {
        return htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    }

    public static function getComments()
    {
        $mysqli = self::connectionToDB();
        $sqlQuery = "SELECT * FROM comments";
        return $mysqli->query($sqlQuery);

    }

    public static function store($commentRequest)
    {
        $nick_name = $commentRequest['nick_name'];
        $text = $commentRequest['body_of_comment'];
        $date = Carbon::now();

        $mysqli = self::connectionToDB();
        $sqlQuery = $mysqli->prepare("INSERT INTO comments (nick_name, post_date, body_of_comment)
            VALUES (?, '{$date}', ?);");
        $sqlQuery->bind_param("ss", $nick_name, $text);

        $sqlQuery->execute();

        header("Location: /../../index.php");
    }
}