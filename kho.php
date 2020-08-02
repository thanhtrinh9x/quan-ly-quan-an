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
    <h2 style="text-align: center;"><b><big>DANH SÁCH HÀNG TỒN TRONG KHO</big></b></h2>        
    <table class="table table-hover">
      <thead>
        <tr>
          <th>ID</th>
          <th>TÊN</th>
          <th>DVT</th>
          <th>SỐ LƯỢNG TỒN</th>
        </tr>
      </thead>
      <tbody id="myTable">
        <?php
        $sql = "select * from kho";
        $result = $connect->query($sql);
        while ($row = $result->fetch_assoc()) {
          ?>
          <tr>
            <td><?php echo $row['MaHang'] ?></td>
            <td><?php echo $row['Ten'] ?></td>
            <td><?php echo $row['DVT'] ?></td>
            <td><?php echo $row['SLT'] ?></td>
          </tr>
          <?php
        }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
