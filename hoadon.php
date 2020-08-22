<!DOCTYPE html>
<html lang="en">
<?php 
include 'include/index.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
$dkien = "";
if (!empty($_POST['tim'])){
  if (empty($_POST['shd']) && empty($_POST['ngay'])){
    phpAlert("Bạn cần nhập 1 trong 2 ô để tìm kiếm!");
  } else {
    if(!empty($_POST['shd']) && !empty($_POST['ngay'])) {
      $shd = checkInput($_POST['shd']);
      $ngay = checkInput($_POST['ngay']);
      $dkien = " WHERE YEAR(NgayXuatHD) = YEAR("."'".$ngay."'".") AND MONTH(NgayXuatHD) = MONTH("."'".$ngay."'".") AND DAY(NgayXuatHD) = DAY("."'".$ngay."'".") AND SoHD = "."'".$shd."'";
    } else {
      if(!empty($_POST['shd'])){
        $shd = checkInput($_POST['shd']);
        $dkien = " WHERE SoHD = "."'".$shd."'";
      } else if(!empty($_POST['ngay'])) {
        $ngay = checkInput($_POST['ngay']);
        $dkien = " WHERE YEAR(NgayXuatHD) = YEAR("."'".$ngay."'".") AND MONTH(NgayXuatHD) = MONTH("."'".$ngay."'".") AND DAY(NgayXuatHD) = DAY("."'".$ngay."'".")";
      }
    }
  }
}
?>
<body>

  <div class="container">
    <h2 style="text-align: center;"><b>DANH SÁCH HÓA ĐƠN</b></h2>
    <h4 style="text-align: left;">Tìm kiếm:</h4>
    <form method="POST">
      <div class="form-group">
        <label for="shd" style="width: 15%; position: absolute; left: 105px; top: 195px;">Số hóa đơn:</label>
        <input class="form-control" style="width: 15%; position: absolute; left: 200px; top: 185px;" type="number" id="shd" name="shd" placeholder="Nhập số hóa đơn cần tìm!!!"> 
      </div>
      <label style="width: 15%; position: absolute; left: 500px; top: 195px;">Hoặc</label>
      <div class="form-group">
        <label for="ngay" style="width: 15%; position: absolute; right: 450px; top: 195px;">Ngày:</label>
        <input class="form-control" style="width: 15%; position: absolute; right: 400px; top: 185px;" type="date" name="ngay" id="ngay">
      </div>
      <input type="submit" style="width: 10%; height: 34px; position: absolute; right: 105px; top: 182px;" name="tim" value="Tìm kiếm">
    </form>
    <br>
    <br />       
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>SỐ HÓA ĐƠN</th>
          <th>SỐ BÀN</th>
          <th>TỔNG TIỀN</th>
          <th>NGÀY XUẤT HD</th>
          <th style="text-align: center;">CHI TIẾT</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM hoadon"."".$dkien;
        $result = $connect->query($sql);
        $rows= mysqli_num_rows($result);
        if($rows <= 0){
          phpAlert("0 kết quả được tìm thấy!");
        } else {
          $tb = "Có"." ".$rows." "."hóa đơn được tìm thấy!";
          phpAlert($tb);
          while ($row = $result->fetch_assoc()) {
            ?>
            <tr>
              <td><?php echo $row['SoHD'] ?></td>
              <td><?php echo $row['SoBan'] ?></td>
              <td><?php echo $row['TongTien'] ?></td>
              <td><?php echo $row['NgayXuatHD'] ?></td>
              <td style="text-align: center;"><a href="cthd.php?shd=<?php echo $row['SoHD'];?>" target="_blank"><span class="glyphicon glyphicon-list-alt"></span></a></td>
            </tr>
            <?php
          }
        }
        ?>
      </tbody>
    </table>
  </div>
  <br>

</body>
</html>
