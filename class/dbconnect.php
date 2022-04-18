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
function teaRegister(){
  require_once("db_connect.php")
  $name=$_POST["name"];
  $account=$_POST["account"];
  $password=md5($_POST["password"]);
  $gender=$_POST["gender"];
  $major=$_POST["major"];
 $sql="INSERT INTO 	teacher ( name,  account, password, gender,	major)
 VALUES ( '$name', '$account', '$password', '$gender',	'$major')";
if ($conn->query($sql) === TRUE) {
echo "註冊成功<br>";
$last_id = $conn->insert_id;
echo "id 為 $last_id";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
header("location: dashboard.php");
}


//學生註冊
function stuRegister(){
  require_once("db_connect.php")
  $name=$_POST["name"];
  $account=$_POST["account"];
  $password=md5($_POST["password"]);
  $gender=$_POST["gender"];
  $major=$_POST["major"];
  $grade=$_POST["grade"];
 $sql="INSERT INTO 	student ( name, account, password, gender,	major, grade)
 VALUES ( '$name', '$password', '$account', '$gender', '$major','$grade')";
if ($conn->query($sql) === TRUE) {
echo "註冊成功<br>";
$last_id = $conn->insert_id;
echo "id 為 $last_id";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
header("location: dashboard.php");
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