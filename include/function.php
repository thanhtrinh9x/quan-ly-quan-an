<?php
function connectDB(){
	$servername = 'localhost';
	$username = 'root';
	$password = '';

	$connect = mysqli_connect($servername,$username, $password);
	mysqli_set_charset($connect, 'UTF8');
	return $connect;
}

function checkInput($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function phpAlert($msg){
	echo '<script type="text/javascript">alert("'.$msg.'")</script>';
}

function countTime($time){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$tght = time();
	date("Y-m-d H:i:s", $tght);
	$hden = $tght + $time*60;
	$hden = date("Y-m-d H:i:s",$hden);
	return $hden;
}

function ssNgay($time){
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$tght = time();
	if (strtotime($time) > $tght )
		return 1;
	else
		return 0;
}

function tinhThanhTien($arrayOrder){
	$connect = connectDB();
	$lenh = "USE qly_cafe";
	$connect -> query($lenh);
	$sql = "SELECT GiaTien FROM sanpham WHERE TenSp ='".$arrayOrder['tensp']."'";
	$thucthi = $connect->query($sql);
	$row = $thucthi->fetch_assoc();
	$giatien = checkInput($row['GiaTien']);
	$arrayOrder['thanhtien'] = $arrayOrder['sl'] * $giatien;
	return $arrayOrder['thanhtien'];
}

function orderMon($arrayOrder){
	$connect = connectDB();
	$lenh = "USE qly_cafe";
	$connect -> query($lenh);
	$sql = "SELECT count(tensp) AS ktra FROM ordersp WHERE idban = '".$arrayOrder['idban']."' AND tensp = '".$arrayOrder['tensp']."' AND trangthai = 0";
	$thucthi = $connect->query($sql);
	$row = $thucthi->fetch_assoc();
	$ktra = checkInput($row['ktra']);
	if ($ktra < 1) {
		$sql = "INSERT INTO ordersp(idban, tensp, sl, thanhtien, trangthai) VALUES('".$arrayOrder['idban']."', '".$arrayOrder['tensp']."', '".$arrayOrder['sl']."', '".$arrayOrder['thanhtien']."', 0)";
		$thucthi = $connect->query($sql);
		if ($thucthi){
			phpAlert("Thêm thành công!");
		} else { phpAlert("Thêm thất bại! Vui lòng thử lại!");}
	} else {
		$sql = "UPDATE ordersp SET sl =  sl + '".$arrayOrder['sl']."', thanhtien = thanhtien + '".$arrayOrder['thanhtien']."' WHERE idban = '".$arrayOrder['idban']."' AND tensp = '".$arrayOrder['tensp']."' AND trangthai = 0";
		$thucthi = $connect->query($sql);
		if ($thucthi){
			phpAlert("Thêm thành công!");
		} else { phpAlert("Thêm thất bại! Vui lòng thử lại!");}
	}
}

function xoaMon($arrayOrder){
	$connect = connectDB();
	$lenh = "USE qly_cafe";
	$connect -> query($lenh);
	$sql = "SELECT count(tensp) AS ktra, sl FROM ordersp WHERE idban = '".$arrayOrder['idban']."' AND tensp = '".$arrayOrder['tensp']."' AND trangthai = 0";
	$thucthi = $connect->query($sql);
	$row = $thucthi->fetch_assoc();
	$ktra = checkInput($row['ktra']);
	$sl = checkInput($row['sl']);
	if ($ktra < 1) 
	{
		phpAlert("Sản phẩm muốn xóa không tồn tại!");
	} else 
	{
		$slx = $arrayOrder['sl'];
		if ($slx > $sl){
			phpAlert("Số lượng muốn xóa nhiều hơn số lượng đã order! Vui lòng xem lại!");
		} else {
			if ($sl <= 1 || $slx == $sl)
			{
				$sql = "DELETE FROM ordersp WHERE idban = '".$arrayOrder['idban']."' AND tensp = '".$arrayOrder['tensp']."' AND trangthai = 0";
				$thucthi = $connect->query($sql);
				if ($thucthi){
					phpAlert("Xóa thành công!");
				} else { phpAlert("Xóa thất bại! Vui lòng thử lại!");}
			} else{
				$sql = "UPDATE ordersp SET sl =  sl - '".$arrayOrder['sl']."', thanhtien = thanhtien - '".$arrayOrder['thanhtien']."' WHERE idban = '".$arrayOrder['idban']."' AND tensp = '".$arrayOrder['tensp']."' AND trangthai = 0";
				$thucthi = $connect->query($sql);
				if ($thucthi){
					phpAlert("Xóa thành công!");
				} else { phpAlert("Xóa thất bại! Vui lòng thử lại!");}
			}
		}
	}
}

function taoHoaDon($idban){
	$connect = connectDB();
	$lenh = "USE qly_cafe";
	$connect -> query($lenh);
	$tt = 0;
	$chitiet = '';
	date_default_timezone_set("Asia/Ho_Chi_Minh");
	$tght = time();
	$tgxhd = date("Y-m-d H:i:s", $tght);
	$sql = "SELECT tensp AS 'TenSp', sl AS 'SoLuong' ,thanhtien AS 'ThanhTien' FROM ordersp WHERE idban = '$idban' AND trangthai = 0";
	$query= $connect->query($sql);
	while ($row = $query->fetch_assoc()) {
		$ct = json_encode($row,JSON_UNESCAPED_UNICODE);
		$chitiet = $chitiet .",".  $ct;
		$tt = $tt + $row['ThanhTien'];
	}
	if(empty($chitiet)){
		echo '<script type="text/javascript">
		alert("Chưa order đồ uống nên không thể tính tiền!");
		window.location = "trangchu.php";
		</script>';
	}else {
		echo '<script type="text/javascript">
		alert("CHÚ Ý!!! Sau khi in hóa đơn phải tải lại trang chủ để cập nhập hệ thống!!!");
		window.location = "inhd.php";
		</script>';
		$sql = "UPDATE ban SET TrangThai = 0 WHERE IDBan = '$idban'";
		$thucthi = $connect->query($sql);
		$chitiet = trim($chitiet,',');
		$chitiet = '{"DSMenu":['."".$chitiet."".']}';
		$sql = "INSERT INTO hoadon(SoBan, ChiTiet, TongTien, NgayXuatHD) VALUES('$idban', '$chitiet', '$tt', '$tgxhd')";
		$thucthi = $connect->query($sql);
		$sql = "SELECT SoHD FROM hoadon WHERE SoBan = '$idban' AND ChiTiet = '".$chitiet."' AND TongTien = '$tt' AND NgayXuatHD = '$tgxhd'";
		$thucthi = $connect->query($sql);
		$row = $thucthi->fetch_assoc();
		$sohd = $row['SoHD'];
		return $sohd;
		echo '<script type="text/javascript">
		alert("CHÚ Ý!!! Sau khi in hóa đơn phải tải lại trang chủ để cập nhập hệ thống!!!");
		window.location = "inhd.php";
		</script>';
	}
}

function xuatKho($ten, $sl){
	$connect = connectDB();
	$lenh = "USE qly_cafe";
	$connect -> query($lenh);
	$sql = "SELECT DVT, SLT FROM kho WHERE Ten = '$ten'";
	$thucthi = $connect->query($sql);
	$row = $thucthi->fetch_assoc();
	$dvt = $row['DVT'];
	$slt = $row['SLT'];
	if ($sl > $slt){
		phpAlert("Số lượng xuất kho lớn hơn số lượng tồn trong kho! Vui lòng kiếm tra lại!");
	} else {
		$sql = "UPDATE kho SET SLT = SLT - '$sl' WHERE Ten = '$ten'";
		$thucthi = $connect->query($sql);
		if($thucthi) {
			$tb = "Đã xuất từ kho"." "."$sl"." "."$dvt"." "."$ten";
			phpAlert($tb);
		} else phpAlert("Xuất kho thất bại!");
	}
}

function hoiKho($ten, $sl){
	$connect = connectDB();
	$lenh = "USE qly_cafe";
	$connect -> query($lenh);
	$sql = "SELECT DVT FROM kho WHERE Ten = '$ten'";
	$thucthi = $connect->query($sql);
	$row = $thucthi->fetch_assoc();
	$dvt = $row['DVT'];
	$sql = "UPDATE kho SET SLT = SLT + '$sl' WHERE Ten = '$ten'";
	$thucthi = $connect->query($sql);
	if($thucthi) {
		$tb = "Đã hồi lại kho"." "."$sl"." "."$dvt"." "."$ten";
		phpAlert($tb);
	} else phpAlert("Hồi kho thất bại!");
}

?>
