<?php
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
$arrayOrder = array();
session_start();
$arrayOrder['idban'] = $_SESSION['soban'];
if ($_POST)
{
	$order = checkInput($_POST['order']);

	if ($order == "HOÀN TẤT"){
		header('Location: trangchu.php');
	}
	if ($order == "THÊM" || $order == "XÓA"){
		if (empty($_POST['tensp'])) {
			phpAlert("Bạn chưa chọn đồ uống để thao tác!!!");
		}else {
			$arrayOrder['tensp'] = checkInput($_POST['tensp']);
			$arrayOrder['sl'] = checkInput($_POST['slsp']);
			if ($arrayOrder['sl'] <= 0){
				phpAlert("Số lượng phải lớn hơn 0!");
			}else {
				if ($order == "THÊM")
				{
					$arrayOrder['thanhtien'] = tinhThanhTien($arrayOrder);
					orderMon($arrayOrder);
				} else if ( $order == "XÓA") {
					$arrayOrder['thanhtien'] = tinhThanhTien($arrayOrder);
					xoaMon($arrayOrder);
				}
			}
		}
	}
	if ($order == "XUẤT" || $order == "HỒI"){
		if (empty($_POST['tenspinkho'])) {
			phpAlert("Bạn chưa chọn sản phẩm để thao tác!!!");
		} else {
			$ten = checkInput($_POST['tenspinkho']);
			$sl = checkInput($_POST['slxk']);
			if ($sl <= 0){
				phpAlert("Số lượng phải lớn hơn 0!");
			} else {
				if ($order == "XUẤT")
				{
					xuatKho($ten, $sl);
				} else if ($order == "HỒI"){
					hoiKho($ten, $sl);
				}
			}
		}
	}
}
?>
<head><title>Quản lý Cafe</title></head>
<style>
.order {
	width:600px;
}
.order table,.order th,.order tr,.order td {
	border: 0px solid black;
	border-collapse: collapse;
}
th, td {
	padding: 15px;
	text-align: center;
}
.show {
	position: absolute; 
	right: 10px;
	top: 10px;
	width: 700px;
}
.show {
	border-collapse: collapse;
}
.show table,.show th,.show tr,.show td {
	border: 1px solid black;
}
</style>
<table class="order">
	<div class="container">
		<form method="POST">
			<tr>
				<th colspan="2"><strong><b>ORDER ĐỒ UỐNG</b></strong></th>
			</tr>
			<tr>
				<td colspan="2"><strong>SỐ BÀN: <?php echo $arrayOrder['idban'] ?></strong></td>
			</tr>
			<tr>
				<td><strong>Đồ uống: </strong></td>
				<td><div class="form-group"><select id="tenhang" name="tensp" class="form-control" style="width: 100%; height: 30px;">
					<option value="">--Chọn--</option>
					<?php
					$sql = "SELECT TenSp FROM sanpham";
					$result = $connect->query($sql);
					while ($row = $result->fetch_assoc())
					{
						?>
						<option <?php if (isset($tensp) && $tensp == $row['TenSp']) echo "selected=\"selected\""; ?> value="<?php echo $row['TenSp'] ?>" ><?php echo $row['TenSp'] ?></option>
						<?php
					}
					?>
				</select></div></td>
			</tr>
			<tr>
				<td><strong>Số lượng: </strong></td>
				<td><div class="form-group"><input type="number" name="slsp" min="1" style="width: 100%; height: 30px;"></div></td>
			</tr>
			<tr>
				<td style="text-align: right;"><input style="height: 30px; width: 100px;" type="submit" name="order" value="THÊM"></td>
				<td><input style="height: 30px; width: 100px;" type="submit" name="order" value="XÓA"></td>
			</tr>
			<tr>
				<th colspan="2"><strong><b>XUẤT/HỒI KHO</b></strong></th>
			</tr>
			<tr>
				<td><strong>Sản phẩm: </strong></td>
				<td><div class="form-group"><select id="inkho" name="tenspinkho" class="form-control" style="width: 100%; height: 30px;">
					<option value="">--Chọn--</option>
					<?php
					$sql = "SELECT Ten FROM kho";
					$result = $connect->query($sql);
					while ($row = $result->fetch_assoc())
					{
						?>
						<option <?php if (isset($tenspinkho) && $tenspinkho == $row['Ten']) echo "selected=\"selected\""; ?> value="<?php echo $row['Ten'] ?>" ><?php echo $row['Ten'] ?></option>
						<?php
					}
					?>
				</select></div></td>
			</tr>
			<tr>
				<td><strong>Số lượng: </strong></td>
				<td><div class="form-group"><input type="number" step="0.1" name="slxk" min="0" style="width: 100%; height: 30px;"></div></td>
			</tr>
			<tr>
				<td style="text-align: right;"><input style="height: 30px; width: 100px;" type="submit" name="order" value="XUẤT"></td>
				<td><input style="height: 30px; width: 100px;" type="submit" name="order" value="HỒI"></td>
			</tr>
			<tr>
				<td colspan="2"><input style="height: 30px; width: 100px;" type="submit" name="order" value="HOÀN TẤT"></td>
			</tr>
		</form>
	</div>
</table>
<table class="show" >
	<thead>
		<tr>
			<th colspan="3"><strong><b>DANH SÁCH ĐÃ ORDER</b></strong></th>
		</tr>
		<tr>
			<th>ĐỒ UỐNG</th>
			<th>SỐ LƯỢNG</th>
			<th>THÀNH TIỀN(VNĐ)</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$sql = "SELECT tensp, sl, thanhtien FROM ordersp WHERE idban = '".$arrayOrder['idban']."' AND trangthai = 0 ORDER BY tensp;";
		$result = $connect->query($sql);
		while ($row = $result->fetch_assoc()) {

			?>
			<tr>
				<td><?php echo $row['tensp'] ?></td>
				<td><?php echo $row['sl'] ?></td>
				<td><?php echo $row['thanhtien'] ?></td>
			</tr>
			<?php
		}
		?>
	</tbody>
</table>

