<!DOCTYPE html>
<html lang="en">
<head>
  <title>Đặt bàn</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
</head>
<body background="../images/bg.jpg">
  <?php
  include '../include/function.php';
  $connect = connectDB();
  $lenh = "USE qly_cafe";
  $connect->query($lenh);
  $hoten = $sdt = $hden = "";
  if($_POST){
    $idban = $_POST['idban'];
    if (!empty($_POST['datban']))
    {
      $datban = $_POST['datban'];
      if($datban == "Đặt bàn")
      {

        if( empty($_POST['hoten']) || empty($_POST['sdt']) || empty($_POST['hden']))
        {

          if(empty($_POST['hoten']))
          {
            $hotenError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập vào họ tên của bạn!</strong></div>";
          }
          if (empty($_POST['sdt']))
          {
            $sdtError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập vào số điện thoại của bạn!</strong></div>";
          }
          if (empty($_POST['hden']))
          {
            $hdenError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập vào giờ đến</strong></div>";
          }
        } else 
        {
          $hoten = checkInput($_POST['hoten']);
          $sdtkt = checkInput($_POST['sdt']);
          $pattern = "/^\+?(84|0)(1\d{9}|9\d{8})$/";
          if(preg_match($pattern, $sdtkt, $match) == 0)
          {
            $sdtError = "<div class=\"alert alert-warning\"><strong>Số điện thoại không hợp lệ!</strong></div>";
          } else
          {
            $sdt = $sdtkt;
            $hden = checkInput($_POST['hden']);
            if ($hden <= 0 || $hden > 120)
            {
              $hdenError = "<div class=\"alert alert-warning\"><strong>Thời gian hẹn tối đa là 120 phút!</strong></div>";
            }
            else
            {
              $sql = "UPDATE ban SET TrangThai = 2 WHERE IDBan = $idban";
              $thucthi = $connect->query($sql);
              $hden = countTime($hden);
              $sql1 = "INSERT INTO datban(SoBan, Hoten, Sdt, Hden) VALUES($idban, '$hoten', '$sdt', '$hden')";
              $thucthi1 = $connect->query($sql1);
              if ($thucthi1){
                phpAlert("Đặt bàn thành công");
                echo '<script type="text/javascript">
                window.location = "khdatban.php";
                </script>';
              }
              else {
                phpAlert("Đặt bàn thất bại! Vui lòng chọn bàn khác!");
                echo '<script type="text/javascript">
                window.location = "khdatban.php";
                </script>';
              }
            }
          }          
        }
      }
      else if ($datban == "Quay lại")
      {
        header('Location:khdatban.php');
      }
    }
  }
  ?>

  <div class="container">
    <h2><strong>Điền đầy đủ thông tin để đặt bàn mà bạn đã chọn</strong></h2>
    <form method="POST">
      <input type="hidden" name="idban" value="<?php echo $idban=$_POST['idban'];?>" size="30">
      <div class="form-group">
        <label for="hoten">Họ tên khách hàng:</label>
        <input type="text" class="form-control" id="hoten" placeholder="<?php echo $hoten; ?>" name="hoten">
        <?php if(isset($hotenError)){echo $hotenError;}?>
      </div>
      <div class="form-group">
        <label for="sdt">Số điện thoại:</label>
        <input type="text" class="form-control" id="sdt" placeholder="<?php echo $sdt; ?>" name="sdt">
        <?php if(isset($sdtError)){echo $sdtError;}?>
      </div>
      <div class="form-group">
        <label for="hden">Thời gian đến(Tính bằng phút, tối đa 120 phút):</label>
        <input type="number" class="form-control" id="hden" placeholder="<?php echo $hden; ?>" name="hden">
        <?php if(isset($hdenError)){echo $hdenError;}?>
      </div>
      <input type="submit" class="btn btn-default" name="datban" value="Đặt bàn">
      <input type="submit" class="btn btn-default" name="datban" value="Quay lại">
    </form>
  </div>
</body>
</html>
