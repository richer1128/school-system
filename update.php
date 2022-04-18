<!-- 取得使用者 ID -->
<?php
include "connMySQL.php";

$userID = $_GET['id'];

$sql_getDataQuery = "SELECT * FROM members WHERE cID = $userID";

 $result = mysqli_query($db_link, $sql_getDataQuery);

 $row_result = mysqli_fetch_assoc($result);
 $id = $row_result['cID'];
 $name = $row_result['cName'];
 $birthday = $row_result['cCourses'];

?>

<!-- 修改會員資料 -->

<?php
if (isset($_POST["action"]) && $_POST["action"] == 'update') 
{
    $newName = $_POST['cName'];
    $newBirthday = $_POST['cCourses'];
    
    $sql_query = "UPDATE members SET cName = '$newName', cCourses '$newCourses WHERE cID = $userID";

    mysqli_query($db_link,$sql_query);
    $db_link->close();

    header('Location :index.php');
}
?>

<!DOCTYPE html>
<html lang="tw">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>修改資料</title>
</head>
<body>

<form action="" method="post" name="formAdd" id="formAdd">
     
請輸入新課程：<input type="text" name="cCourses" id="cCourses" value="<?php echo $Courses ?>">
    <input type="hidden" name="action" value="update">
    <input type="submit" name="button" value="修改資料">
</form>    
</body>
</html>