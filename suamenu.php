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
    if ($tuychon == "SỬA") 
    {
      if (empty($_POST['tenspcu']) || empty($_POST['tensp']) || empty($_POST['giasp']))
      {
        if(empty($_POST['tenspcu']))
        {
          $tenspcuError = "<div class=\"alert alert-warning\"><strong>Bạn chưa chọn sản phẩm để sửa!</strong></div>";
        }
        if (empty($_POST['tensp']))
        {
          $tenspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập tên sản phẩm!</strong></div>";
        }
        if (empty($_POST['giasp']))
        {
          $giaspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập giá sản phẩm!</strong></div>";
        }
      }
      else
      {
        $tenspcu = checkInput($_POST['tenspcu']);
        $sql = "SELECT MaSP FROM sanpham WHERE TenSp = '$tenspcu'";
        $thucthi = $connect->query($sql);
        $row = $thucthi->fetch_assoc();
        $masp = checkInput($row['MaSP']);
        $tensp = checkInput($_POST['tensp']);
        $giasp = checkInput($_POST['giasp']);
        if ($giasp <= 0){
          $giaspError = "<div class=\"alert alert-warning\"><strong>Giá sản phẩm không được nhỏ hơn 0!</strong></div>";
        }
        else
        {
          $sql = "UPDATE sanpham SET TenSp = '$tensp', GiaTien = '$giasp' WHERE MaSP = '$masp'";
          $thucthi = $connect->query($sql);
          if ($thucthi)
            phpAlert("Sửa sản phẩm thành công!");
          else
            phpAlert("Lỗi! Sửa sản phẩm thất bại!");
        }
      }
    }
  }
}
?>

<div class="container">
  <form method="POST">
    <div class="form-group">
      <label for="tenhangcu">Tên sản phẩm muốn sửa:</label>
      <select id="tenhangcu" name="tenspcu" class="form-control">
        <option value="">--Chọn--</option>
        <?php
        $sql = "select TenSp from sanpham";
        $result = $connect->query($sql);
        while ($row = $result->fetch_assoc())
        {
          ?>
          <option <?php if (isset($tenspcu) && $tenspcu == $row['TenSp']) echo "selected=\"selected\"";  ?> value="<?php echo $row['TenSp'] ?>" ><?php echo $row['TenSp'] ?></option>
          <?php
        }
        ?>
      </select>
      <?php if(isset($tenspcuError)){echo $tenspcuError;}?>
    </div>
    <div class="form-group">
      <label for="tenhang">Tên sản phẩm mới:</label>
      <input type="text" class="form-control" id="tenhang" name="tensp" placeholder="Nhập tên sản phẩm mới">
      <?php if(isset($tenspError)){echo $tenspError;}?>
    </div>
    <div class="form-group">
      <label for="gia">Giá(VND):</label>
      <input type="number" class="form-control" id="gia" name="giasp" placeholder="Nhập vào giá mới">
      <?php if(isset($giaspError)){echo $giaspError;}?>
    </div>
    <div class="container" style="padding-left: 430px;">
      <input type="submit" style="height: 40px; width: 150px; background-color:#50ba18; font-size: 120%; font-weight: bold;" class="btn btn-default" name="nutnhan" value="SỬA">
      <input type="reset" style="height: 40px; width: 150px; background-color:yellow; font-size: 120%; font-weight: bold;" class="btn btn-default" value="RESET"><br>
    </div>
  </form>
</div>