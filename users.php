<!DOCTYPE html>
<html lang="en">
<style>
td {
    text-align:center;
}
</style>
<?php 
include 'include/index.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
?>
<body>

  <div class="container">
    <h2 style="text-align: center;"><b>DANH SÁCH NHÂN VIÊN</b></h2>
    <input class="form-control" id="myInput" type="text" placeholder="Lựa chọn của bạn..">   
    <br>       
    <table class="table table-bordered table-striped">
      <!-- <thead> -->
        <tr>
          <th>MÃ NHÂN VIÊN</th>
          <th>TÊN ĐĂNG NHẬP</th>
          <th>HỌ VÀ TÊN</th>
          <th>GIỚI TÍNH</th>
          <th>NGÀY SINH</th>
          <th>CMND</th>
          <th>ĐIỆN THOẠI</th>
          <th>EMAIL</th>
          <th>ĐỊA CHỈ</th>
        </tr>
      <!-- </thead> -->
      <tbody id="myTable">
        <?php
        $sql = "select * from nhanvien";
        $result = $connect->query($sql);
        while ($row = $result->fetch_assoc()) {

          ?>
          <tr>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?php echo $row['hoten'] ?></td>
            <td><?php echo $row['gioitinh'] ?></td>
            <td><?php echo $row['ngaysinh'] ?></td>
            <td><?php echo $row['cmnd'] ?></td>
            <td><?php echo $row['sdt'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['diachi'] ?></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <a href="updateuser.php" target="_self"><b><big>Cập nhập nhân viên</big></b></a>
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
