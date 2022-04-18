<?php 
session_start();
if(isset($_SESSION["user"])){
    header("location: stuShowChoosed.php");
}
?>
<!doctype html>
<html lang="tw">
<head>
  <title>stuLogin</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.0.2 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../style.css">
  <script src="http://www.code.jquery.com/jquery-3.6.0.min.js"></script>
  
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

      <a class="navbar-brand" href="#"><b>逢甲大學</b></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <!-- dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              功能選單
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">所有課程</a></li>
              <li><a class="dropdown-item" href="#">查詢課程</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">瀏覽所選課程</a></li>
            </ul>
          </li>
          <a class="nav-link" href="#">教師登入</a>
          <a class="nav-link" href="#">學生登入</a>
          <a class="nav-link" href="#">登出</a>

        </div>
      </div>
    </div>
  </nav>

  <div class="container ">
    <div class="row">
      <figure class="figure">
        <img src="../images/fg.jpg" class="img-fluid" alt="">
        <figcaption class="figure-caption">
          這是母校
        </figcaption>
      </figure>
    </div>
    <div class="d-flex justify-content-center align-items-center m-0 p-0  ">
      <div class="loginBox justify-content-center align-items-center m-0 p-0  ">
        <form class="form-group h-100 d-flex flex-column justify-content-between  p-3">
        <?php if(isset($_SESSION["error"]) && $_SESSION["error"]["times"]>=5): ?>
                您已輸入錯誤超過次數
            <?php else: ?>
          <h1> <b> 學生登入 </b> </h1>
          <div class="form-floating mb-3">
            <input type="text" class="form-control" name="stuAccount" id="stuAccount" placeholder="Account:">
            <label for="floatingPassword">Account:</label>
          </div>

          <div class="form-floating mb-3">
            <input type="password" class="form-control" name="password" id="password"
              placeholder="Password:">
            <label for="floatingPassword">Password:</label>
          </div>

          <button id="stulogin" class="button-1">登入</button>
        </form>
        <?php endif; ?>
      </div>
    </div>
  </div>
  </div>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
    crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-1.9.0.js"></script>
    <script src="http://www.code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
      $("#stulogin").click(function(){
        let account=$("#stuAccount").val(), password=$("#password").val();
        // console.log(account, password)
        let formData=new FormData();
        formData.append('stuAccount', account);
        formData.append('password', password);

        axios({
          method: "post",
          url: "/20220329project/dbconnect.php",
          data: formData,
          headers: { 'Content-Type': "multipart/form-data"}
        }).
        then(function(response){
          // console.log(response)
          let data=response.data;
          console.log("success")
          // console.log(data)
          if(data.status===1){ //成功
            location.href="stuShowChoosed.php";
          }else{ //失敗
            let message=`${data.error.message}, 共錯誤 ${data.error.times} 次`
            if(data.error.times>=5){
              location.href="";
            }
            $("#error").text(message)
          }
        })
        .catch(function(response){
          console.log(response)
        })
      })


      
    </script>
</body>

</html>