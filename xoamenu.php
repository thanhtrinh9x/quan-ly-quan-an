<?php
include 'updatemenu.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
if ($_POST)
{
  if (!empty($_POST['nutnhan']))
  {
    $tuychon = $_POST['nutnhan'];
    if ($tuychon == "XÓA") 
    {
      if(empty($_POST['tensp']))
      {
        $tenspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa chọn sản phẩm!</strong></div>";
      }
      else
      {
        $tensp = checkInput($_POST['tensp']);
        $sql = "DELETE FROM sanpham WHERE TenSp = '$tensp'";
        $thucthi = $connect->query($sql);
        if ($thucthi)
          phpAlert("Xóa sản phẩm thành công!");
        else
          phpAlert("Lỗi! Xóa sản phẩm thất bại!");
      }
    }   
  }
}
?>
<div class="container">
  <form method="POST">
    <div class="form-group">
      <label for="tenhang">Tên hàng:</label>
      <select id="tenhang" name="tensp" class="form-control">
        <option value="">--Chọn--</option>
        <?php
        $sql = "select TenSp from sanpham";
        $result = $connect->query($sql);
        while ($row = $result->fetch_assoc())
        {
          ?>
          <option <?php if (isset($tensp) && $tensp == $row['TenSp']) echo "selected=\"selected\"";  ?> value="<?php echo $row['TenSp'] ?>" ><?php echo $row['TenSp'] ?></option>
          <?php
        }
        ?>
      </select>
      <?php if(isset($tenspError)){echo $tenspError;}?>
    </div>
    <div class="container" style="padding-left: 430px;">
      <input type="submit" style="height: 40px; width: 150px; background-color:red; font-size: 120%; font-weight: bold;" class="btn btn-default" name="nutnhan" value="XÓA">
      <input type="reset" style="height: 40px; width: 150px; background-color:yellow; font-size: 120%; font-weight: bold;" class="btn btn-default" value="RESET"><br>
    </div>
  </form>
</div>