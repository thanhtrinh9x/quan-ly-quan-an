<?php
include 'updateuser.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
if ($_POST)
{
  if (!empty($_POST['nutnhan3']))
  {
    $tuychon = $_POST['nutnhan3'];
    if ($tuychon == "XÓA") 
    {
      if(empty($_POST['username']))
      {
        $tenspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa chọn Nhân viên!</strong></div>";
      }
      else
      {
        $username = checkInput($_POST['username']);
        $sql = "DELETE FROM tbl_user WHERE username = '$username'";
        $thucthi = $connect->query($sql);
        if ($thucthi)
          phpAlert("Xóa nhân viên thành công!");
        else
          phpAlert("Lỗi! Xóa nhân viên thất bại!");
      }
    }   
  }
}
?>
<div class="container">
  <form method="POST">
    <div class="form-group">
      <label for="username">Tên đăng nhập:</label>
      <select id="username" name="username" class="form-control">
        <option value="">--Chọn--</option>
        <?php
        $sql = "select username from tbl_user";
        $result = $connect->query($sql);
        while ($row = $result->fetch_assoc())
        {
          ?>
          <option <?php if (isset($username) && $username == $row['username']) echo "selected=\"selected\"";  ?> value="<?php echo $row['username'] ?>" ><?php echo $row['username'] ?></option>
          <?php
        }

        ?>
      </select>
      <!-- <?php if(isset($tenspError)){echo $tenspError;}?> -->
    </div>
    <div class="container" style="padding-left: 430px;">
      <input type="submit" style="height: 40px; width: 150px; background-color:red; font-size: 120%; font-weight: bold;" class="btn btn-default" name="nutnhan3" value="XÓA">
      <input type="reset" style="height: 40px; width: 150px; background-color:yellow; font-size: 120%; font-weight: bold;" class="btn btn-default" value="RESET"><br>
    </div>
  </form>
</div>