<!DOCTYPE html>
<html lang="en">
<?php include 'include/index.php'; ?>
<body>
  <?php 
  if($_POST){
    if(!empty($_POST['nut']))
    {
      $nut = $_POST['nut'];
      if ($nut == "m")
        header('Location:nhapmoi.php');
      if ($nut == "c")
        header('Location:nhapcu.php');
    }
  }

  ?>
  <div class="container">
    <h2 style="text-align: center;"><b>CHI TIẾT NHẬP HÀNG</b></h2>
    <div style="padding-left: 420px;" class="container">
      <form method="POST">
        <div class="btn-group">
          <button type="submit" style="width: 150px;" class="btn btn-primary" name="nut" value="m">Nhập mới</button>
          <button type="submit" style="width: 150px;" class="btn btn-primary" name="nut" value="c" >Nhập cũ</button>
        </div>
      </form>
    </div> 
  </div>
</body>
</html>
