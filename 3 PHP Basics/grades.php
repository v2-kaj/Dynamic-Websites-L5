<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grades</title>
</head>
<body>
    <?php
        $grade = 80;
        if($grade < 50) {
            echo "<h1>Fail</h1>";
        } elseif($grade<60) {
            echo "<h1>Pass</h1>";
        } elseif($grade <75) {
            echo "<h1>Merit</h1>";
        } elseif($grade <=100) {
            echo "<h1>Distinction</h1>";
        } else{
            echo "<h1>Invalid Grade</h1>";
        }
        ?>
</body>
</html>