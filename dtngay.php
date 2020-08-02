<?php 
include 'doanhthu.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
date_default_timezone_set("Asia/Ho_Chi_Minh");
$tght = time();
$date = "";
if( !empty($_POST['xem'])){
	if(empty($_POST['date'])){
		phpAlert("Bạn chưa chọn ngày để xem!!!");
	} else{
		$ngay = checkInput($_POST['date']);
		if (strtotime($ngay) > $tght){
			phpAlert("Ngày của tương lai! Vui lòng chọn lại!!!");
		} else {
			$date = $ngay;
			$sql = "SELECT sum(TongTien) AS Tong FROM doanhthu WHERE NgayBan = '$date'";
			$thucthi = $connect->query($sql);
			$row = $thucthi->fetch_assoc();
			$tt = $row['Tong'];
		}
	}
}
?>
<body>

	<div class="container">
		<form method="POST">
			<h2 style="text-align: center;"><b>DANH SÁCH SẢN PHẨM ĐÃ BÁN RA TRONG NGÀY:</b></h2>
			<input class="form-control" style="width: 80%;" type="date" name="date" id="date">
			<input style="position: absolute; right: 105px; top: 262px; width: 15%; height: 34px;" type="submit" name="xem" value="XEM">
			<br>       
			<table class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>STT</th>
						<th>TÊN SẢN PHẨM</th>
						<th>SỐ LƯỢNG</th>
						<th>TỔNG TIỀN</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT * FROM doanhthu WHERE NgayBan = '$date'";
					$result = $connect->query($sql);
					while ($row = $result->fetch_assoc()) {

						?>
						<tr>
							<td><?php echo $row['STT'] ?></td>
							<td><?php echo $row['TenSp'] ?></td>
							<td><?php echo $row['SoLuong'] ?></td>
							<td><?php echo $row['TongTien'] ?></td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
			<p><b><big><strong>TỔNG DOANH THU NGÀY <?php echo checkInput(@$_POST['date']); ?> : <?php echo @$tt." "."VND";?></strong></big></b></p>
		</form>
	</div>
	<br>