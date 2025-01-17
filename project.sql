-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2024 at 06:19 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_nama` varchar(100) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_nama`, `admin_username`, `admin_password`, `admin_foto`) VALUES
(1, 'M Akbar Firdaus', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1352025327_avatar.png');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `customer_nama` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_hp` varchar(20) NOT NULL,
  `customer_alamat` text NOT NULL,
  `customer_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `customer_nama`, `customer_email`, `customer_hp`, `customer_alamat`, `customer_password`) VALUES
(8, 'muhammad abay', 'Admin@gmail.com', '085894317397', 'Ciampea, Bogor', 'a2ddec5d2622130abdee490f032e3faf'),
(9, 'Akbar Firdaus, S.Kom', 'user@gmail.com', '08989898', 'Semeru, Bogor', 'a5a7158118e59ee590424b55bb9aed17'),
(10, 'Muhammad Akbar Firdaus', 'abayyy009@gmail.com', '08989898', 'Semeru, Bogor', 'b5b03f06271f8917685d14cea7c6c50a'),
(11, 'Akbar', 'akbar09@gmail.com', '08989757575', 'Ciampea, Bogor', 'a5a7158118e59ee590424b55bb9aed17');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(11) NOT NULL,
  `invoice_tanggal` date NOT NULL,
  `invoice_customer` int(11) NOT NULL,
  `invoice_nama` varchar(255) NOT NULL,
  `invoice_hp` varchar(255) NOT NULL,
  `invoice_alamat` text NOT NULL,
  `invoice_provinsi` varchar(255) NOT NULL,
  `invoice_kabupaten` varchar(255) NOT NULL,
  `invoice_kurir` varchar(255) NOT NULL,
  `invoice_berat` int(11) NOT NULL,
  `invoice_ongkir` int(11) NOT NULL,
  `invoice_total_bayar` int(11) NOT NULL,
  `invoice_status` int(11) NOT NULL,
  `invoice_resi` varchar(255) NOT NULL,
  `invoice_bukti` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `invoice_tanggal`, `invoice_customer`, `invoice_nama`, `invoice_hp`, `invoice_alamat`, `invoice_provinsi`, `invoice_kabupaten`, `invoice_kurir`, `invoice_berat`, `invoice_ongkir`, `invoice_total_bayar`, `invoice_status`, `invoice_resi`, `invoice_bukti`) VALUES
(15, '2024-07-01', 9, 'Akbar Firdaus, S.Kom', '08989898', 'fff', 'Jawa Barat', 'Bogor', 'JNE - OKE', 212, 9000, 24000, 0, '', '1406683995.png'),
(16, '2024-07-01', 9, 'Malik', '085780988413', 'DEPOOKKKKK', 'Jawa Barat', 'Depok', 'JNE - YES', 212, 18000, 33000, 0, '', '519922630.jpeg'),
(17, '2024-07-01', 10, 'Muhammad Akbar Firdaus', '08989898', 'bkjb', 'Jawa Barat', 'Bandung', 'JNE - REG', 20, 12000, 312000, 3, '', '120295959.jpg'),
(18, '2024-07-02', 11, 'Muhammad Akbar Firdaus', '08989898', 'ss', 'Kepulauan Riau', 'Lingga', 'JNE - REG', 100, 64000, 5064000, 3, '', '676343544.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produk_id` int(11) NOT NULL,
  `produk_nama` varchar(255) NOT NULL,
  `produk_harga` int(11) NOT NULL,
  `produk_keterangan` text NOT NULL,
  `produk_jumlah` int(11) NOT NULL,
  `produk_berat` int(11) NOT NULL,
  `produk_foto1` varchar(255) DEFAULT NULL,
  `produk_foto2` varchar(255) DEFAULT NULL,
  `produk_foto3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produk_id`, `produk_nama`, `produk_harga`, `produk_keterangan`, `produk_jumlah`, `produk_berat`, `produk_foto1`, `produk_foto2`, `produk_foto3`) VALUES
(14, 'THINKPAD LENOVO T460', 2000000, 'Prosesor: Intel Core generasi ke-6 (Skylake), seperti Core i5 atau Core i7.\r\n\r\nRAM: Biasanya dilengkapi dengan RAM DDR4 dengan pilihan kapasitas mulai dari 4GB hingga 16GB.\r\n\r\nPenyimpanan: SSD (Solid State Drive) dengan kapasitas mulai dari 128GB hingga 512GB. Beberapa model juga mungkin dilengkapi dengan HDD (Hard Disk Drive) untuk penyimpanan tambahan.\r\n\r\nLayar: Layar IPS berukuran 14 inci dengan resolusi HD (1366 x 768 piksel) atau resolusi Full HD (1920 x 1080 piksel).\r\n\r\nKartu Grafis: Biasanya menggunakan grafis terintegrasi Intel HD Graphics 520 atau 620.\r\n\r\nKonektivitas: Port USB (termasuk USB 3.0), HDMI, Mini DisplayPort, slot kartu SD, LAN, dan audio jack. Dilengkapi dengan konektivitas nirkabel seperti Wi-Fi dan Bluetooth.\r\n\r\nBaterai: Baterai lithium-ion dengan daya tahan yang cukup lama, tergantung pada konfigurasi dan penggunaan.\r\n\r\nSistem Operasi: Banyak model dilengkapi dengan sistem operasi Windows 10 Pro pre-installed, meskipun beberapa model mungkin menawarkan pilihan sistem operasi lain atau tanpa sistem operasi.\r\n\r\nDesain dan Fitur Tambahan: Desain khas ThinkPad dengan keyboard ergonomis dan tahan air, TrackPoint, dan tombol Fn yang dapat dikonfigurasi. Beberapa fitur tambahan termasuk teknologi keamanan seperti TPM (Trusted Platform Module) dan sensor sidik jari.', 10, 100, '391646208_390aa9bc-7a94-4a63-86d2-2a61ca807469.jpg', '391646208_3b88d21f-04fd-4cfe-a662-abaf60c38c5b.jpg', '391646208_ee4a6825-5849-496a-9012-4b3e887d9176.jpg'),
(15, 'Laptop Acer Travelmate', 4000000, 'Prosesor: Biasanya dilengkapi dengan prosesor Intel Core i5 atau i7 generasi terbaru, atau prosesor serupa dari AMD.\r\n\r\nRAM: Umumnya memiliki RAM DDR4 dengan kapasitas mulai dari 8GB hingga 16GB, tergantung pada model dan konfigurasi.\r\n\r\nPenyimpanan: SSD (Solid State Drive) dengan kapasitas mulai dari 256GB hingga 512GB untuk kecepatan dan kinerja yang lebih baik. Beberapa model juga mungkin menawarkan HDD (Hard Disk Drive) untuk penyimpanan tambahan.\r\n\r\nLayar: Layar IPS berukuran 14 inci hingga 15,6 inci dengan resolusi Full HD (1920 x 1080 piksel) atau resolusi lebih rendah tergantung pada modelnya.\r\n\r\nKartu Grafis: Biasanya menggunakan grafis terintegrasi dari Intel atau AMD, yang cukup untuk tugas-tugas produktivitas sehari-hari.\r\n\r\nKonektivitas: Port USB (termasuk USB 3.0 dan USB Type-C), HDMI, LAN, slot kartu SD, dan audio jack. Konektivitas nirkabel seperti Wi-Fi dan Bluetooth juga disertakan.\r\n\r\nBaterai: Baterai lithium-ion dengan daya tahan yang cukup lama, tergantung pada konfigurasi dan penggunaan.\r\n\r\nSistem Operasi: Banyak model dilengkapi dengan sistem operasi Windows 10 Pro pre-installed, meskipun beberapa model mungkin menawarkan pilihan sistem operasi lain.\r\n\r\nDesain dan Fitur Tambahan: Desain ringkas dan kokoh yang dirancang untuk mobilitas, serta fitur keamanan tambahan seperti TPM (Trusted Platform Module) dan sensor sidik jari. Beberapa model mungkin juga menawarkan fitur tambahan seperti kamera web HD dan teknologi audio yang ditingkatkan.', 12, 12, '968544160_9d259392-aa30-47ce-afb4-21492ce5a9e0.jpg', '968544160_195569df-1c3d-4df5-a7ee-3bb1501812ea.jpg', '968544160_5cf1c942-26eb-4646-a5a3-67abf1f6149f.jpg'),
(16, 'Laptop ASUS ROG GL552', 5000000, 'ASUS ROG GL552: Performa Gaming Tangguh dalam Desain yang Stylish\r\n\r\nLaptop ASUS ROG GL552 menggabungkan kekuatan dan keindahan dalam satu paket yang tangguh. Dirancang khusus untuk para gamer yang membutuhkan kinerja tinggi dan pengalaman gaming yang mendalam, GL552 menawarkan kombinasi yang kuat antara kecepatan, kenyamanan, dan keandalan.\r\n\r\nKinerja Terbaik di Kelasnya\r\n\r\nDitenagai oleh prosesor Intel Core generasi ke-4 atau ke-5, laptop ini menawarkan kinerja yang mengesankan untuk menangani tugas-tugas komputasi yang paling menuntut. Dukungan RAM DDR3 atau DDR4 hingga 16GB memastikan responsifitas yang cepat dan lancar saat menjalankan berbagai aplikasi dan game.\r\n\r\nGrafis Superior untuk Pengalaman Gaming Maksimal\r\n\r\nDilengkapi dengan kartu grafis NVIDIA GeForce GTX, seperti GTX 960M atau GTX 970M, GL552 memberikan visual yang luar biasa dan gameplay yang halus. Resolusi Full HD pada layar 15,6 inci memastikan detail yang tajam dan warna yang hidup untuk pengalaman gaming yang mendalam.\r\n\r\nPenyimpanan yang Cepat dan Luas\r\n\r\nPilihan antara HDD dengan kapasitas besar atau SSD untuk meningkatkan kinerja, laptop ini memungkinkan Anda untuk menyimpan dan mengakses file dengan cepat dan mudah. Anda memiliki fleksibilitas untuk memilih konfigurasi penyimpanan yang sesuai dengan kebutuhan Anda.\r\n\r\nDesain Ergonomis dan Fitur Khusus Gaming\r\n\r\nDesain stylish dengan lampu latar keyboard yang dapat disesuaikan memberikan sentuhan estetika yang menarik. Keyboard yang nyaman dengan tombol berukuran penuh dirancang khusus untuk gaming yang intens. Teknologi pendinginan yang efisien menjaga suhu tetap terkendali bahkan saat digunakan dalam sesi gaming yang panjang.\r\n\r\nKonektivitas yang Luas dan Sistem Operasi yang Handal\r\n\r\nPort USB 3.0, HDMI, LAN, dan jack audio memastikan konektivitas yang sempurna dengan perangkat lain. Sistem operasi Windows 10 pre-installed menyediakan platform yang kuat dan familiar untuk produktivitas dan hiburan.\r\n\r\nDengan kombinasi kinerja gaming yang tangguh, desain yang stylish, dan fitur khusus yang dirancang untuk para gamer, laptop ASUS ROG GL552 menjadi pilihan yang sempurna untuk pengalaman gaming yang tak tertandingi.', 10, 100, '1916680458_da8e4770-08c0-4788-8811-195ef24a1c35.jpg', '49624671_4d3486a2-b7f8-4a3c-ad42-e2db5b0ee093.jpg', '49624671_e4a89c1e-b0ce-46d2-b1f1-7582d13a9bc4.jpg'),
(17, 'Laptop ASUS', 1500000, 'Laptop Murah Meriah hehe', 10, 100, '1903911001_6e28c3ff-2978-458d-9911-c73054967cf7.jpg', '1903911001_21e4945d-9cd5-4bb7-ba05-0ba2824b2212.jpg', '1903911001_277b12cc-307d-4cd1-8581-b17e3ad13682.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(11) NOT NULL,
  `transaksi_invoice` int(11) NOT NULL,
  `transaksi_produk` int(11) NOT NULL,
  `transaksi_jumlah` int(11) NOT NULL,
  `transaksi_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_invoice`, `transaksi_produk`, `transaksi_jumlah`, `transaksi_harga`) VALUES
(1, 0, 3, 1, 120000),
(2, 0, 1, 1, 1234),
(3, 0, 3, 1, 120000),
(4, 0, 1, 1, 1234),
(5, 1, 3, 1, 120000),
(6, 1, 1, 1, 1234),
(9, 3, 3, 1, 120000),
(10, 4, 4, 1, 123000),
(22, 15, 14, 1, 15000),
(23, 16, 14, 1, 15000),
(24, 17, 16, 1, 300000),
(25, 18, 16, 1, 5000000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produk_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produk_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
