<?php
require_once("dbconnect.php");

$account=$_POST["account"];
$password=md5($_POST["password"]);

?>
<!DOCTYPE html>
<html lang="tw">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>建立新講師及課程資料</title>
</head>
<body>
<form action="" method="post" name="formAdd" id="formAdd">
請輸入新講師姓名：<input type="text" name="cName" id="cName"><br/>
請輸入新課程：<input type="text" name="cCourses" id="cCourses"><br/>
<input type="hidden" name="action" value="add">
<input type="submit" name="button" value="新增資料">
<input type="reset" name="button2" value="重新填寫">
</form>
</body>
</html>