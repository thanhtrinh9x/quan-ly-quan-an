-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 08, 2018 lúc 12:39 PM
-- Phiên bản máy phục vụ: 10.1.31-MariaDB
-- Phiên bản PHP: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `qly_cafe`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ban`
--

CREATE TABLE `ban` (
  `IDBan` int(20) NOT NULL,
  `HinhAnh` text COLLATE utf8_vietnamese_ci NOT NULL,
  `ViTri` text COLLATE utf8_vietnamese_ci NOT NULL,
  `TrangThai` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `ban`
--

INSERT INTO `ban` (`IDBan`, `HinhAnh`, `ViTri`, `TrangThai`) VALUES
(1, '1.jpg', 'Bàn dài trong nhà', 1),
(2, '2.jpg', 'Bàn tròn nhỏ trong nhà', 0),
(3, '3.jpg', 'Bàn chiếc lá trên tầng 1', 0),
(4, '4.jpg', 'Bàn vuông trước quầy bar', 0),
(5, '5.jpg', 'Bàn tròn phong cách xưa', 0),
(6, '6.jpg', 'Bàn vuông với ghế thấp trong nhà', 0),
(7, '7.jpg', 'Bàn vuông nhỏ ngoài ban công', 0),
(8, '8.jpg', 'Bàn ghép với ban công', 0),
(9, '9.jpg', 'Bàn chất', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `datban`
--

CREATE TABLE `datban` (
  `SoBan` int(11) NOT NULL,
  `Hoten` text COLLATE utf8_vietnamese_ci NOT NULL,
  `Sdt` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `Hden` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `doanhthu`
--

CREATE TABLE `doanhthu` (
  `STT` int(11) NOT NULL,
  `TenSp` text COLLATE utf8_vietnamese_ci NOT NULL,
  `SoLuong` int(11) NOT NULL,
  `TongTien` int(11) NOT NULL,
  `NgayBan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `doanhthu`
--

INSERT INTO `doanhthu` (`STT`, `TenSp`, `SoLuong`, `TongTien`, `NgayBan`) VALUES
(3, 'CAFE ĐEN NÓNG/ĐÁ', 1, 15000, '2018-05-06'),
(4, 'SINH TỐ BƠ', 1, 20000, '2018-05-06'),
(5, 'SINH TỐ BƠ', 2, 40000, '2018-05-07'),
(6, 'CAFE ĐEN NÓNG/ĐÁ', 2, 30000, '2018-05-07'),
(7, 'PEPSI', 4, 48000, '2018-05-07'),
(8, 'CAPUCHINO', 4, 100000, '2018-05-07'),
(10, 'STING', 1, 12000, '2018-05-07'),
(11, 'TRÀ ĐÀO', 3, 45000, '2018-05-07'),
(12, 'CAFE ĐEN NÓNG/ĐÁ', 1, 15000, '2018-05-08'),
(13, 'CAFE SỮA NÓNG/ĐÁ', 2, 40000, '2018-05-08'),
(14, 'SINH TỐ CÀ RỐT SỮA', 2, 44000, '2018-05-08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hangnhap`
--

CREATE TABLE `hangnhap` (
  `MaSoNhap` int(11) NOT NULL,
  `MaHang` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `TenHang` text COLLATE utf8_vietnamese_ci NOT NULL,
  `DVT` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `Gia` bigint(20) NOT NULL,
  `SL` float NOT NULL,
  `NgayNhap` date NOT NULL,
  `IDNV` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `hangnhap`
--

INSERT INTO `hangnhap` (`MaSoNhap`, `MaHang`, `TenHang`, `DVT`, `Gia`, `SL`, `NgayNhap`, `IDNV`) VALUES
(1, 'NN2', 'Dr.Thanh', 'Chai', 9000, 20, '2018-03-08', 'NV1'),
(2, 'CF1', 'Cà phê chồn', 'Kg', 200000, 2, '2018-03-14', 'NV1'),
(3, 'CF1', 'Cà phê chồn', 'Kg', 20000, 2, '2018-03-15', 'NV1'),
(4, 'CF1', 'Cà phê chồn', 'Kg', 200000, 2, '2018-03-08', 'NV1'),
(5, 'CF1', 'Cà phê chồn', 'Kg', 200000, 2, '2018-03-15', 'NV1'),
(6, 'CF2', 'Cà phê Trung Nguyên', 'Kg', 250000, 10, '2018-04-13', 'NV1'),
(7, 'NN2', 'Dr.Thanh', 'Chai', 12000, 10, '2018-04-15', 'NV1'),
(8, 'NN2', 'Dr.Thanh', 'Chai', 15000, 12, '2018-04-15', 'NV1'),
(16, 'CF1', 'Cà phê Chồn', 'Kg', 1, 1, '2018-04-14', 'NV1'),
(17, 'NN2', 'Dr.Thanh', 'Chai', 1, 1, '2018-04-08', 'NV1'),
(18, 'NN2', 'Dr.Thanh', 'Chai', 15000, 7, '2018-04-20', 'NV1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `SoHD` int(11) NOT NULL,
  `SoBan` int(11) NOT NULL,
  `ChiTiet` text COLLATE utf8_vietnamese_ci NOT NULL,
  `TongTien` bigint(20) NOT NULL,
  `NgayXuatHD` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `hoadon`
--

INSERT INTO `hoadon` (`SoHD`, `SoBan`, `ChiTiet`, `TongTien`, `NgayXuatHD`) VALUES
(1, 2, '{\"DSMenu\":[{\"TenSp\":\"CAFE MILANO 2\",\"SoLuong\":\"5\",\"ThanhTien\":\"85000\"},{\"TenSp\":\"DR. THANH\",\"SoLuong\":\"1\",\"ThanhTien\":\"12000\"},{\"TenSp\":\"CAPUCHINO\",\"SoLuong\":\"2\",\"ThanhTien\":\"50000\"},{\"TenSp\":\"CAFE MILANO 1\",\"SoLuong\":\"2\",\"ThanhTien\":\"30000\"}]}', 177000, '2018-05-04 00:00:00'),
(20, 6, '{\"DSMenu\":[{\"TenSp\":\"CAFE ĐEN NÓNG/ĐÁ\",\"SoLuong\":\"1\",\"ThanhTien\":\"15000\"},{\"TenSp\":\"PEPSI\",\"SoLuong\":\"2\",\"ThanhTien\":\"24000\"}]}', 39000, '2018-05-07 01:03:36'),
(21, 3, '{\"DSMenu\":[{\"TenSp\":\"SINH TỐ BƠ\",\"SoLuong\":\"1\",\"ThanhTien\":\"20000\"},{\"TenSp\":\"PEPSI\",\"SoLuong\":\"2\",\"ThanhTien\":\"24000\"}]}', 44000, '2018-05-07 01:08:29'),
(23, 1, '{\"DSMenu\":[{\"TenSp\":\"PEPSI\",\"SoLuong\":\"2\",\"ThanhTien\":\"24000\"}]}', 24000, '2018-05-07 01:14:01'),
(24, 4, '{\"DSMenu\":[{\"TenSp\":\"PEPSI\",\"SoLuong\":\"2\",\"ThanhTien\":\"24000\"},{\"TenSp\":\"CAPUCHINO\",\"SoLuong\":\"1\",\"ThanhTien\":\"25000\"}]}', 49000, '2018-05-07 01:16:03'),
(25, 1, '{\"DSMenu\":[{\"TenSp\":\"CAPUCHINO\",\"SoLuong\":\"2\",\"ThanhTien\":\"50000\"},{\"TenSp\":\"STING\",\"SoLuong\":\"1\",\"ThanhTien\":\"12000\"},{\"TenSp\":\"TRÀ ĐÀO\",\"SoLuong\":\"3\",\"ThanhTien\":\"45000\"}]}', 107000, '2018-05-07 01:19:09'),
(26, 9, '{\"DSMenu\":[{\"TenSp\":\"CAFE ĐEN NÓNG/ĐÁ\",\"SoLuong\":\"1\",\"ThanhTien\":\"15000\"},{\"TenSp\":\"CAFE SỮA NÓNG/ĐÁ\",\"SoLuong\":\"2\",\"ThanhTien\":\"40000\"},{\"TenSp\":\"SINH TỐ CÀ RỐT SỮA\",\"SoLuong\":\"2\",\"ThanhTien\":\"44000\"}]}', 99000, '2018-05-08 16:15:54');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `kho`
--

CREATE TABLE `kho` (
  `MaHang` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `Ten` text COLLATE utf8_vietnamese_ci NOT NULL,
  `DVT` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `SLT` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `kho`
--

INSERT INTO `kho` (`MaHang`, `Ten`, `DVT`, `SLT`) VALUES
('CF1', 'Cà phê Chồn', 'Kg', 12.9),
('CF2', 'Cà phê Trung Nguyên', 'Kg', 10),
('NN1', 'Number One', 'Chai', 30),
('NN2', 'Dr.Thanh', 'Chai', 49),
('TC1', 'CAM', 'Kg', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `ID` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `TenNV` varchar(50) COLLATE utf8_vietnamese_ci NOT NULL,
  `NgaySinh` date NOT NULL,
  `DiaChi` text COLLATE utf8_vietnamese_ci NOT NULL,
  `CMND` varchar(15) COLLATE utf8_vietnamese_ci NOT NULL,
  `Password` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`ID`, `TenNV`, `NgaySinh`, `DiaChi`, `CMND`, `Password`) VALUES
('NV1', 'Nguyễn Hoàng Nam', '1996-04-27', 'Quận 9', '215400990', 'namka');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ordersp`
--

CREATE TABLE `ordersp` (
  `id` int(11) NOT NULL,
  `idban` int(11) NOT NULL,
  `tensp` text COLLATE utf8_vietnamese_ci NOT NULL,
  `sl` int(11) NOT NULL,
  `thanhtien` bigint(20) NOT NULL,
  `trangthai` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `ordersp`
--

INSERT INTO `ordersp` (`id`, `idban`, `tensp`, `sl`, `thanhtien`, `trangthai`) VALUES
(3, 2, 'CAFE MILANO 2', 5, 85000, 1),
(5, 2, 'DR. THANH', 1, 12000, 1),
(6, 2, 'CAPUCHINO', 2, 50000, 1),
(7, 2, 'CAFE MILANO 1', 2, 30000, 1),
(8, 6, 'CAFE ĐEN NÓNG/ĐÁ', 1, 15000, 1),
(10, 3, 'SINH TỐ BƠ', 1, 20000, 1),
(11, 3, 'PEPSI', 2, 24000, 1),
(12, 6, 'PEPSI', 2, 24000, 1),
(13, 1, 'PEPSI', 2, 24000, 1),
(14, 4, 'PEPSI', 2, 24000, 1),
(15, 4, 'CAPUCHINO', 1, 25000, 1),
(16, 1, 'CAPUCHINO', 2, 50000, 1),
(17, 1, 'STING', 1, 12000, 1),
(18, 1, 'TRÀ ĐÀO', 3, 45000, 1),
(19, 9, 'CAFE ĐEN NÓNG/ĐÁ', 1, 15000, 1),
(20, 9, 'CAFE SỮA NÓNG/ĐÁ', 2, 40000, 1),
(21, 9, 'SINH TỐ CÀ RỐT SỮA', 2, 44000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `MaSP` varchar(20) COLLATE utf8_vietnamese_ci NOT NULL,
  `TenSp` text COLLATE utf8_vietnamese_ci NOT NULL,
  `GiaTien` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSp`, `GiaTien`) VALUES
('CF1', 'CAFE ĐEN NÓNG/ĐÁ', 15000),
('CF2', 'CAFE SỮA NÓNG/ĐÁ', 20000),
('CF3', 'CAPUCHINO', 25000),
('CF4', 'CAFE MILANO 1', 15000),
('CF5', 'CAFE MILANO 2', 17000),
('LT1', 'LIPTON NÓNG/ĐÁ', 20000),
('LT2', 'LIPTON MẬT ONG', 22000),
('LT3', 'LIPTON CAM SỮA', 22000),
('NN1', 'DR. THANH', 12000),
('NN3', 'PEPSI', 12000),
('NN4', 'STING', 12000),
('ST1', 'SINH TỐ CAM VẮT', 20000),
('ST2', 'SINH TỐ BƠ', 20000),
('ST3', 'SINH TỐ DÂU', 20000),
('ST4', 'SINH TỐ CÀ RỐT SỮA', 22000),
('TEA1', 'TRÀ ĐÀO', 15000),
('TEA2', 'TRÀ CHANH ĐÀO', 20000),
('TEA3', 'TRÀ TIM SEN MẬT ONG', 25000),
('TEA4', 'TRÀ HOA CÚC', 20000);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`IDBan`),
  ADD UNIQUE KEY `IDBan` (`IDBan`);

--
-- Chỉ mục cho bảng `datban`
--
ALTER TABLE `datban`
  ADD PRIMARY KEY (`SoBan`);

--
-- Chỉ mục cho bảng `doanhthu`
--
ALTER TABLE `doanhthu`
  ADD PRIMARY KEY (`STT`);

--
-- Chỉ mục cho bảng `hangnhap`
--
ALTER TABLE `hangnhap`
  ADD PRIMARY KEY (`MaSoNhap`),
  ADD KEY `IDNV` (`IDNV`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`SoHD`);

--
-- Chỉ mục cho bảng `kho`
--
ALTER TABLE `kho`
  ADD PRIMARY KEY (`MaHang`),
  ADD UNIQUE KEY `MaHang` (`MaHang`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `ID` (`ID`);

--
-- Chỉ mục cho bảng `ordersp`
--
ALTER TABLE `ordersp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idban` (`idban`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`),
  ADD UNIQUE KEY `MaSP` (`MaSP`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `doanhthu`
--
ALTER TABLE `doanhthu`
  MODIFY `STT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT cho bảng `hangnhap`
--
ALTER TABLE `hangnhap`
  MODIFY `MaSoNhap` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `SoHD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT cho bảng `ordersp`
--
ALTER TABLE `ordersp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `datban`
--
ALTER TABLE `datban`
  ADD CONSTRAINT `datban_ibfk_1` FOREIGN KEY (`SoBan`) REFERENCES `ban` (`IDBan`);

--
-- Các ràng buộc cho bảng `hangnhap`
--
ALTER TABLE `hangnhap`
  ADD CONSTRAINT `hangnhap_ibfk_1` FOREIGN KEY (`IDNV`) REFERENCES `nhanvien` (`ID`);

--
-- Các ràng buộc cho bảng `ordersp`
--
ALTER TABLE `ordersp`
  ADD CONSTRAINT `ordersp_ibfk_1` FOREIGN KEY (`idban`) REFERENCES `ban` (`IDBan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
