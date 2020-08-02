<?php
include 'updateuser.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
if ($_POST)
{
	if (!empty($_POST['nutnhan1']))
	{
        $tuychon = $_POST['nutnhan1'];
		if($tuychon == "LƯU")
		{
            
			if (empty($_POST['username']))
			{
				// if(empty($_POST['manv']))
				// {
				// 	$maspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập mã nhân viên!</strong></div>";
				// }
				if (empty($_POST['username']))
				{
					$tenspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập tên đăng nhập!</strong></div>";
				}
            }else
			{
				// $manv = checkInput($_POST['manv']);
                $username = checkInput($_POST['username']);
                $password = $_POST['password'];
                $fullname = $_POST['fullname'];
                $tel = $_POST['tel'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $status= 1 ;
					$sql = "INSERT INTO tbl_user(username, password, fullname, tel, email, address, status) VALUES('$username', '$password', '$fullname', '$tel', '$email', '$address', '$status')";
					$thucthi = $connect->query($sql);
					if ($thucthi)
						phpAlert("Thêm nhân viên thành công");
					else
						phpAlert("Lỗi! Thêm nhân viên thất bại!");
			}
		}
	}
}
?>

<div class="container">
	<form method="POST">
		<!-- <div class="form-group">
			<label for="manv">ID</label>
			<input type="text" class="form-control" id="manv" name="manv" placeholder="Nhập vào mã nhân viên mới">
			<?php if(isset($maspError)){echo $maspError;}?>
		</div> -->
		<div class="form-group">
			<label for="username">Tên đăng nhập:</label>
			<input type="text" class="form-control" id="username" name="username" placeholder="Nhập họ và tên">
			<?php if(isset($tenspError)){echo $tenspError;}?>
		</div>
		<div class="form-group">
			<label for="password">Mật khẩu:</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu">
			<?php if(isset($giaspError)){echo $giaspError;}?>
		</div>

        <div class="form-group">
			<label for="fullname">Họ và Tên:</label>
			<input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập họ và tên">
			<!-- <?php if(isset($tenspError)){echo $tenspError;}?> -->
		</div>
        <div class="form-group">
			<label for="tel">Điện thoại:</label>
			<input type="text" class="form-control" id="tel" name="tel" placeholder="Nhập điện thoại">
			<!-- <?php if(isset($tenspError)){echo $tenspError;}?> -->
		</div>
        <div class="form-group">
			<label for="email">Email:</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Nhập email">
			<!-- <?php if(isset($tenspError)){echo $tenspError;}?> -->
		</div>
        <div class="form-group">
			<label for="address">Địa chỉ:</label>
			<input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ">
			<!-- <?php if(isset($tenspError)){echo $tenspError;}?> -->
		</div>
		<div class="container" style="padding-left: 430px;">
			<input type="submit" style="height: 40px; width: 150px; background-color:#50ba18; font-size: 120%; font-weight: bold;" class="btn btn-default" name="nutnhan1" value="LƯU">
			<input type="reset" style="height: 40px; width: 150px; background-color:yellow; font-size: 120%; font-weight: bold;" class="btn btn-default" value="RESET"><br>
		</div>
	</form>
</div>