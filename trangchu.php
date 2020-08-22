<!DOCTYPE html>
<html lang="en">
<?php
include 'include/index.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
?>
 </script>
 </head>
 <body style="background-image: url('images/bg.jpg');size:autobackground-size: cover;">

<div class="container">
  <div class="row">
          <?php
          $sql = "select * from ban";
          $result = $connect->query($sql);
          while ($row = $result->fetch_assoc()) 
          {
            ?>
            <form action="xulyban.php" method="POST">
              <div class="col-sm-4">
                <div class="panel panel-primary">
                
                  <div class="panel-heading">   
                  <h5>Bàn số <?php echo $row['IDBan'];echo " : " ;echo $row['ViTri'] ?></h5>                 
                    <input type="hidden" name="idban" value="<?php echo $row['IDBan'] ?>" size="30">
                    <input type="submit" name="setup" value="Order" style="background-color: #F4A460;">
                    <input type="submit" name="setup" formtarget="_blank" value="Tính tiền" style="background-color: #32CD32;">
                    <?php if($row['TrangThai'] == 0)
                        echo '<input type="submit" name="setup" value="Trống" style="background-color: #32CD32;">';
                    ?>
                  </div>
                  <div class="panel-body"><img style="height: 250px; width: 330px;" src="./images/<?php echo $row['HinhAnh'] ?>" class="img-responsive" style="width:100%;" alt="Image"></div>
                  
                </div>
              </div>
            </form>
            <?php
          }
          ?>     
          
  </div>
</div>

</body>
</html>
