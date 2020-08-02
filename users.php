<!DOCTYPE html>
<html lang="en">
<style>
thead .tr .th {
    text-align:center;
}
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
      <thead>
        <tr>
          <th>MÃ NHÂN VIÊN</th>
          <th>USERNAME</th>
          <th>HỌ VÀ TÊN</th>
          <th>ĐIỆN THOẠI</th>
          <th>EMAIL</th>
          <th>ĐỊA CHỈ</th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php
        $sql = "select * from tbl_user";
        $result = $connect->query($sql);
        while ($row = $result->fetch_assoc()) {

          ?>
          <tr>
            <td><?php echo $row['manv'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><?php echo $row['fullname'] ?></td>
            <td><?php echo $row['tel'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['address'] ?></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <a href="#" target="_self"><b><big>Cập nhập nhân viên</big></b></a>
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
