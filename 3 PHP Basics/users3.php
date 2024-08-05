<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php  
        $users = array("id1"=>"Ron","id2"=>"Harry","id3"=>"Hermione"); 

        forEach($users as $user){
            echo $user."<br>";
        }
    ?>
</body>
</html>