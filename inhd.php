<head>
	<title>T&T Coffee</title>
</head>
<style>
body {
	margin: 0;
	padding: 0;
	background-color: #FAFAFA;
	font: 12pt "Tohoma";
}
* {
	box-sizing: border-box;
	-moz-box-sizing: border-box;
}
.page {
	width: 21cm;
	overflow:hidden;
	min-height:297mm;
	padding: 2.5cm;
	margin-left:auto;
	margin-right:auto;
	background: white;
	box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}
.subpage {
	padding: 1cm;
	border: 5px red solid;
	height: 237mm;
	outline: 2cm #FFEAEA solid;
}
@page {
	size: A5;
	margin: 0;
}
button {
	width:100px;
	height: 24px;
}
.header {
	overflow:hidden;
}
.logo {
	background-color:#FFFFFF;
	text-align:left;
	float:left;
}
.company {
	padding-top:24px;
	text-transform:uppercase;
	background-color:#FFFFFF;
	text-align:right;
	float:right;
	font-size:16px;
}
.title {
	text-align:center;
	position:relative;
	color:#0000FF;
	font-size: 24px;
	top:1px;
}
.footer-left {
	text-align:center;
	text-transform:uppercase;
	padding-top:24px;
	position:relative;
	height: 150px;
	width:50%;
	color:#000;
	float:left;
	font-size: 12px;
	bottom:1px;
}
.footer-right {
	text-align:center;
	text-transform:uppercase;
	padding-top:24px;
	position:relative;
	height: 150px;
	width:50%;
	color:#000;
	font-size: 12px;
	float:right;
	bottom:1px;
}
.TableData {
	background:#ffffff;
	font: 11px;
	width:100%;
	border-collapse:collapse;
	font-family:Verdana, Arial, Helvetica, sans-serif;
	font-size:12px;
	border:thin solid #d3d3d3;
}
.TableData th {
	background: rgba(0,0,255,0.1);
	text-align: center;
	font-weight: bold;
	color: #000;
	border: solid 1px #ccc;
	height: 24px;
}
.TableData tr {
	height: 24px;
	border:thin solid #d3d3d3;
}
.TableData tr td {
	padding-right: 2px;
	padding-left: 2px;
	border:thin solid #d3d3d3;
}
.TableData tr:hover {
	background: rgba(0,0,0,0.05);
}
.TableData .cotSTT {
	text-align:center;
	width: 10%;
}
.TableData .cotTenSanPham {
	text-align:left;
	width: 40%;
}
.TableData .cotHangSanXuat {
	text-align:left;
	width: 20%;
}
.TableData .cotGia {
	text-align:right;
	width: 120px;
}
.TableData .cotSoLuong {
	text-align: center;
	width: 50px;
}
.TableData .cotSo {
	text-align: right;
	width: 120px;
}
.TableData .tong {
	text-align: right;
	font-weight:bold;
	text-transform:uppercase;
	padding-right: 4px;
}
.TableData .cotSoLuong input {
	text-align: center;
}
@media print {
	@page {
		margin: 0;
		border: initial;
		border-radius: initial;
		width: initial;
		min-height: initial;
		box-shadow: initial;
		background: initial;
		page-break-after: always;
	}
}
</style>
<body onload="window.print();">
	<div id="page" class="page">
		<div class="header">
			<div class="logo"><img src="./images/logo.jpg"/></div>
			<div class="company"><strong><b>T&T Coffee</b></strong></div>
		</div>
		<br/>
		<div class="title">
			HÓA ĐƠN THANH TOÁN
			<br/>
			-------oOo-------
		</div>
		<p><strong><b>Địa chỉ: Quận Bình Tân, TP. HCM</b></strong></p>
		<br/>
		------------------------------------------------------------
		<br/>
		<br/>
		<?php
		session_start();
		$idban = $_SESSION['soban'];
		$sohd = $_SESSION['sohd'];
		date_default_timezone_set("Asia/Ho_Chi_Minh");
		$tght = time();
		$tgxhd = date("d-m-Y H:i:s", $tght);
		?>
		<p><strong><b>Số hóa đơn: <?php echo $sohd; ?></b></strong></p>
		<p><strong><b>Số bàn: <?php echo $idban; ?></b></strong></p>
		<p><strong><b>Ngày: <?php echo $tgxhd; ?></b></strong></p>
		<table class="TableData">
			<tr>
				<th>STT</th>
				<th>Tên</th>
				<th>Số lượng</th>
				<th>Thành tiền</th>
			</tr>
			<?php
			$pos = 1;
			$tongtien = 0;
			include 'include/function.php';
			$connect = connectDB();
			$lenh = "USE qly_cafe";
			$connect -> query($lenh);
			$sql = "SELECT tensp, sl, thanhtien FROM ordersp WHERE idban = '$idban' AND trangthai = 0 ORDER BY tensp;";
			$result = $connect->query($sql);
			while ($row = $result->fetch_assoc())
			{
				$tongtien = $tongtien + $row['thanhtien'];
				echo "<tr>";
				echo "<td class=\"cotSTT\">".$pos++."</td>";
				echo "<td class=\"cotTenSanPham\">".$row['tensp']."</td>";
				echo "<td class=\"cotSoLuong\" align='center'>".$row['sl']."</td>";
				echo "<td class=\"cotSo\">".$row['thanhtien']."</td>";
				echo "</tr>";
			}       
			?>
			<tr>
				<td colspan="3" class="tong">Tổng cộng</td>
				<td class="cotSo"><?php echo number_format(($tongtien),0,",",".")?></td>
			</tr>
		</table>
		<div class="footer-right">Cảm ơn Quý Khách! Hẹn gặp lại!
		<a href="trangchu.php">Trang Chủ </a>
		</div>
	</div>
</body>
<?php
$now = time();
$now = date("Y-m-d",$now);
$sql = "SELECT tensp, sl, thanhtien FROM ordersp WHERE idban = '$idban' AND trangthai = 0";
$thucthi = $connect->query($sql);
$sql1 = "UPDATE ordersp SET trangthai = 1 WHERE idban = '$idban' AND trangthai = 0";
$thucthi1 = $connect->query($sql1);
while ($row = $thucthi->fetch_assoc()) {
	$sql2 = "SELECT * FROM doanhthu WHERE TenSp = '".$row['tensp']."' AND  NgayBan = '$now'";
	$thucthi2= $connect->query($sql2);
	$rows= mysqli_num_rows($thucthi2);
	if ($rows > 0){
		$sql3 = "UPDATE doanhthu SET SoLuong = SoLuong + '".$row['sl']."', TongTien = TongTien + '".$row['thanhtien']."' WHERE TenSp = '".$row['tensp']."' AND  NgayBan = '$now'";
		$thucthi3=$connect->query($sql3);
	} else {
		$sql4 = "INSERT INTO doanhthu(TenSp, SoLuong, TongTien, NgayBan) VALUES('".$row['tensp']."', '".$row['sl']."', '".$row['thanhtien']."', '$now')";
		$thucthi4 = $connect->query($sql4);
	}
}
?>