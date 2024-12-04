<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php
include 'School.php';
School::prepareData();
?>
<div class="container">
    <table class="table table-striped" style="table-layout: fixed">
        <thead>
        <tr>
            <th scope="col"></th>
            <?php
            foreach (School::getSubjects() as $subject) {
                echo '<th scope="col">' . $subject . '</th>';
            }

            ?>
        </tr>
        </thead>
        <tbody>
        <tr>

            <?php
            foreach (School::getStudents() as $student) {
                '<tr>';
                echo '<th scope="row">' . $student . '</th>';
                foreach (School::getSubjects() as $subject) {
                    echo '<th>' . School::getPoint($student, $subject) . '</th>';
                }
                echo '</tr>';
            }
            ?>
        </tr>
        </tbody>
    </table>

</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>