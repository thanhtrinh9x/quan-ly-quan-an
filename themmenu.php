<?php
include 'updatemenu.php';
include 'include/function.php';
$connect = connectDB();
$lenh = "USE qly_cafe";
$connect -> query($lenh);
if ($_POST)
{
	if (!empty($_POST['nutnhan']))
	{
		$tuychon = $_POST['nutnhan'];
		if($tuychon == "THÊM")
		{
			if (empty($_POST['masp']) || empty($_POST['tensp']) || empty($_POST['giasp']))
			{
				if(empty($_POST['masp']))
				{
					$maspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập mã sản phẩm!</strong></div>";
				}
				if (empty($_POST['tensp']))
				{
					$tenspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập tên sản phẩm!</strong></div>";
				}
				if (empty($_POST['giasp']))
				{
					$giaspError = "<div class=\"alert alert-warning\"><strong>Bạn chưa nhập giá sản phẩm</strong></div>";
				}
			}
			else
			{
				$masp = checkInput($_POST['masp']);
				$tensp = checkInput($_POST['tensp']);
				$giasp = checkInput($_POST['giasp']);
				if ($giasp <= 0){
					$giaspError = "<div class=\"alert alert-warning\">Giá sản phẩm không được nhỏ hơn 0</div>";
				}
				else
				{
					$sql = "INSERT INTO sanpham(MaSP, TenSp, GiaTien) VALUES('$masp', '$tensp', '$giasp')";
					$thucthi = $connect->query($sql);
					if ($thucthi)
						phpAlert("Thêm sản phẩm thành công");
					else
						phpAlert("Lỗi! Thêm sản phẩm thất bại!");
				}
			}
		}
	}
}
?>

<div class="container">
	<form method="POST">
		<div class="form-group">
			<label for="idsp">ID</label>
			<input type="text" class="form-control" id="idsp" name="masp" placeholder="Nhập vào mã hàng mới">
			<?php if(isset($maspError)){echo $maspError;}?>
		</div>
		<div class="form-group">
			<label for="tenhang">Tên hàng:</label>
			<input type="text" class="form-control" id="tenhang" name="tensp" placeholder="Nhập vào tên hàng">
			<?php if(isset($tenspError)){echo $tenspError;}?>
		</div>
		<div class="form-group">
			<label for="gia">Giá(VND):</label>
			<input type="number" class="form-control" id="gia" name="giasp" placeholder="Nhập vào giá nhập hàng">
			<?php if(isset($giaspError)){echo $giaspError;}?>
		</div>
		<div class="container" style="padding-left: 430px;">
			<input type="submit" style="height: 40px; width: 150px; background-color:#50ba18; font-size: 120%; font-weight: bold;" class="btn btn-default" name="nutnhan" value="THÊM">
			<input type="reset" style="height: 40px; width: 150px; background-color:yellow; font-size: 120%; font-weight: bold;" class="btn btn-default" value="RESET"><br>
		</div>
	</form>
</div>