<?php 
include 'nhaphang.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
$error = array();
$masp = $dvt = $tensp = '';
if ($_POST)
{
  if (empty($_POST['tensp'])) {
    $error['tensp'] = "<div class=\"alert alert-warning\"><strong>Bạn chưa chọn hàng để nhập!</strong></div>";
  } 
  else 
  {
    $tensp = checkInput($_POST['tensp']);
    $sql = "SELECT MaHang, DVT FROM kho where Ten = '$tensp'";
    $thucthi = $connect->query($sql);
    $row = $thucthi->fetch_assoc();
    $masp = checkInput($row['MaHang']);
    $dvt = checkInput($row['DVT']);
  }
  if (!empty($_POST['nutnhan']))
  {
    $tuychon = $_POST['nutnhan'];
    
    if ($tuychon == "Nhập hàng")
    {
      if (empty($_POST['giasp']) || empty($_POST['sln']) || empty($_POST['ngnhap']))
      {
        if (empty($_POST['giasp']))
        {
          $error['giasp'] = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập giá nhập hàng</strong></div>";
        }
        if (empty($_POST['sln']))
        {
          $error['sln'] = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập số lượng nhập hàng</strong></div>";
        }
        if (empty($_POST['ngnhap']))
        {
          $error['ngnhap'] = "<div class=\"alert alert-warning\"><strong>Bạn chưa chọn ngày nhập hàng</strong></div>";
        }
      }
      else
      {
        $giasp = checkInput($_POST['giasp']);
        if ($giasp <= 0)
        {
          $error['giasp'] = "<div class=\"alert alert-warning\"><strong>Giá nhập hàng phải lớn hơn 0!</strong></div>";
        }
        else
        {
          $sln = checkInput($_POST['sln']);
          if ($sln <= 0)
          {
            $error['sln'] = "<div class=\"alert alert-warning\"><strong>Số lượng nhập phải lớn hơn 0!</strong></div>";
          }
          else
          {
            $ngnhap = checkInput($_POST['ngnhap']);
            if (ssNgay($ngnhap) == 1)
            {
              $error['ngnhap'] = "<div class=\"alert alert-warning\"><strong>Bạn không thể chọn ngày trong tương lai!</strong></div>";
            }
            else
            {
              $sql1 = "INSERT INTO hangnhap(MaHang, TenHang, DVT, Gia, SL, NgayNhap, IDNV) VALUES('$masp', '$tensp', '$dvt', '$giasp', '$sln', '$ngnhap', 'NV1')";
              $thucthi1 = $connect->query($sql1);
              if ($thucthi1)
              {
                phpAlert("Nhập hàng thành công!");
                $sql2 = "UPDATE kho SET SLT = SLT + '$sln' WHERE MaHang = '$masp'";
                $thucthi2 = $connect->query($sql2);
              }
              else
              {
                phpAlert("Lỗi! Nhập hàng thất bại!");
              }
            }
          }
        }
      }
    }
    else if ($tuychon == "Xem Danh sách hàng đã nhập") 
    {
      header('Location:dshangnhap.php');
    }
  }
}
?>
<div style="padding-left: 100px;" class="container">
  <form method="POST">
    <div class="form-group">
      <label for="tenhang">Tên hàng:</label>
      <select id="tenhang" name="tensp" class="form-control">
        <option value="">--Chọn--</option>
        <?php
        $sql = "select Ten from kho";
        $result = $connect->query($sql);
        while ($row = $result->fetch_assoc())
        {
          ?>
          <option <?php if (isset($tensp) && $tensp == $row['Ten']) echo "selected=\"selected\"";  ?> value="<?php echo $row['Ten'] ?>" ><?php echo $row['Ten'] ?></option>
          <?php
        }
        ?>
      </select>
      <input type="submit" name="chon" value="OK" >
      <?php if(isset($error['tensp'])){echo $error['tensp'];}?>
    </div>
    <div class="form-group">
      <label for="mahang">Mã hàng:</label>
      <input type="text" class="form-control" readonly id="mahang" name="masp" value="<?php echo $masp; ?>">
    </div>
    <div class="form-group">
      <label for="dvt">Đơn vị tính:</label>
      <input type="text" class="form-control" readonly id="dvt" name="dvtinh" value="<?php echo $dvt; ?>">
    </div>
    <div class="form-group">
      <label for="gia">Giá(VND):</label>
      <input type="number" class="form-control" id="gia" name="giasp" placeholder="Nhập vào giá nhập hàng">
      <?php if(isset($error['giasp'])){echo $error['giasp'];}?>
    </div>
    <div class="form-group">
      <label for="soluong">Số lượng nhập:</label>
      <input type="number" class="form-control" id="soluong" name="sln" placeholder="Nhập vào số lượng hàng nhập vào">
      <?php if(isset($error['sln'])){echo $error['sln'];}?>
    </div>
    <div class="form-group">
      <label for="ngaynhap">Ngày nhập:</label>
      <input type="date" min="2017-01-01" class="form-control" id="ngaynhap" name="ngnhap">
      <?php if(isset($error['ngnhap'])){echo $error['ngnhap'];}?>
    </div>
    <input type="submit" style="height: 40px; width: 320px; background-color:#50ba18; font-size: 120%; font-weight: bold;" class="btn btn-default" name="nutnhan" value="Nhập hàng">
    <input type="reset" style="height: 40px; width: 320px; background-color:yellow; font-size: 120%; font-weight: bold;" class="btn btn-default" value="Reset">
    <input type="submit" style="height: 40px; width: 320px; font-size: 120%; font-weight: bold;" class="btn btn-default" name="nutnhan" value="Xem Danh sách hàng đã nhập">
  </form>
</div><br><br>