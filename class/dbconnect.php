<?php
header('Content-Type: text/html; charset=utf-8');
  print('<html><head>');
  print('<meta http-equiv="Content-Type"'.
    ' content="text/html; charset=utf-8"/>');
  print('</head><body>'."\n");
function conn(){
    $servername = "localhost";
    $username = "admin29";
    $password = "20220329";
    $db="test";
    // 建立連線
    $conn = new mysqli($servername, $username, $password, $db);
    // 檢查連線
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    echo "<h1>Connected successfully</h1>";
    mysqli_query($conn, "SET character_set_client=utf8");
    mysqli_query($conn, "SET character_set_connection=utf8");
    return $conn;
}



//老師註冊
function stuRegister(){
  require_once("db_connect.php")
  $teaName=$_POST["teaName"];
  $teaAccount=$_POST["teaAccount"];
  $password=md5($_POST["password"]);
  $dpassword=md5($_POST["dpassword"]);
  $gender=$_POST["gender"];
  $major=$_POST["major"];
  $grade=$_POST["grade"];
//過濾空格
$teaName = trim($teaName);
$teaAccount = trim($teaAccount);
$password = trim($password);
$dpassword = trim($dpassword);
//帳號判斷

if($teaAccount == "" && $password == "" && $dpassword == ""){
  echo "[{\"result\":\"您的帳號或密碼有誤\"}]";
}else if($teaAccount == "" && $password == ""){
  echo "[{\"result\":\"您的帳號或密碼有誤\"}]";
}else if ($password == "" && $dpassword == "") {
  echo "[{\"result\":\"您的密碼有誤\"}]";
}else if($teaAccount == "" && $dpassword == ""){
  echo "[{\"result\":\"您的帳號或密碼有誤\"}]";
}else if ($teaAccount == "") {
  echo "[{\"result\":\"帳號未輸入\"}]";
}else if ($password == "") {
  echo "[{\"result\":\"密碼未輸入\"}]";
}else if ($dpassword == "") {
  echo "[{\"result\":\"密碼不一致\"}]";
}else if ($password !== $dpassword) {
  echo "[{\"result\":\"密碼不一致\"}]";
}else if (strlen($teaAccount) < 5){
  echo "[{\"result\":\"帳號不能小於五位數字\"}]";
}else if (strlen($password) < 8){
  echo "[{\"result\":\"密碼不能小於八位數字\"}]";
}else if (preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $teaAccount)>0){
  echo "[{\"result\":\"帳號不能為中文\"}]";
}else if (preg_match('/[\x{4e00}-\x{9fa5}]/u', $teaAccount)>0){
  echo "[{\"result\":\"帳號不能存在中文\"}]";
}else if(preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$teaAccount)){
  echo "[{\"result\":\"帳號不能使用特殊符號\"}]";
}else{

    //查看DB是否已有存在帳號
    $exist = mysql_query("SELECT * FROM teacher WHERE teaAccount = '$teaAccount'");
    $exist_result = mysql_num_rows($exist);
    if($exist_result){
        //如果有
        echo "[{\"result\":\"該帳號已被註冊\"}]";
    }else{
        //如果沒有建至DB

        if ($conn->query($sql) === TRUE) {
          echo "註冊成功<br>";
          $last_id = $conn->insert_id;
          echo "id 為 $last_id";
          } else {
            //如果沒有建至DB
    
            if ($conn->query($sql) === TRUE) {
              echo "註冊成功<br>";
              $sql="INSERT INTO teacher ( teaName, teaAccount, password, dpassword, gender,	major, grade)
              VALUES ( '$teaName', '$teaAccount', '$password','$dpassword', '$gender', '$major','$grade')";
              $last_id = $conn->insert_id;
              echo "id 為 $last_id";
              $conn->close();
              header("location: tealogin.php");
              } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                header("location: stuRegister.php");
              }
      }
}
//學生註冊
function stuRegister()
{
          require_once("db_connect.php")
          $stuName=$_POST["stuName"];
          $stuaAccount=$_POST["stuaAccount"];
          $password=md5($_POST["password"]);
          $dpassword=md5($_POST["dpassword"]);
          $gender=$_POST["gender"];
          $major=$_POST["major"];
          $grade=$_POST["grade"];
//過濾空格
          $stuName = trim($stuName);
          $stuaAccount = trim($stuaAccount);
          $password = trim($password);
          $dpassword = trim($dpassword);
//帳號判斷

    if($stuaAccount == "" && $password == "" && $dpassword == ""){
      echo "[{\"result\":\"您的帳號或密碼有誤\"}]";
    }else if($stuaAccount == "" && $password == ""){
      echo "[{\"result\":\"您的帳號或密碼有誤\"}]";
    }else if ($password == "" && $dpassword == "") {
      echo "[{\"result\":\"您的密碼有誤\"}]";
    }else if($stuaAccount == "" && $dpassword == ""){
      echo "[{\"result\":\"您的帳號或密碼有誤\"}]";
    }else if ($stuaAccount == "") {
      echo "[{\"result\":\"帳號未輸入\"}]";
    }else if ($password == "") {
      echo "[{\"result\":\"密碼未輸入\"}]";
    }else if ($dpassword == "") {
      echo "[{\"result\":\"密碼不一致\"}]";
    }else if ($password !== $dpassword) {
      echo "[{\"result\":\"密碼不一致\"}]";
    }else if (strlen($stuaAccount) < 5){
      echo "[{\"result\":\"帳號不能小於五位數字\"}]";
    }else if (strlen($password) < 8){
      echo "[{\"result\":\"密碼不能小於八位數字\"}]";
    }else if (preg_match('/^[\x{4e00}-\x{9fa5}]+$/u', $stuaAccount)>0){
      echo "[{\"result\":\"帳號不能為中文\"}]";
    }else if (preg_match('/[\x{4e00}-\x{9fa5}]/u', $stuaAccount)>0){
      echo "[{\"result\":\"帳號不能存在中文\"}]";
    }else if(preg_match("/[\'.,:;*?~`!@#$%^&+=)(<>{}]|\]|\[|\/|\\\|\"|\|/",$stuaAccount)){
      echo "[{\"result\":\"帳號不能使用特殊符號\"}]";
    }else{

//查看DB是否已有存在帳號
    $exist = mysql_query("SELECT * FROM student WHERE stuaAccount = '$stuaAccount'");
    $exist_result = mysql_num_rows($exist);
    if($exist_result){
//如果有
        echo "[{\"result\":\"該帳號已被註冊\"}]";

    }else{
//如果沒有建至DB

    if ($conn->query($sql) === TRUE) {
      echo "註冊成功<br>";
      $sql="INSERT INTO 	student ( stuName, stuaAccount, password, dpassword, gender,	major, grade)
      VALUES ( '$name', '$password', '$account', '$gender', '$major','$grade')";
      $last_id = $conn->insert_id;
      echo "id 為 $last_id";
      $conn->close();
      header("location: stuLogin.php");
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        header("location: stuRegister.php");
      }
    }
}


//老師登入
function teaLogin(){
  session_start();
  require_once("db_connect.php")
  $account=$_POST["account"];
  $password=md5($_POST["password"]);

  $sql="SELECT * FROM teacher WHERE account = '$acctount' AND password = '$password'";

if ($conn->query($sql) == TRUE) {
  $result = $conn->query($sql);
  $teacherCount=$result->rum_rows;
  if$($teacherCount>0) {
    echo "登入成功";
    $teacher=$result->fetch_ass0c();

    $data=[ "account"=>$teacher["account"]
  ];
  $_SESSION["teacher"]=$data;
  unset($_SESSION["error"]);
  var_dump($_SESSION["teacher"]);
  header("location:teaCourses.php");
  }else{
    echo "登入失敗";
    if(isset($_SESSION["error"]["times"])){
      $_SESSION["error"]["times"]++;     
    }else{
      $_SESSION["error"]["times"]=1;  
    }
    $_SESSION["eoor"]["message"]="帳號或密碼錯誤";
    header("location: dashboard.php");
  } 
} else {
  echo "" . $conn->error;
}
}


//學生登入
function stuLogin(){
  session_start();
  require_once("db_connect.php")
  $account=$_POST["account"];
  $password=md5($_POST["password"]);

  $sql="SELECT * FROM student WHERE account = '$acctount' AND password = '$password'";
if ($conn->query($sql) == TRUE) {
  $result = $conn->query($sql);
  $studentCount=$result->rum_rows;
  if$($studentCount>0) {
    echo "登入成功";
    $student=$result->fetch_ass0c();

    $data=[ "account"=>$student["account"]
  ];
  $_SESSION["student"]=$data;
  unset($_SESSION["error"]);
  var_dump($_SESSION["student"]);
  header("location:teaCourses.php");
  }else{
    echo "登入失敗";
    if(isset($_SESSION["error"]["times"])){
      $_SESSION["error"]["times"]++;     
    }else{
      $_SESSION["error"]["times"]=1;  
    }
    $_SESSION["eoor"]["message"]="帳號或密碼錯誤";
    header("location: dashboard.php");
  } 
} else {
  echo "" . $conn->error;
}
}


//登出doLogout
function doLogout(){
session_start();
require_once("db_connect.php"); 
unset($SESSION["user"]);
header("location:dashboard.php");
}

//老師新增teadoCreateCourses

function teaCreateC(){
session_start();
require_once("db_connect.php"); 
$class=$_POST["class"];
$classtime=$_POST["classtime"];	
$major=$_POST["major"];	
$courseid=$_POST["courseid"];


$sql="INSERT INTO teacourse (class, classtime, major, courseid) VALUES ('$class', '$classtime', '$major', '$courseid') ";

if ($conn->query($sql) === TRUE) {
  echo "新課表建立成功<br>";
  $last_id = $conn->insert_id;
  echo "id 為 $last_id";
} else {
  echo "Error: " . $sql . "<br>"  . $conn->error;
}
$conn->close();
header("location: teacourse.php");
}
//老師修改teadoUpdateCourses

function teadoUpdateC(){
session_start();
require_once("db_connect.php"); 


}
//老師刪除teadoDeleteCourses

function teadoDeleteC(){
require_once("db_connect.php"); 
  
  }
//老師查詢teadoSearchCourses

function teadoSearchC(){
require_once("db_connect.php"); 

}
//學生新增teadoDelete

function teadoDelete(){
require_once("db_connect.php"); 
  
  }
//學生修改teadoDelete

function teadoDelete(){
require_once("db_connect.php"); 

}
//學生刪除teadoDelete

function teadoDelete(){
require_once("db_connect.php"); 
  
  }
//學生查詢teadoDelete

function teadoDelete(){
require_once("db_connect.php"); 

}


























?>