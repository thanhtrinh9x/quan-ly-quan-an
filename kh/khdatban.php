<!DOCTYPE html>
<html lang="en">
<head>
  <title>Quản lý Cafe</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/jquery-3.3.1.min.js"></script>
  <script src="../js/bootstrap.min.js"></script>
  <style>
  /* Remove the navbar's default rounded borders and increase the bottom margin */ 
  .navbar {
    margin-bottom: 50px;
    border-radius: 0;
  }
  
  /* Remove the jumbotron's default bottom margin */ 
  .jumbotron {
    margin-bottom: 0;
    padding-top: 0;
    padding-bottom: 0;
  }
  
</style>
</head>
<body background="../images/bg.jpg">
  <?php 
  include '../include/function.php';
  $connect = connectDB();
  $lenh = "USE qly_cafe";
  $connect->query($lenh);
  ?>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">MILANO CAFE</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="khdatban.php">Đặt bàn</a></li>
        </ul>
      </div>
    </div>
  </nav>


  <div class="container">
    <h2>Bạn sẽ ngồi ở đâu?</h2>
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#alltb"><b>Tất cả</b></a></li>
      <li><a data-toggle="tab" href="#busytb"><b>Bàn đang có khách ngồi</b></a></li>
      <li><a data-toggle="tab" href="#bookedtb"><b>Bàn đã đặt trước</b></a></li>
      <li><a data-toggle="tab" href="#emtytb"><b>Bàn trống</b></a></li>
    </ul><br>

    <div class="tab-content">
      <div id="alltb" class="tab-pane fade">    
        <div class="container">
          <div class="row">
            <?php
            $sql = "select IDBan, HinhAnh, ViTri from ban";
            $result = $connect->query($sql);
            while ($row = $result->fetch_assoc())
            {

              ?>
              <div class="col-sm-4">
                <div class="panel panel-primary">
                  <div class="panel-heading"><?php echo $row['IDBan'] ?></div>
                  <div class="panel-body"><img style="height: 250px; width: 330px;" src="../images/<?php echo $row['HinhAnh'] ?>" class="img-responsive" style="width:100%;" alt="Image"></div>
                  <div class="panel-footer"><?php echo $row['ViTri'] ?></div>
                </div>
              </div>
              <?php
            }
            ?>
          </div>
        </div>
      </div>

      <div id="busytb" class="tab-pane fade">
        <div class="container">
          <div class="row">
            <?php
            $sql = "select IDBan, HinhAnh, ViTri from ban where TrangThai = 1";
            $result = $connect->query($sql);
            while ($row = $result->fetch_assoc()) 
            {
              ?>
              <div class="col-sm-4">
                <div class="panel panel-primary">
                  <div class="panel-heading"><?php echo $row['IDBan'] ?></div>
                  <div class="panel-body"><img style="height: 250px; width: 330px;" src="../images/<?php echo $row['HinhAnh'] ?>" class="img-responsive" style="width:100%;" alt="Image"></div>
                  <div class="panel-footer"><?php echo $row['ViTri'] ?></div>
                </div>
              </div>
              <?php
            }
            ?>     
          </div>
        </div>
      </div>

      <div id="bookedtb" class="tab-pane fade">
        <div class="container">
          <div class="row">
            <?php
            $sql = "select IDBan, HinhAnh, ViTri from ban where TrangThai = 2";
            $result = $connect->query($sql);
            while ($row = $result->fetch_assoc()) 
            {
              ?>
              <div class="col-sm-4">
                <div class="panel panel-primary">
                  <div class="panel-heading"><?php echo $row['IDBan'] ?></div>
                  <div class="panel-body"><img style="height: 250px; width: 330px;" src="../images/<?php echo $row['HinhAnh'] ?>" class="img-responsive" style="width:100%;" alt="Image"></div>
                  <div class="panel-footer"><?php echo $row['ViTri'] ?></div>
                </div>
              </div>
              <?php
            }
            ?>   
          </div>
        </div>
      </div>

      <div id="emtytb" class="tab-pane fade">
        <div class="container">
          <div class="row">
            <?php
            $sql = "select IDBan, HinhAnh, ViTri from ban where TrangThai = 0";
            $result = $connect->query($sql);
            while ($row = $result->fetch_assoc()) 
            {
              ?>
              <form action="datban.php" method="POST">
                <div class="col-sm-4">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <?php echo $row['IDBan'] ?>
                      <input type="hidden" name="idban" value="<?php echo $row['IDBan'] ?>" size="30">
                      <input type="submit" name="setup" value="Đặt bàn" style="background-color: green;">
                    </div>
                    <div class="panel-body"><img style="height: 250px; width: 330px;" src="../images/<?php echo $row['HinhAnh'] ?>" class="img-responsive" style="width:100%;" alt="Image"></div>
                    <div class="panel-footer"><?php echo $row['ViTri'] ?></div>
                  </div>
                </div>
              </form>
              <?php
            }
            ?>
          </div>
        </div>

      </div>
    </div>
  </div>

</body>
</html>
