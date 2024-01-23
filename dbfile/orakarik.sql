-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2023 at 02:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orakarik`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `tanggal_pembuatan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id_customer`, `nama`, `email`, `username`, `password`, `tanggal_pembuatan`) VALUES
(1, 'Suranto', 'suranto@gmail.com', 'rantosur', 'suranto123', '2023-01-03'),
(2, 'Ahmad Suraji', 'suraji@gmail.com', 'matraji', 'suraji27', '2023-01-03'),
(3, 'Satrio Baskoro', 'satbaskoro@gmail.com', 'satriobsk', 'satb12k', '2023-01-04'),
(4, 'Widya Wardhani', 'widya@gmail.com', 'widyaw', 'w1Dy4W4r', '2023-01-04'),
(42, 'Wulan Sari', 'wulan@gmail.com', 'wulans', 'WuL4n5ar', '2023-01-05'),
(43, 'Surya Pratama', 'surya@gmail.com', 'suryap', '5uRy4pRa', '2023-01-05'),
(44, 'Budi Santoso', 'budi@gmail.com', 'budis', 'BuD1s4nT', '2023-01-05'),
(45, 'Kusuma Dewi', 'kusuma@gmail.com', 'kusumad', 'Ku5um4D3w', '2023-01-06'),
(46, 'Jaya Pranata', 'jaya@gmail.com', 'jayap', 'J4y4Pr4n', '2023-01-06'),
(47, 'Wijaya Nugraha', 'wijaya@gmail.com', 'wijayan', 'W1j4y4Nu', '2023-01-07'),
(48, 'Ardi Prasetyo', 'ardi@gmail.com', 'ardip', '4rd1Pr453', '2023-01-07'),
(49, 'Sinta Maharani', 'sinta@gmail.com', 'sintam', '515nt4M4h', '2023-01-07'),
(50, 'Bagus Wijaya', 'bagus@gmail.com', 'bagusw', 'B4gu5W1j', '2023-01-07'),
(51, 'Putra Utama', 'putra@gmail.com', 'putrau', 'Pu7r4Ut4m', '2023-01-08'),
(52, 'Ratna Indah', 'ratna@gmail.com', 'ratnai', 'R4tn41nd4', '2023-01-08'),
(53, 'Anugerah Purnama', 'anugerah@gmail.com', 'anugerahp', '4nug3r4hP', '2023-01-09'),
(54, 'Bayu Kusuma', 'bayu@gmail.com', 'bayuk', 'B4yuKu5um', '2023-01-09'),
(55, 'Candra Kirana', 'candra@gmail.com', 'candrak', 'C4ndr4K1r', '2023-01-11'),
(56, 'Rini Puspita', 'rini@gmail.com', 'rinip', 'R1n1Pu5p', '2023-01-11'),
(57, 'Adi Nugroho', 'adi@gmail.com', 'adin', '4d1Nu6r0', '2023-01-13'),
(58, 'Sari Wijaya', 'sari@gmail.com', 'sariw', '54r1W1j4y', '2023-01-14'),
(59, 'Prabu Aditya', 'prabu@gmail.com', 'prabua', 'Pr4bu4d1ty4', '2023-01-15');

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `id_diskon` int(10) NOT NULL,
  `kode_diskon` varchar(100) NOT NULL,
  `nama_diskon` varchar(100) NOT NULL,
  `total_diskon` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int(10) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `no_telepon` varchar(100) NOT NULL,
  `role` int(10) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama`, `email`, `password`, `no_telepon`, `role`) VALUES
(1, 'Yatno Suprapto', 'yatnoto@gmail.com', 'abc123', '081546209387', 2),
(2, 'Yani Sunarti', 'yanarti@gmail.com', 'pass123', '089243756104', 2),
(3, 'David Johnson ', 'dave.johnson@gmail.com ', 'test456 ', '082754918563', 1),
(4, 'Sarah Williams', 'sarah.williams@gmail.com', 'password123', '084635028972', 1),
(5, 'Michael Brown', 'michael.brown@gmail.com', 'securepass', '086921457306', 1),
(6, 'Emily Davis', 'emily.davis@gmail.com', 'abcxyz', '084362790185', 1),
(7, 'Daniel Miller', 'daniel.miller@gmail.com', 'qwerty123', '080673429158', 1),
(8, 'Olivia Wilson', 'olivia.wilson@gmail.com', 'p@ssw0rd', '087203658914', 1),
(9, 'Ethan Taylor', 'ethan.taylor@gmail.com', 'secretword', '085361497028', 1),
(10, 'Sophia Anderson', 'sophia.anderson@gmail.com', 'mypassword', '089207345816', 1),
(11, 'William Thompson', 'william.thompson@gmail.com', 'password123', '086329104578', 1),
(12, 'Emma Davis', 'emma.davis@gmail.com', 'test456', '082547103869', 1),
(13, 'James Wilson', 'james.wilson@gmail.com', 'abc123', '081596472083', 1),
(14, 'Oliver Brown', 'oliver.brown@gmail.com', 'securepass', '087310295846', 1),
(15, 'Ava Johnson', 'ava.johnson@gmail.com', 'pass123', '080925638471', 1),
(16, 'Mia Smith', 'mia.smith@gmail.com', 'qwerty123', '084621350987', 1),
(17, 'Alexander Davis', 'alexander.davis@gmail.com', 'abcxyz', '083450671982', 1),
(18, 'Charlotte Miller', 'charlotte.miller@gmail.com', 'mypassword', '086374529180', 1),
(19, 'Liam Wilson', 'liam.wilson@gmail.com', 'p@ssw0rd', '088297046513', 1),
(20, 'Sophia Thompson', 'sophia.thompson@gmail.com', 'secretword', '083492156807', 1),
(21, 'Aldi Taher', 'Altaher@gmail.com', 'alditaher21', '089898989', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kode_kategori` int(10) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kode_kategori`, `nama_kategori`) VALUES
(1, 'Makanan dan Minuman'),
(2, 'Obat dan Suplemen'),
(3, 'Mainan dan Hiburan'),
(4, 'Alat Tulis'),
(5, 'Kebutuhan Rumah Tangga'),
(6, 'Perlengkapan Bayi'),
(7, 'Rokok dan Tembakau'),
(8, 'Produk Kecantikan'),
(9, 'Perawatan Pribadi');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(10) NOT NULL,
  `id_customer` int(10) NOT NULL,
  `tanggal_pesanan` date NOT NULL,
  `total_tagihan` int(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_customer`, `tanggal_pesanan`, `total_tagihan`) VALUES
(1, 1, '2023-01-03', 53200),
(2, 2, '2023-01-03', 44800),
(3, 3, '2023-01-04', 19200),
(4, 4, '2023-01-04', 10000),
(5, 42, '2023-01-05', NULL),
(6, 43, '2023-01-05', NULL),
(7, 44, '2023-01-05', NULL),
(8, 44, '2023-01-05', NULL),
(9, 45, '2023-01-06', NULL),
(10, 46, '2023-01-06', NULL),
(11, 47, '2023-01-07', NULL),
(12, 45, '2023-01-07', 24000),
(13, 51, '2023-01-07', 43000),
(14, 4, '2023-01-08', 17500),
(15, 3, '2023-01-08', 35000),
(16, 57, '2023-01-08', 25800),
(17, 58, '2023-01-08', 44000);

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `kode_produk` int(10) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `gambar_produk` varchar(1000) DEFAULT NULL,
  `harga_produk` int(10) NOT NULL,
  `kategori_produk` int(10) DEFAULT NULL,
  `stok` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`kode_produk`, `nama_produk`, `gambar_produk`, `harga_produk`, `kategori_produk`, `stok`) VALUES
(1, 'Indomie Goreng Jumbo Ayam Panggang 127g', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//95/MTA-2492509/indomie_indomie-goreng-jumbo-ayam-panggang-127g_full02.jpg', 4800, 1, 100),
(2, 'Indomie Goreng 70g', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//97/MTA-59620416/indomie_indomie-goreng-70-g_full01.jpg', 3500, 1, 100),
(3, 'Indomie Ramen Miso', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//114/MTA-94882839/br-m036969-03789_indomie-japanese-miso-ramen_full01.jpg', 6000, 1, 45),
(4, 'Indomie Ramen Takoyaki', 'https://kliktobuy.com/wp-content/uploads/2023/03/indomie-ramen-goreng-takoyaki-20-gr_0089686040128.jpg', 6000, 1, 45),
(5, 'Indomie Ramen Shoyu', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//catalog-image/118/MTA-95799862/indomie_indomie-shoyu-ramen-82gr_full01.jpg', 6000, 1, 45),
(6, 'Pocari Sweat 350ml', 'https://drivethru.klikindomaret.com/twb5/wp-content/uploads/sites/31/2021/07/52faa42c2ed2858c5f869d0927ccf4b2.jpg', 5000, 1, 60),
(7, 'Teh Pucuk Harum 350ml', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//95/MTA-13577315/mayora_teh_pucuk_harum_350ml_full01_qis9icuo.jpg', 3500, 1, 60),
(8, 'Kahf Face Wash Oil and Acne Care', 'https://www.kahfeveryday.com/wp-content/uploads/2020/09/FW-OAC-Front-1.jpg', 35000, 9, 40),
(9, 'Panadol Regular 10 Kaplet', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//92/MTA-21079701/panadol_panadol_paracetamol-panadol_biru_full01_mk4sxr0k.jpg', 11900, 2, 40),
(10, 'Paramex 4 tablet', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/MTA-7797968/paramex_paramex-tablet-obat-sakit-kepala_full01.jpg', 3000, 2, 50),
(11, 'Imboost 4 tablet', 'https://d2qjkwm11akmwu.cloudfront.net/thumbnails/314406_10-6-2022_14-31-0-1665790564.png', 19500, 2, 12),
(12, 'Neozep Forte 4 tablet', 'https://id-test-11.slatic.net/p/7a623b901c09dc4b61037682ca67bf9c.jpg', 2900, 2, 50),
(13, 'Antimo 10 tablet', 'https://s3-publishing-cmn-svc-prd.s3.ap-southeast-1.amazonaws.com/drugs/ywnwIikE6ZmwPgQ7sLoEG/original/OBT0005356.jpg', 6000, 2, 50),
(14, 'Kenko Gunting SC-838N', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//81/MTA-1422107/kenko_gunting-kenko-sc-838n_full04.jpg', 15300, 4, 30),
(15, 'Kenko Ruler Penggaris 30cm', 'https://d1r7omh34z6onh.cloudfront.net/gk/production/e57632364649462c923a9314d9218e82.jpeg', 4900, 4, 35),
(16, 'Snowman Spidol Permanen Hitam', 'https://apis.unair.ac.id/lpse/storage/amel/penyedia/scan-gallery-509690341677907706.jpg', 12900, 4, 40),
(17, 'Pilot Pulpen BPT-P Hitam 2pcs', 'https://images.tokopedia.net/img/cache/700/hDjmkQ/2022/3/3/a48b855b-1a6e-4778-8727-a095f283c39f.jpg', 8700, 4, 50),
(18, 'Faber Castell Oil Pastels 12 warna', 'https://faber-castell.co.id/cfind/source/images/product/pl/700x700-pl/120063on.jpg', 32500, 4, 20),
(19, 'Kenko Cutter L-500 Blister', 'https://images.tokopedia.net/img/cache/700/VqbcmM/2022/6/25/cf827c2d-bf65-4c6a-868d-cbbf0ba1c909.jpg.webp', 29900, 4, 20),
(20, 'Gudang Garam Surya Rokok 16 Batang', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//88/MTA-8153332/gudang_garam_rokok_gudang_garam_surya_16_batang_-10_bungkus-_full01_dczofd3o.jpg', 34000, 7, 30),
(21, 'Clas Mild Rokok 16 Batang', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//104/MTA-29724719/clas_mild_rokok_clas_mild_16_full01_os9su225.jpg', 28200, 7, 35),
(22, 'Dji Sam Soe Magnum Filter Black 12 Batang', 'https://www.mentimun.co.id/images/store/LGDJI_SAM_SOE_MAGNUM_FILTER_12.jpg', 23500, 7, 30),
(23, 'Djarum LA Bold 12 Batang', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//catalog-image/85/MTA-110745001/no-brand_djarum-la-bold-12s_full01-fd401744.jpg', 21500, 7, 40),
(24, 'Esse Change Double 20 Batang', 'https://kpri.princetech.id/web/image/product.template/16741/image_1024?unique=a19b1b4', 39000, 7, 25),
(25, 'Evangeline EDC Bloom Coco 100ml', 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcRFY2Bc8QFOZ94CtktXIfrBHQK7Gj4_w46KZ-fidpNRJgyQ06z2', 22000, 8, 20),
(26, 'Glow & Lovely Powder Cream 40gr', 'https://cf.shopee.co.id/file/83f9e242cb8a3f964d5a1f1d11758b62', 46900, 8, 25),
(27, 'Nivea MicellAir Oil & Acne Care 125ml, Micellar Water', 'https://cf.shopee.co.id/file/84f7b1e0dc2b0e833adb507c2ce71dca', 18500, 8, 20);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(10) NOT NULL,
  `nama_role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `nama_role`) VALUES
(1, 'Karyawan'),
(2, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `status_pembayaran`
--

CREATE TABLE `status_pembayaran` (
  `id_pembayaran` int(10) NOT NULL,
  `nama_status` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(10) NOT NULL,
  `id_pesanan` int(10) DEFAULT NULL,
  `id_pegawai` int(10) NOT NULL,
  `id_customer` int(10) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `id_barang` int(10) DEFAULT NULL,
  `jumlah_barang` int(10) NOT NULL,
  `total_tagihan` int(10) NOT NULL,
  `id_diskon` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pesanan`, `id_pegawai`, `id_customer`, `tanggal_transaksi`, `id_barang`, `jumlah_barang`, `total_tagihan`, `id_diskon`) VALUES
(1, 1, 7, 1, '2023-01-03', 1, 4, 19200, NULL),
(2, 1, 7, 1, '2023-01-03', 20, 1, 34000, NULL),
(3, 2, 9, 2, '2023-01-03', 12, 2, 5800, NULL),
(4, 2, 9, 2, '2023-01-03', 11, 2, 39000, NULL),
(5, 3, 19, 3, '2023-01-04', 2, 4, 19200, NULL),
(6, 4, 14, 4, '2023-01-04', 6, 2, 10000, NULL),
(11, NULL, 6, 46, '2023-01-05', 8, 2, 70000, NULL),
(12, NULL, 7, 51, '2023-01-06', 2, 3, 10500, NULL),
(13, NULL, 7, 53, '2023-01-06', 5, 2, 12000, NULL),
(14, NULL, 7, 48, '2023-01-07', 18, 1, 3250, NULL),
(16, NULL, 6, 59, '2023-01-08', 4, 4, 24000, NULL),
(18, NULL, 18, 56, '2023-01-10', 26, 1, 46900, NULL),
(19, NULL, 2, 52, '2023-01-11', 12, 3, 8700, NULL),
(20, NULL, 7, 57, '2023-01-12', 23, 3, 53200, NULL),
(21, NULL, 7, 46, '2023-01-13', 8, 1, 35000, NULL),
(22, NULL, 15, 44, '2023-01-14', 1, 7, 33600, NULL),
(23, NULL, 15, 55, '2023-01-15', 15, 2, 9800, NULL),
(24, NULL, 7, 45, '2023-01-16', 3, 10, 60000, NULL),
(25, NULL, 10, 1, '2023-01-17', 7, 5, 17500, NULL),
(26, NULL, 3, 54, '2023-01-18', 9, 3, 35700, NULL),
(27, NULL, 4, 53, '2023-01-19', 10, 2, 6000, NULL),
(28, NULL, 7, 56, '2023-01-20', 13, 1, 6000, NULL),
(29, NULL, 7, 56, '2023-01-21', 14, 1, 15300, NULL),
(30, NULL, 19, 51, '2023-01-22', 16, 3, 38700, NULL),
(31, NULL, 18, 58, '2023-01-23', 19, 2, 59800, NULL),
(38, NULL, 19, 45, '2023-01-23', 26, 1, 46900, NULL),
(39, NULL, 11, 52, '2023-01-24', 6, 2, 10000, NULL),
(40, NULL, 13, 52, '2023-01-26', 12, 2, 5800, NULL),
(41, NULL, 15, 59, '2023-01-27', 15, 1, 4900, NULL),
(42, NULL, 16, 45, '2023-01-28', 26, 1, 46900, NULL),
(43, NULL, 12, 44, '2023-01-29', 22, 1, 23500, NULL),
(44, NULL, 14, 45, '2023-02-01', 3, 3, 18000, NULL),
(45, NULL, 18, 49, '2023-02-02', 16, 1, 12900, NULL),
(46, NULL, 15, 47, '2023-02-03', 18, 1, 32500, NULL),
(47, NULL, 7, 55, '2023-02-04', 24, 1, 39000, NULL),
(48, NULL, 11, 46, '2023-02-05', 11, 1, 19500, NULL),
(49, NULL, 4, 56, '2023-02-06', 10, 2, 6000, NULL),
(50, NULL, 13, 45, '2023-02-07', 6, 2, 10000, NULL),
(51, NULL, 10, 54, '2023-02-08', 19, 1, 29900, NULL),
(52, NULL, 9, 1, '2023-02-09', 5, 1, 6000, NULL),
(53, NULL, 3, 52, '2023-02-10', 27, 1, 18500, NULL),
(54, NULL, 11, 49, '2023-02-11', 4, 1, 6000, NULL),
(55, NULL, 4, 53, '2023-02-12', 8, 1, 35000, NULL),
(56, NULL, 14, 3, '2023-02-13', 2, 2, 7000, NULL),
(57, NULL, 12, 1, '2023-02-13', 24, 1, 39000, NULL),
(58, NULL, 5, 54, '2023-02-14', 14, 3, 15300, NULL),
(59, NULL, 20, 48, '2023-02-15', 11, 1, 19500, NULL),
(60, NULL, 9, 3, '2023-02-16', 9, 2, 23800, NULL),
(61, NULL, 17, 57, '2023-02-17', 12, 2, 5800, NULL),
(62, NULL, 11, 51, '2023-02-18', 4, 2, 12000, NULL),
(63, NULL, 10, 43, '2023-02-19', 14, 1, 15300, NULL),
(64, NULL, 20, 51, '2023-02-20', 4, 3, 18000, NULL),
(65, NULL, 19, 43, '2023-02-21', 8, 1, 35000, NULL),
(66, NULL, 3, 43, '2023-02-22', 19, 1, 29900, NULL),
(67, NULL, 14, 58, '2023-02-23', 27, 1, 18500, NULL),
(68, NULL, 5, 56, '2023-02-24', 2, 2, 7000, NULL),
(69, NULL, 7, 1, '2023-02-25', 20, 2, 68000, NULL),
(70, NULL, 12, 55, '2023-02-26', 3, 1, 6000, NULL),
(71, NULL, 8, 51, '2023-02-27', 23, 1, 21500, NULL),
(72, NULL, 11, 3, '2023-02-28', 23, 1, 21500, NULL),
(73, NULL, 15, 53, '2023-03-01', 7, 3, 10500, NULL),
(74, NULL, 20, 53, '2023-03-02', 20, 1, 34000, NULL),
(75, NULL, 16, 49, '2023-03-03', 25, 1, 22000, NULL),
(76, NULL, 20, 51, '2023-03-04', 5, 1, 6000, NULL),
(77, NULL, 8, 2, '2023-03-04', 1, 2, 9600, NULL),
(78, NULL, 8, 49, '2023-03-05', 26, 1, 46900, NULL),
(79, NULL, 20, 47, '2023-03-06', 8, 1, 35000, NULL),
(80, NULL, 10, 58, '2023-03-07', 14, 1, 15300, NULL),
(81, NULL, 10, 48, '2023-03-08', 21, 1, 28200, NULL),
(82, NULL, 15, 3, '2023-03-09', 20, 1, 34000, NULL),
(83, NULL, 11, 44, '2023-03-10', 1, 3, 14400, NULL),
(84, NULL, 17, 1, '2023-03-11', 11, 1, 19500, NULL),
(85, NULL, 18, 49, '2023-03-12', 2, 1, 3500, NULL),
(86, NULL, 14, 4, '2023-03-13', 6, 2, 10000, NULL),
(87, NULL, 21, 2, '2023-03-14', 24, 1, 39000, NULL),
(89, NULL, 4, 3, '2023-03-20', 3, 1, 6000, NULL),
(91, NULL, 3, 3, '2023-03-24', 3, 2, 7000, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`id_diskon`),
  ADD UNIQUE KEY `kode_diskon` (`kode_diskon`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`),
  ADD KEY `karyawan_id_role-role_id` (`role`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kode_kategori`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `customer_id_customer` (`id_customer`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`kode_produk`),
  ADD KEY `produk_kategori_id_kategori` (`kategori_produk`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `status_pembayaran`
--
ALTER TABLE `status_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_barang_kode_produk` (`id_barang`),
  ADD KEY `id_pegawai_id_karyawan` (`id_pegawai`),
  ADD KEY `diskon_id_diskon` (`id_diskon`),
  ADD KEY `id_customer_id_customer` (`id_customer`),
  ADD KEY `id_pesanan_id_pesanan` (`id_pesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `id_diskon` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kode_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `kode_produk` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD CONSTRAINT `karyawan_id_role-role_id` FOREIGN KEY (`role`) REFERENCES `role` (`id_role`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `customer_id_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_kategori_id_kategori` FOREIGN KEY (`kategori_produk`) REFERENCES `kategori` (`kode_kategori`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `diskon_id_diskon` FOREIGN KEY (`id_diskon`) REFERENCES `diskon` (`id_diskon`),
  ADD CONSTRAINT `id_barang_kode_produk` FOREIGN KEY (`id_barang`) REFERENCES `produk` (`kode_produk`),
  ADD CONSTRAINT `id_customer_id_customer` FOREIGN KEY (`id_customer`) REFERENCES `customer` (`id_customer`),
  ADD CONSTRAINT `id_pegawai_id_karyawan` FOREIGN KEY (`id_pegawai`) REFERENCES `karyawan` (`id_karyawan`),
  ADD CONSTRAINT `id_pesanan_id_pesanan` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
