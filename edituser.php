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
        $sql = "SELECT manv FROM tbl_user WHERE username = '$tencu'";
        $thucthi = $connect->query($sql);
        $row = $thucthi->fetch_assoc();
        $manv = checkInput($row['manv']);
        
        $fullname = $_POST['fullname'];
        $password = $_POST['password'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $address = $_POST['address'];
          $sql = "UPDATE tbl_user SET password = '$password', fullname = '$fullname', tel = '$tel', email = '$email', address = '$address' WHERE manv = '$manv'";
          
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
      <label for="tencu">Tên nhân viên muốn sửa:</label>
      <select id="tencu" name="tencu" class="form-control">
        <option value="">--Chọn--</option>
        <?php
        $sql = "select username from tbl_user";
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
			<!-- <?php if(isset($giaspError)){echo $giaspError;}?> -->
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
      <input type="submit" style="height: 40px; width: 150px; background-color:#50ba18; font-size: 120%; font-weight: bold;" class="btn btn-default" name="nutnhan2" value="SỬA">
      <input type="reset" style="height: 40px; width: 150px; background-color:yellow; font-size: 120%; font-weight: bold;" class="btn btn-default" value="RESET"><br>
    </div>
  </form>
</div>