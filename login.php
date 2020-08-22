<?php
include 'include/index.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);

if (isset($_POST["loginbt"])) {
    $user = $_POST["username"];
    $pass = $_POST["password"];
    //làm sạch thông tin, xóa bỏ các tag html, ký tự đặc biệt
    $user = strip_tags($user);
    $user = addslashes($user);
    $pass = strip_tags($pass);
    $pass = addslashes($pass);
    if ($user == "" || $pass =="") {
        echo '<script language="javascript">';
        echo 'alert("Tên đăng nhập và mật khẩu không được để trống ?!")';
        echo '</script>';
    }else{
        $sql = "select * from nhanvien where username = '$user' and password = '$pass'";
        $query = mysqli_query($connect,$sql);
        $num_rows = mysqli_num_rows($query);
        if ($num_rows==0) {
            echo '<script language="javascript">';
            echo 'alert("Tên đăng nhập và mật khẩu không đúng ?!")';
            echo '</script>';
        }else{
            if($user == "admin" && $pass == "admin"){
                $_SESSION['Username'] = $user;
                header('Location: trangchu.php');
                header( "refresh:2;url=trangchu.php" );
                echo '<script language="javascript">';
                echo 'alert("Đăng nhập thành công ?!")';
                echo '</script>';
                exit;
            }
            else{
            $_SESSION['Username'] = $user;
           header('Location: trangchu.php');
           header( "refresh:2;url=trangchu.php" );
           echo '<script language="javascript">';
           echo 'alert("Đăng nhập thành công ?!")';
           echo '</script>';
            }
        }
  }
}
?>
<div class="container">
<h2 style="text-align: center;"><b>TRANG ĐĂNG NHẬP</b></h2>
	<form class="login-form login" method="POST" action="">
    <div class="login-form">
			<label for="username">Tên đăng nhập:</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập">
			<?php if(isset($tenspError)){echo $tenspError;}?>
		</div>
		<div class="login-form">
			<label for="password">Mật khẩu:</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
            <?php if(isset($passError)){echo $passError;}?>
        </div>
        <br><br>
        <div class="container" style="padding-left: 430px;">
			<input type="submit" style="height: 40px; width: 150px; background-color:; font-size: 100%; font-weight: bold;" class="btn btn-default" name="loginbt" value="Đăng nhập">
			<input type="button" style="height: 40px; width: 150px; background-color:; font-size: 100%; font-weight: bold;" class="btn btn-default" value="Đăng ký" 
            onclick="window.location.href='register.php'"><br>
		</div>
	</form>
</div>