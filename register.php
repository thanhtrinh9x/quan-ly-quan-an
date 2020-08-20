<?php
include 'include/index.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
if ($_POST)
{
	if (!empty($_POST['dangky']))
	{
        $tuychon = $_POST['dangky'];
		if($tuychon == "Đăng Ký")
		{
            
			if (empty($_POST['username']) || empty($_POST['password']))
			{
				if (empty($_POST['username']))
				{
					$tenspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập tên đăng nhập!</strong></div>";
                }
                if (empty($_POST['password']))
				{
					$passError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập mật khẩu đăng nhập!</strong></div>";
				}
            }else
			{	$id = $_POST['id'];
                $username = checkInput($_POST['username']);
                $password = $_POST['password'];
				$hoten = $_POST['hoten'];
				$gioitinh = $_POST['gioitinh'];
				$ngaysinh = $_POST['ngaysinh'];
				$diachi = $_POST['diachi'];
				$cmnd = $_POST['cmnd'];
				$email = $_POST['email'];
                $sdt = $_POST['sdt'];                                
                //$status= 1 ;
					$sql = "INSERT INTO nhanvien(id,hoten,gioitinh,ngaysinh,diachi,cmnd,email,sdt,username,password) 
							VALUES('$id','$hoten', '$gioitinh', '$ngaysinh', '$diachi', '$cmnd', '$email', '$sdt', '$username','$password')";
					$thucthi = $connect->query($sql);
					if ($thucthi){
						phpAlert("Thêm nhân viên thành công");
						header('Location: login.php');
						exit;
						
					}
					else{
						phpAlert("Lỗi! Thêm nhân viên thất bại!");
						
					}
			}
		}
	}
}
?>

<div class="container">
<h2 style="text-align: center;"><b>ĐĂNG KÝ NHÂN VIÊN</b></h2>
	<form method="POST" class="login-form">
		<div class="form-group">
			<label for="id">ID:</label>
			<input type="text" class="form-control" id="id" name="id" placeholder="Nhập mã nhân viên">
		</div>
		<div class="form-group">
			<label for="username">Tên đăng nhập:</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="Nhập tên đăng nhập">
			<?php if(isset($tenspError)){echo $tenspError;}?>
		</div>
		<div class="form-group">
			<label for="password">Mật khẩu:</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
            <?php if(isset($passError)){echo $passError;}?>
        </div>
        <div class="form-group">
			<label for="hoten">Họ và Tên:</label>
			<input type="text" class="form-control" id="hoten" name="hoten" placeholder="Nhập họ và tên">
		</div>
		<div class="form-group">
			<label for="gioitinh">Giới tính:</label>
			<input type="text" class="form-control" id="gioitinh" name="gioitinh" placeholder="Giới tính">
		</div>
		<div class="form-group">
			<label for="ngaysinh">Ngày Sinh:</label>
			<input type="date" class="form-control" id="ngaysinh" name="ngaysinh" placeholder="Nhập ngày sinh">
		</div>
		<div class="form-group">
			<label for="cmnd">CMND:</label>
			<input type="text" class="form-control" id="cmnd" name="cmnd" placeholder="Số chứng minh nhân dân">
		</div>
        <div class="form-group">
			<label for="sdt">Điện thoại:</label>
			<input type="text" class="form-control" id="sdt" name="sdt" placeholder="Nhập điện thoại">
		</div>
        <div class="form-group">
			<label for="email">Email:</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Nhập email">
		</div>
        <div class="form-group">
			<label for="diachi">Địa chỉ:</label>
			<input type="text" class="form-control" id="diachi" name="diachi" placeholder="Nhập địa chỉ">
		</div>
		<div class="container" style="padding-left: 430px;">
			<input type="submit" style="height: 40px; width: 150px; background-color:; font-size: 120%; font-weight: bold;" class="btn btn-default" name="dangky" value="Đăng Ký">
			<input type="button" style="height: 40px; width: 150px; background-color:; font-size: 120%; font-weight: bold;" class="btn btn-default" value="Quay về" 
            onclick="window.location.href='trangchu.php'"><br>
		</div>
	</form>
</div>