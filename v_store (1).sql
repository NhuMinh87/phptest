-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost:8889
-- Thời gian đã tạo: Th12 12, 2025 lúc 11:46 AM
-- Phiên bản máy phục vụ: 8.0.40
-- Phiên bản PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `v_store`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `item_sale`
--

CREATE TABLE `item_sale` (
  `id` int NOT NULL,
  `item_code` varchar(6) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `quantity` decimal(10,2) DEFAULT NULL,
  `expried_date` date DEFAULT NULL,
  `note` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Đang đổ dữ liệu cho bảng `item_sale`
--

INSERT INTO `item_sale` (`id`, `item_code`, `item_name`, `quantity`, `expried_date`, `note`) VALUES
(27, 'Coca', 'Coca cola', 100.00, '2024-01-01', NULL),
(28, 'Bim', 'Bim Bim', 100.00, '2024-01-01', 'Discount'),
(29, 'Lavie', 'Lavie', 100.00, '2024-01-01', 'Discount'),
(30, 'Pen', 'Pencil', 100.00, '2024-01-01', NULL),
(31, 'Seven', 'Seven up', 100.00, '2024-01-01', NULL),
(32, 'Note', 'NoteBook', 100.00, '2024-01-01', NULL),
(33, 'Notel', 'NoteBook 1', 100.00, '2024-01-01', 'Discount'),
(34, 'Note2', 'NoteBook 2', 100.00, '2024-01-01', 'Discount'),
(35, 'Note3', 'NoteBook 3', 100.00, '2024-01-01', 'Discount'),
(36, 'Note4', 'NoteBook 4', 100.00, '2024-01-01', 'Discount'),
(37, 'Note5', 'NoteBook 5', 100.00, '2024-01-01', 'Discount'),
(38, 'Note6', 'NoteBook 6', 100.00, '2024-01-01', 'Discount'),
(39, 'Note7', 'NoteBook 7 da sua', 100.00, '2024-01-01', 'Discount');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `item_sale`
--
ALTER TABLE `item_sale`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `item_sale`
--
ALTER TABLE `item_sale`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
