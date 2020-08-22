<?php session_start();?>
<head>
  <title>T&T COFFEE</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <style>
body {
  /* background-image: url('images/bg.jpg'); */
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
</head>
<body>
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="trangchu.php"><img src="images/logoindex.jpg" style="border-radius: 50%;" width="70" height="70"></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="trangchu.php">T&T COFFEE</a></li>
          <li><a href="menu.php">MENU ĐỒ UỐNG</a></li>
          <li><a href="hoadon.php">HÓA ĐƠN</a></li>
          <li>
          <?php if($_SESSION['Username']=="admin")
          echo '
          <li><a href="kho.php">KHO</a></li>
          <li><a href="nhaphang.php">NHẬP HÀNG</a></li>
          <li><a href="doanhthu.php">DOANH THU</a></li>
          <li><a href="users.php">NHÂN VIÊN</a></li>
          ';?>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right"> 
          <li class="nav-item dropdown">
	            <a class="nav-link  dropdown-toggle" href="#" data-toggle="dropdown"><span class="glyphicon glyphicon-user name">
              <?php if(isset($_SESSION['Username'])) echo $_SESSION['Username'];?></span></a>
	          <ul class="dropdown-menu">
		          <li><a class="dropdown-item" href="login.php" font>Đăng nhập</a></li>
		          <li><a class="dropdown-item" href="register.php">Đăng ký</a></li>
	          </ul>
          </li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Đăng xuất</a></li>
          </ul>
      </div>
    </div>
  </nav>
</body>