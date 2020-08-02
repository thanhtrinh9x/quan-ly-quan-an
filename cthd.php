<?php
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
$shd = $_GET['shd'];
$sql = "SELECT ChiTiet FROM hoadon WHERE SoHD = '$shd'";
$thucthi = $connect->query($sql);
$row = $thucthi->fetch_assoc();
$cthd = $row['ChiTiet'];
$data = json_decode($cthd);
?>

<head>
	<title>Chi tiết hóa đơn</title>
</head>
<style>
table, th, tr, td {
	border: 1px solid black;
	border-collapse: collapse;
}
th, td {
	padding: 15px;
	text-align: center;
}
</style>
<body>
	<h2><b><strong>CHI TIẾT HÓA ĐƠN</strong></b></h2>
	<table>
		<tr>
			<th>SẢN PHẨM</th>
			<th>SỐ LƯỢNG</th>
			<th>GIÁ TIỀN</th>
			<th>THÀNH TIỀN</th>
		</tr>
		<?php
		$i = 0;
		while (@$data->{'DSMenu'}[$i]) {
			?>
			<tr>
				<td><?php print_r($data->{'DSMenu'}[$i]->{'TenSp'});?></td>
				<td><?php print_r($data->{'DSMenu'}[$i]->{'SoLuong'});?></td>
				<?php $sql1= "SELECT GiaTien FROM sanpham WHERE TenSp = '".$data->{'DSMenu'}[$i]->{'TenSp'}."'";
				$thucthi1= $connect->query($sql1);
				$row = $thucthi1->fetch_assoc();
				$giatien = $row['GiaTien'];
				?>
				<td><?php echo $giatien; ?></td>
				<td><?php print_r($data->{'DSMenu'}[$i]->{'ThanhTien'});?></td>
			</tr>
			<?php
			$i++;
		}
		?>
	</table>
</body>