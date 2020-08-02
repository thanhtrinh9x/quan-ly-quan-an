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
    <h2 style="text-align: center;"><b>DANH SÁCH ĐỒ UỐNG</b></h2>
    <p style="text-align: center;">Phục vụ tại quán và mang đi</p>  
    <input class="form-control" id="myInput" type="text" placeholder="Lựa chọn của bạn..">   
    <br>       
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>TÊN</th>
          <th>GIÁ(VND)</th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php
        $sql = "select * from sanpham";
        $result = $connect->query($sql);
        while ($row = $result->fetch_assoc()) {

          ?>
          <tr>
            <td><?php echo $row['MaSP'] ?></td>
            <td><?php echo $row['TenSp'] ?></td>
            <td><?php echo $row['GiaTien'] ?></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
    <a href="updatemenu.php" target="_self"><b><big>Cập nhập menu</big></b></a>
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
