<?php 
include 'nhaphang.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
$error = '';
if ($_POST)
{
  if (!empty($_POST['nutnhan']))
  {
    $tuychon = $_POST['nutnhan'];
    if($tuychon == "Nhập hàng")
    {
      if (empty($_POST['masp']) || empty($_POST['tensp']) || empty($_POST['dvtinh']) || empty($_POST['giasp']) || empty($_POST['sln']) || empty($_POST['ngnhap']))
      {
        if(empty($_POST['masp']))
        {
          $maspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập mã hàng!</strong></div>";
        }
        if (empty($_POST['tensp']))
        {
          $tenspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập tên hàng!</strong></div>";
        }
        if (empty($_POST['dvtinh']))
        {
          $dvtError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập đơn vị tính của hàng hóa</strong></div>";
        }
        if (empty($_POST['giasp']))
        {
          $giaspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập giá nhập hàng</strong></div>";
        }
        if (empty($_POST['sln']))
        {
          $slnError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập số lượng nhập hàng</strong></div>";
        }
        if (empty($_POST['ngnhap']))
        {
          $ngnhapError = "<div class=\"alert alert-warning\"><strong>Bạn chưa chọn ngày nhập hàng</strong></div>";
        }
      }
      else
      {
        $masp = checkInput($_POST['masp']);
        $sql = "SELECT * FROM kho where MaHang = '$masp'";
        $thucthi = $connect->query($sql);
        $rows= mysqli_num_rows($thucthi);
        if($rows > 0)
        {
          $maspError = "<div class=\"alert alert-warning\"><strong>Mã hàng bị trùng với hàng đã có trong kho!</strong></div>";
        }
        else
        {
          $tensp = checkInput($_POST['tensp']);
          $dvt = checkInput($_POST['dvtinh']);
          $giasp = checkInput($_POST['giasp']);
          if ($giasp <= 0)
          {
            $giaspError = "<div class=\"alert alert-warning\"><strong>Giá nhập hàng phải lớn hơn 0!</strong></div>";
          }
          else
          {
            $sln = checkInput($_POST['sln']);
            if ($sln <= 0)
            {
              $slnError = "<div class=\"alert alert-warning\"><strong>Số lượng nhập phải lớn hơn 0!</strong></div>";
            }
            else
            {
              $ngnhap = checkInput($_POST['ngnhap']);
              if (ssNgay($ngnhap) == 1)
              {
                $ngnhapError = "<div class=\"alert alert-warning\"><strong>Bạn không thể chọn ngày trong tương lai!</strong></div>";
              }
              else
              {
                $sql1 = "INSERT INTO hangnhap(MaHang, TenHang, DVT, Gia, SL, NgayNhap, IDNV) VALUES('$masp', '$tensp', '$dvt', '$giasp', '$sln', '$ngnhap', 'NV1')";
                $thucthi1 = $connect->query($sql1);
                if ($thucthi1)
                {
                  phpAlert("Nhập hàng thành công!");
                  $sql2 = "INSERT INTO kho(MaHang, Ten, DVT, SLT) VALUES('$masp', '$tensp', '$dvt', '$sln')";
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
      <label for="mahang">Mã hàng:</label>
      <input type="text" class="form-control" id="mahang" name="masp" placeholder="Nhập vào mã hàng mới">
      <?php if(isset($maspError)){echo $maspError;}?>
    </div>
    <div class="form-group">
      <label for="tenhang">Tên hàng:</label>
      <input type="text" class="form-control" id="tenhang" name="tensp" placeholder="Nhập vào tên hàng mới">
      <?php if(isset($tenspError)){echo $tenspError;}?>
    </div>
    <div class="form-group">
      <label for="dvt">Đơn vị tính:</label>
      <input type="text" class="form-control" id="dvt" name="dvtinh" placeholder="Đơn vị tính">
      <?php if(isset($dvtError)){echo $dvtError;}?>
    </div>
    <div class="form-group">
      <label for="gia">Giá(VND):</label>
      <input type="number" class="form-control" id="gia" name="giasp" placeholder="Nhập vào giá nhập hàng">
      <?php if(isset($giaspError)){echo $giaspError;}?>
    </div>
    <div class="form-group">
      <label for="soluong">Số lượng nhập:</label>
      <input type="number" class="form-control" id="soluong" name="sln" placeholder="Nhập vào số lượng hàng nhập vào">
      <?php if(isset($slnError)){echo $slnError;}?>
    </div>
    <div class="form-group">
      <label for="ngaynhap">Ngày nhập:</label>
      <input type="date" min="2017-01-01" class="form-control" id="ngaynhap" name="ngnhap">
      <?php if(isset($ngnhapError)){echo $ngnhapError;}?>
    </div>
    <input type="submit" style="height: 40px; width: 320px; background-color:#50ba18; font-size: 120%; font-weight: bold;" class="btn btn-default" name="nutnhan" value="Nhập hàng">
    <input type="reset" style="height: 40px; width: 320px; background-color:yellow; font-size: 120%; font-weight: bold;" class="btn btn-default" value="Reset">
    <input type="submit" style="height: 40px; width: 320px; font-size: 120%; font-weight: bold;" class="btn btn-default" name="nutnhan" value="Xem Danh sách hàng đã nhập">
  </form>
  <?php if(isset($error)){echo $error;}?>
</div><br><br>