<!-- 刪除使用者 -->
<?php

    $userId = $_GET['id'];

    include ('dbconnect.php');

    $sql_query = "DELETE FROM members WHERE cID = $userId";

    mysqli_query($db_link,$sql_query);

    $db_link->close();

    header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>