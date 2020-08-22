<!DOCTYPE html>
<html lang="en">
<?php 
include 'include/index.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
?>
<body>

  <div class="container">
    <h2>DANH SÁCH HÀNG ĐÃ NHẬP</h2> 
    <div class="form-group">
      <label for="mahang">Chọn ngày muốn xem</label>
      <input class="form-control" id="myInput" min="2019-01-01" type="date">
    </div>
    
    <br>       
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Mã số nhập</th>
          <th>Mã hàng</th>
          <th>Tên hàng</th>
          <th>Đơn vị tính</th>
          <th>Giá(VND)</th>
          <th>Số lượng</th>
          <th>Ngày nhập</th>
          <th>ID nhân viên</th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php
        $sql = "select * from hangnhap";
        $result = $connect->query($sql);
        while ($row = $result->fetch_assoc()) {

          ?>
          <tr>
            <td><?php echo $row['MaSoNhap'] ?></td>
            <td><?php echo $row['MaHang'] ?></td>
            <td><?php echo $row['TenHang'] ?></td>
            <td><?php echo $row['DVT'] ?></td>
            <td><?php echo $row['Gia'] ?></td>
            <td><?php echo $row['SL'] ?></td>
            <td><?php echo $row['NgayNhap'] ?></td>
            <td><?php echo $row['IDNV'] ?></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <a href="nhaphang.php" target="_self"><b><big>Tiếp tục nhập hàng</big></b></a>
  </div>
  <br>

  <script>
    $(document).ready(function(){
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>

</body>
</html>
