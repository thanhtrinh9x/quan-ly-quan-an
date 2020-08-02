<!DOCTYPE html>
<html lang="en">
<head>
  <title>Thông tin bàn đặt</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <h2><strong>Thông tin của khách đã đặt bàn</strong></h2>
    
    <?php
    include 'include/function.php';
    $connect = connectDB();
    $lenh = "USE qly_cafe";
    $connect -> query($lenh);
    session_start();
    $soban = $_SESSION['soban'];
    $sql = "SELECT * FROM datban WHERE SoBan = $soban";
    $result = $connect->query($sql);
    while ($row = $result->fetch_assoc()) 
    {
      ?>
      <form class="form-horizontal" action="trangchu.php">
        <div class="form-group">
          <label class="control-label col-sm-2">Số bàn:</label>
          <div class="col-sm-10">
            <p class="form-control-static"><b><?php echo $row['SoBan'];?></b></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2">Họ tên khách:</label>
          <div class="col-sm-10">
            <p class="form-control-static"><b><?php echo $row['Hoten']; ?></b></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" >Số điện thoại:</label>
          <div class="col-sm-10">
            <p class="form-control-static"><b><?php echo $row['Sdt']; ?></b></p>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2">Giờ đến:</label>
          <div class="col-sm-10">
            <p class="form-control-static"><b><?php echo $row['Hden']; ?></b></p>
          </div>
        </div>
        <div class="form-group">        
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" class="btn btn-default" value="Quay lại">
          </div>
        </div>
      </form>
      <?php
    }
    ?> 
  </div>

</body>
</html>
