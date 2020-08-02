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
                  <div class="panel-heading"><p style="text:center"><?php echo $row['IDBan'] ?></p>
                      <input type="hidden" name="idban" value="<?php echo $row['IDBan'] ?>" size="30">
                      <!-- <input type="submit" name="setup" value="Đặt trước" style="background-color: green;">
                      <input type="submit" name="setup" value="Có khách" style="background-color: green;"> -->
                      </div>
                  <div class="panel-body"><img style="height: 250px; width: 330px;" src="./images/<?php echo $row['HinhAnh'] ?>" class="img-responsive" style="width:100%;" alt="Image"></div>
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
              <form action="xulyban.php" method="POST">
                <div class="col-sm-4">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <?php echo $row['IDBan'] ?>
                      <input type="hidden" name="idban" value="<?php echo $row['IDBan'] ?>" size="30">
                      <input type="submit" name="setup" value="Order" style="background-color: green;">
                      <input type="submit" name="setup" formtarget="_blank" value="Tính tiền" style="background-color: green;">
                      <input type="submit" name="setup" value="Trống" style="background-color: green;">
                    </div>
                    <div class="panel-body"><img style="height: 250px; width: 330px;" src="./images/<?php echo $row['HinhAnh'] ?>" class="img-responsive" style="width:100%;" alt="Image"></div>
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

      <div id="bookedtb" class="tab-pane fade">
        <div class="container">
          <div class="row">
            <?php
            $sql = "select IDBan, HinhAnh, ViTri from ban where TrangThai = 2";
            $result = $connect->query($sql);
            while ($row = $result->fetch_assoc()) 
            {
              ?>
              <form action="xulyban.php" method="POST">
                <div class="col-sm-4">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <?php echo $row['IDBan'] ?>
                      <input type="hidden" name="idban" value="<?php echo $row['IDBan'] ?>" size="30">
                      <input type="submit" name="setup" value="Thông tin" style="background-color: green;">
                      <input type="submit" name="setup" value="Đã đến" style="background-color: green;">
                      <input type="submit" name="setup" value="Hủy" style="background-color: green;">
                    </div>
                    <div class="panel-body"><img style="height: 250px; width: 330px;" src="./images/<?php echo $row['HinhAnh'] ?>" class="img-responsive" style="width:100%;" alt="Image"></div>
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

      <div id="emtytb" class="tab-pane fade">
        <div class="container">
          <div class="row">
            <?php
            $sql = "select IDBan, HinhAnh, ViTri from ban where TrangThai = 0";
            $result = $connect->query($sql);
            while ($row = $result->fetch_assoc()) {
              ?>
              <form action="xulyban.php" method="POST">
                <div class="col-sm-4">
                  <div class="panel panel-primary">
                    <div class="panel-heading">
                      <?php echo $row['IDBan'] ?>
                      <input type="hidden" name="idban" value="<?php echo $row['IDBan'] ?>" size="30">
                      <input type="submit" name="setup" value="Đặt trước" style="background-color: green;">
                      <input type="submit" name="setup" value="Có khách" style="background-color: green;">
                    </div>
                    <div class="panel-body"><img style="height: 250px; width: 330px;" src="./images/<?php echo $row['HinhAnh'] ?>" class="img-responsive" style="width:100%;" alt="Image"></div>
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
