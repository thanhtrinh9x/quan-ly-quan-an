<!DOCTYPE html>
<html lang="en">
<?php include 'include/index.php'; ?>
<body>
  <?php 
  if($_POST){
    if(!empty($_POST['nut']))
    {
      $nut = $_POST['nut'];
      if ($nut == "t")
        header('Location:themmenu.php');
      if ($nut == "s")
        header('Location:suamenu.php');
      if ($nut == "x")
        header('Location:xoamenu.php');
    }
  }

  ?>
  <div class="container">
    <h2 style="text-align: center;"><b>CẬP NHẬP MENU</b></h2>
    <div style="padding-left: 430px;" class="container">
      <form method="POST">
        <div class="btn-group">
          <button type="submit" style="width: 100px;" class="btn btn-primary" name="nut" value="t">Thêm</button>
          <button type="submit" style="width: 100px;" class="btn btn-primary" name="nut" value="s" >Sửa</button>
          <button type="submit" style="width: 100px;" class="btn btn-primary" name="nut" value="x" >Xóa</button>
        </div>
      </form>
    </div> 
  </div>
</body>
</html>
