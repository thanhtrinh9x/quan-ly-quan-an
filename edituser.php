<?php
include 'updateuser.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);

if ($_POST)
{
  if (!empty($_POST['nutnhan2']))
  {
    $tuychon = $_POST['nutnhan2'];
    // $tencu = $_POST['tencu'];
    // var_dump($tencu);
    // exit();
    if ($tuychon == "SỬA") 
    {
      if (empty($_POST['tencu']))
      {
        // if(empty($_POST['tencu']) || empty($_POST['username']))
        // {
        //   $tenspcuError = "<div class=\"alert alert-warning\"><strong>Bạn chưa chọn nhân viên để sửa!</strong></div>";
        // }
        if (empty($_POST['username']))
        {
          $tenspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập tên nhân viên!</strong></div>";
        }
      }
      else
      { 
        $tencu = checkInput($_POST['tencu']);
        $sql = "SELECT username FROM nhanvien WHERE username = '$tencu'";
        $thucthi = $connect->query($sql);
        $row = $thucthi->fetch_assoc();
        $manv = checkInput($row['username']);
        $id = $_POST['id'];
        $username = checkInput($_POST['username']);
        $password = $_POST['password'];
				$hoten = $_POST['hoten'];
				$gioitinh = $_POST['gioitinh'];
				$ngaysinh = $_POST['ngaysinh'];
				$diachi = $_POST['diachi'];
				$cmnd = $_POST['cmnd'];
				$email = $_POST['email'];
        $sdt = $_POST['sdt']; 
        
          $sql = "UPDATE nhanvien SET 
          id = '$id',username = '$username',password = '$password',
          hoten = '$hoten',gioitih = '$gioitinh',ngaysinh = '$ngaysinh',diachi = '$diachi',cmnd = '$cmnd', email = '$email', sdt = '$sdt' 
            WHERE username = '$username'";
          
          $thucthi = $connect->query($sql);
          if ($thucthi){
            phpAlert("Sửa sản phẩm thành công!");
          }
         
          else
            phpAlert("Lỗi! Sửa sản phẩm thất bại!");
        
      }
    }
  }
}
?>

<div class="container">
  <form method="POST">
    <div class="form-group">
			<label for="id">ID:</label>
			<input type="text" class="form-control" id="id" name="id" placeholder="Nhập mã nhân viên">
		</div>
    <div class="form-group">
      <label for="tencu">Tên nhân viên muốn sửa:</label>
      <select id="tencu" name="tencu" class="form-control">
        <option value="">--Chọn--</option>
        <?php
        $sql = "select username from nhanvien";
        $result = $connect->query($sql);
        while ($row = $result->fetch_assoc())
        {
          ?>
          <option <?php if (isset($tencu) && $tencu == $row['username']) echo "selected=\"selected\"";  ?> value="<?php echo $row['username'] ?>" ><?php echo $row['username'] ?></option>
          <?php
        }
        ?>
      </select>
      <?php if(isset($tenspcuError)){echo $tenspcuError;}?>
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
			<input type="text" class="form-control" id="ngaysinh" name="ngaysinh" placeholder="Nhập ngày sinh">
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
      <input type="submit" style="height: 40px; width: 150px; background-color:#50ba18; font-size: 120%; font-weight: bold;" class="btn btn-default" name="nutnhan2" value="SỬA">
      <input type="reset" style="height: 40px; width: 150px; background-color:yellow; font-size: 120%; font-weight: bold;" class="btn btn-default" value="RESET"><br>
    </div>
  </form>
</div>