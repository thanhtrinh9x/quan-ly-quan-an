<?php
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
if( !empty($_POST['setup'])){
	$setup = $_POST['setup'];
	$idban = $_POST['idban'];
	if( $setup == "Tính tiền"){
		session_start();
		$_SESSION['soban'] = $idban;
		$_SESSION['sohd'] = taoHoaDon($idban);
	}
	if ($setup == "Trống")
	{
		$sql = "SELECT * FROM ordersp WHERE idban = '$idban' AND trangthai = 0";
		$query= $connect->query($sql);
		$rows= mysqli_num_rows($query);
		if($rows > 0){
			phpAlert("Bàn có đồ uống chưa xuất hóa đơn! Không thể chuyển về bàn trống!!!");
			echo '<script type="text/javascript">
			window.location = "trangchu.php";
			</script>';
		} else {
			$sql = "UPDATE ban SET TrangThai = 0 WHERE IDBan = '$idban'";
			$thucthi = $connect->query($sql);
			header('Location:trangchu.php');
		}
	}
	if( $setup == "Hủy"){
		$sql = "UPDATE ban SET TrangThai = 0 WHERE IDBan = '$idban'";
		$thucthi = $connect->query($sql);
		$sql = "DELETE FROM datban WHERE SoBan = '$idban'";
		$thucthi = $connect->query($sql);
		header('Location:trangchu.php');
	}
	if($setup == "Đã đến"){
		$sql = "UPDATE ban SET TrangThai = 1 WHERE IDBan = '$idban'";
		$thucthi = $connect->query($sql);
		$sql = "DELETE FROM datban WHERE SoBan = '$idban'";
		$thucthi = $connect->query($sql);
		header('Location:trangchu.php');
	}
	if($setup == "Có khách"){
		$sql = "UPDATE ban SET TrangThai = 1 WHERE IDBan = '$idban'";
		$thucthi = $connect->query($sql);
		header('Location:trangchu.php');
	}
	if($setup == "Đặt trước"){
		session_start();
		$_SESSION['soban'] = $idban;
		header('Location:nvdat.php');
	}
	if($setup == "Order"){
		session_start();
		$_SESSION['soban'] = $idban;
		header('Location:order.php');
	}
	if($setup == "Thông tin"){
		session_start();
		$_SESSION['soban'] = $idban;
		header('Location:thongtin.php');
	}
}
?>