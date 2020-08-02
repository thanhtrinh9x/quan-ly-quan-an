<!DOCTYPE html>
<html lang="en">
<?php include 'include/index.php'; ?>
<body>
  <?php 
  if($_POST){
    if(!empty($_POST['nut']))
    {
      $nut = $_POST['nut'];
      if ($nut == "ngay")
        header('Location:dtngay.php');
      if ($nut == "thang")
        header('Location:dtthang.php');
    }
  }

  ?>
  <div class="container">
    <h2 style="text-align: center;"><b>DOANH THU</b></h2>
    <div style="padding-left: 420px;" class="container">
      <form method="POST">
        <div class="btn-group">
          <button type="submit" style="width: 150px;" class="btn btn-primary" name="nut" value="ngay">XEM THEO NGÀY</button>
          <button type="submit" style="width: 150px;" class="btn btn-primary" name="nut" value="thang" >XEM THEO THÁNG</button>
        </div>
      </form>
    </div> 
  </div>
</body>
</html>