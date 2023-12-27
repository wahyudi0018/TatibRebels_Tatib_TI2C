-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2023 at 07:08 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tatib`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nid` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jk` enum('Laki-Laki','Perempuan') NOT NULL,
  `tgl_lahir` varchar(255) NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nid`, `nama`, `jk`, `tgl_lahir`, `no_hp`, `email`, `password`, `salt`) VALUES
(1, '001', 'Arin Niedermann', 'Perempuan', '1010-10-10', '080000000000', '001@gmail.com', '$2y$10$2d16e387d10d3719c571674bf2c73a2cb7f15f98caac532b94f0b2f7dfb1083a', '2d16e387d10d3719c571674bf2c73a2c');

--
-- Triggers `admin`
--
DELIMITER $$
CREATE TRIGGER `set_admin` BEFORE INSERT ON `admin` FOR EACH ROW BEGIN
    -- Generate unique salt for each admin
    SET NEW.salt = SUBSTRING(MD5(RAND()), 1, 32);

    -- Encrypt password using bcrypt with generated salt
    SET NEW.password = CONCAT('$2y$10$', NEW.salt, MD5(CONCAT(NEW.nid, NEW.salt)));

    -- Insert into user table
    INSERT INTO user (username, password, salt, level) VALUES (NEW.nid, NEW.password, NEW.salt, 'admin');
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `nip` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jurusan` varchar(255) DEFAULT 'Teknologi Informasi',
  `prodi` varchar(255) DEFAULT 'D4 Teknik Informatika',
  `tgl_lahir` varchar(255) NOT NULL,
  `jk` enum('Laki-Laki','Perempuan') NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `tanda` enum('simpan','hapus') DEFAULT 'simpan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `nip`, `nama`, `jurusan`, `prodi`, `tgl_lahir`, `jk`, `no_hp`, `email`, `password`, `salt`, `tanda`) VALUES
(1, '0023089102', 'Muhammad Unggul Pamenang', 'Teknologi Informasi', 'D4 Teknik Informatika', '1994-11-01', 'Laki-Laki', '085854855100', 'unggul@polinema.ac.id', '$2y$10$ded30ab51fabb05ade5145dbbf4d8964bcb13ac465d2956ac9ee9e6e36f86618', 'ded30ab51fabb05ade5145dbbf4d8964', 'simpan'),
(2, '0716037502', 'Dodit Suprianto', 'Teknologi Informasi', 'D4 Teknik Informatika', '1994-11-02', 'Laki-Laki', '085731311476', 'dodit@polinema.ac.id', '$2y$10$d97c93e3a76006d5cc206adf9852a9caa17492583ff6743cdbb2f3f0f4b3f91c', 'd97c93e3a76006d5cc206adf9852a9ca', 'simpan'),
(3, '0031019404', 'Endah Septa Sintiya', 'Teknologi Informasi', 'D4 Teknik Informatika', '1994-11-03', 'Perempuan', '081234567890', 'e.septa@polinema.ac.id', '$2y$10$748edc29008983d4512bc92557c5906e2664fac083f48c00a4348de20b5db7e0', '748edc29008983d4512bc92557c5906e', 'simpan'),
(4, '0005078102', 'Ahmadi Yuli Ananta', 'Teknologi Informasi', 'D4 Teknik Informatika', '1994-11-04', 'Laki-Laki', '081357924680', 'ahmadi@polinema.ac.id', '$2y$10$016768fc50d39cc88742d73c52ff11005b5a468b213d67819bbe8d62f21d3ac6', '016768fc50d39cc88742d73c52ff1100', 'simpan'),
(5, '0017129402', 'Candra Bella Vista', 'Teknologi Informasi', 'D4 Teknik Informatika', '1994-11-05', 'Perempuan', '082468135790', 'bellavista@polinema.ac.id', '$2y$10$0b739f70dd0313c7f2c86567692a33b0391be7d738a21d1f39a2aec8a07e7193', '0b739f70dd0313c7f2c86567692a33b0', 'simpan'),
(6, '19560701', 'Najwa Azzahra', 'Teknologi Informasi', 'D4 Teknik Informatika', '2023-12-27', 'Perempuan', '198710', 'najwa0101@gmail.com', '$2y$10$06f33da327fc28ef01a732588444d6fb66528334b927db3a70c410851b232cf4', '06f33da327fc28ef01a732588444d6fb', 'simpan');

--
-- Triggers `dosen`
--
DELIMITER $$
CREATE TRIGGER `set_dosen` BEFORE INSERT ON `dosen` FOR EACH ROW BEGIN
    -- Generate unique salt for each dosen
    SET NEW.salt = SUBSTRING(MD5(RAND()), 1, 32);

    -- Encrypt password using bcrypt with generated salt
    SET NEW.password = CONCAT('$2y$10$', NEW.salt, MD5(CONCAT(NEW.nip, NEW.salt)));

    -- Insert into user table
    INSERT INTO user (username, password, salt, level) VALUES (NEW.nip, NEW.password, NEW.salt, 'dosen');

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_tanda_dosen` AFTER UPDATE ON `dosen` FOR EACH ROW BEGIN
    IF NEW.tanda = 'hapus' THEN
        UPDATE user
        SET tanda = 'hapus'
        WHERE username = NEW.nip;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `mhs`
--

CREATE TABLE `mhs` (
  `id` int(11) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `jurusan` varchar(255) DEFAULT 'Teknologi Informasi',
  `prodi` varchar(255) DEFAULT 'D4 Teknik Informatika',
  `tgl_lahir` varchar(255) NOT NULL,
  `jk` enum('Laki-Laki','Perempuan') NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `tanda` enum('simpan','hapus') DEFAULT 'simpan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mhs`
--

INSERT INTO `mhs` (`id`, `nim`, `nama`, `jurusan`, `prodi`, `tgl_lahir`, `jk`, `no_hp`, `email`, `password`, `salt`, `tanda`) VALUES
(1, '2241720024', 'Alifia Bilqi Firajulkha', 'Teknologi Informasi', 'D4 Teknik Informatika', '2004-12-01', 'Perempuan', '085335782864', 'alibilajulkha24@gmail.com', '$2y$10$b17ab033ccce3e3830cb79fbb10d00f585b71f67e8892122f64ca22ec5721eb2', 'b17ab033ccce3e3830cb79fbb10d00f5', 'simpan'),
(2, '2241720233', 'Irsyad Danisaputra', 'Teknologi Informasi', 'D4 Teknik Informatika', '2004-12-02', 'Laki-Laki', '085156281639', 'irsyadani33@gmail.com', '$2y$10$233b4cfe924148c5209bbd665a5f4a4bb5e884f46f8c750e27e5e5953cd2cb39', '233b4cfe924148c5209bbd665a5f4a4b', 'simpan'),
(3, '2241720151', 'Mochamad Imam Hanafi', 'Teknologi Informasi', 'D4 Teknik Informatika', '2004-12-03', 'Laki-Laki', '081249217968', 'hapeoppojoy3@gmail.com', '$2y$10$6b6fd4ac56f00f892ff23e0ff785ecc637dc00a321f68e7c710563c631ba534f', '6b6fd4ac56f00f892ff23e0ff785ecc6', 'simpan'),
(4, '2241720012', 'Tyase Nisa`an Jamilaa', 'Teknologi Informasi', 'D4 Teknik Informatika', '2004-12-04', 'Perempuan', '081230875757', 'tyanilaa12@gmail.com', '$2y$10$30d8ee69bb9f97a513e1a944be084bbe1cb4952f63e769bf2d2732abef365f07', '30d8ee69bb9f97a513e1a944be084bbe', 'simpan'),
(5, '2241720018', 'Wahyudi', 'Teknologi Informasi', 'D4 Teknik Informatika', '2004-12-05', 'Laki-Laki', '0895342748070', 'wahyudi0018@gmail.com', '$2y$10$ad3af6c621adceb58cb6326b748fc6ae7de98a20446dd8af727d82658c5bd700', 'ad3af6c621adceb58cb6326b748fc6ae', 'simpan');

--
-- Triggers `mhs`
--
DELIMITER $$
CREATE TRIGGER `set_mahasiswa` BEFORE INSERT ON `mhs` FOR EACH ROW BEGIN
    -- Generate unique salt for each mahasiswa
    SET NEW.salt = SUBSTRING(MD5(RAND()), 1, 32);

    -- Encrypt password using bcrypt with generated salt
    SET NEW.password = CONCAT('$2y$10$', NEW.salt, MD5(CONCAT(NEW.nim, NEW.salt)));

    -- Insert into user table
    INSERT INTO user (username, password, salt, level) VALUES (NEW.nim, NEW.password, NEW.salt, 'mahasiswa');

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_tanda_mhs` AFTER UPDATE ON `mhs` FOR EACH ROW BEGIN
    IF NEW.tanda = 'hapus' THEN
        UPDATE user
        SET tanda = 'hapus'
        WHERE username = NEW.nim;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggaran`
--

CREATE TABLE `pelanggaran` (
  `id` int(11) NOT NULL,
  `id_tingkat` int(11) NOT NULL,
  `id_sanksi` int(11) NOT NULL,
  `no_urut` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `tanda` enum('simpan','hapus') DEFAULT 'simpan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggaran`
--

INSERT INTO `pelanggaran` (`id`, `id_tingkat`, `id_sanksi`, `no_urut`, `deskripsi`, `tanda`) VALUES
(1, 1, 1, 1, 'Berkomunikasi dengan tidak sopan, baik tertulis atau tidak tertulis kepada mahasiswa, dosen, karyawan, atau orang lain.', 'simpan'),
(2, 2, 2, 2, 'Berbusana tidak sopan dan tidak rapi. Yaitu antara lain adalah berpakaian ketat, transparan, memakai t-shirt (baju kaos tidak berkerah), tank top, hipster, you can see, rok mini, backless, celana pendek, celana tiga per empat, legging, model celana atau baju koyak, sandal, sepatu sandal di lingkungan kampus.', 'simpan'),
(3, 2, 2, 3, 'Mahasiswa Iaki-laki berambut tidak rapi, gondrong yaitu panjang rambutnya melewati batas alis mata di bagian depan, telinga dibagian samping atau menyentuh kerah baju di bagian leher.', 'simpan'),
(4, 2, 2, 4, 'Mahasiswa berambut dengan model punk, dicat selain hitam dan / atau skinned.', 'simpan'),
(5, 2, 2, 5, 'Makan, atau minum di dalam ruang kuliah / laboratorium / bengkel.', 'simpan'),
(6, 3, 3, 6, 'Melanggar peraturan / ketentuan yang berlaku di Polinema baik di Jurusan / Program Studi.', 'simpan'),
(7, 3, 3, 7, 'Tidak menjaga kebersihan di seluruh area Polinema.', 'simpan'),
(8, 3, 3, 8, 'Membuat kegaduhan yang mengganggu pelaksanaan perkuliahanatau praktikum yang sedang berlangsung.', 'simpan'),
(9, 3, 3, 9, 'Merokok di luar area kawasan merokok.', 'simpan'),
(10, 3, 3, 10, 'Bermain kartu, game online di area kampus.', 'simpan'),
(11, 3, 3, 11, 'Mengotori atau mencoret-coret meja, kursi, tembok, dan lain-lain di lingkungan Polinema.', 'simpan'),
(12, 3, 3, 12, 'Bertingkah laku kasar atau tidak sopan kepada mahasiswa, dosen, dan / atau karyawan.', 'simpan'),
(13, 4, 4, 13, 'Merusak sarana dan prasarana yang ada di area Polinema.', 'simpan'),
(14, 4, 4, 14, 'Tidak menjaga ketertiban dan keamanan di seluruh area Polinema (misalnya, parkir tidak pada tempatnya, konvoi selebrasi wisuda dll).', 'simpan'),
(15, 4, 4, 15, 'Melakukan pengotoran/ pengrusakan barang milik orang lain termasuk milik Politeknik Negeri Malang', 'simpan'),
(16, 4, 4, 16, 'Mengakses materi pornografi di kelas atau area kampus.', 'simpan'),
(17, 4, 4, 17, 'Membawa dan / atau menggunakan senjata tajam dan / atau senjata api untuk hal kriminal.', 'simpan'),
(18, 4, 4, 18, 'Melakukan perkelahian, serta membentuk geng / kelompok yang bertujuan negatif.', 'simpan'),
(19, 4, 4, 19, 'Melakukan kegiatan politik praktis di dalam kampus.', 'simpan'),
(20, 4, 4, 20, 'Melakukan tindakan kekerasan atau perkelahian di dalam kampus.', 'simpan'),
(21, 4, 4, 21, 'Melakukan penyalahgunaan identitas untuk perbuatan negatif.', 'simpan'),
(22, 4, 4, 22, 'Mengancam, baik tertulis atau tidak tertulis kepada mahasiswa,dosen, dan/atau karyawan.', 'simpan'),
(23, 4, 4, 23, 'Mencuri dalam bentuk apapun.', 'simpan'),
(24, 4, 4, 24, 'Melakukan kecurangan dalam bidang akademik, administratif, dan keuangan.', 'simpan'),
(25, 4, 4, 25, 'Melakukan pemerasan dan / atau penipuan.', 'simpan'),
(26, 5, 5, 26, 'Melakukan pelecehan dan / atau tindakan asusila dalam segala bentuk di dalam dan di luar kampus.', 'simpan'),
(27, 5, 5, 27, 'Berjudi, mengkonsumsi minum-minuman keras, dan/ atau bermabuk-mabukan di lingkungan dan di luar lingkungan Kampus Polinema.', 'simpan'),
(28, 5, 5, 28, 'Mengikuti organisasi dan atau menyebarkan faham-faham yang dilarang oleh Pemerintah.', 'simpan'),
(29, 5, 5, 29, 'Melakukan pemalsuan data / dokumen / tanda tangan.', 'simpan'),
(30, 5, 5, 30, 'Melakukan plagiasi (copy paste) dalam tugas-tugas atau karya ilmiah.', 'simpan'),
(31, 5, 5, 31, 'Tidak menjaga nama baik Polinema di masyarakat dan / atau mencemarkan nama baik Polinema melalui media apapun.', 'simpan'),
(32, 5, 5, 32, 'Melakukan kegiatan atau sejenisnya yang dapat menurunkan kehormatan atau martabat Negara, Bangsa dan Polinema.', 'simpan'),
(33, 5, 5, 33, 'Menggunakan barang-barang psikotropika dan / atau zat-zat Adiktif lainnya.', 'simpan'),
(34, 5, 5, 34, 'Mengedarkan serta menjual barang-barang psikotropika dan/ atau zat-zat Adiktif lainnya.', 'simpan'),
(35, 5, 5, 35, 'Terlibat dalam tindakan kriminal dan dinyatakan bersalah oleh Pengadilan.', 'simpan'),
(36, 4, 4, 36, 'merusak sarana', 'simpan');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pelanggaran`
--

CREATE TABLE `riwayat_pelanggaran` (
  `id` int(11) NOT NULL,
  `id_mhs` int(11) NOT NULL,
  `id_dosen` int(11) NOT NULL,
  `id_pelanggaran` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam` time NOT NULL,
  `status` enum('Baru','Verifikasi','Dikerjakan','Selesai') DEFAULT 'Baru',
  `bukti_pelanggaran` text DEFAULT NULL,
  `banding` text DEFAULT NULL,
  `bukti_banding` text DEFAULT NULL,
  `kumpul_sanksi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `riwayat_pelanggaran`
--

INSERT INTO `riwayat_pelanggaran` (`id`, `id_mhs`, `id_dosen`, `id_pelanggaran`, `tanggal`, `jam`, `status`, `bukti_pelanggaran`, `banding`, `bukti_banding`, `kumpul_sanksi`) VALUES
(1, 2, 1, 1, '2023-12-27', '08:49:11', 'Baru', 'bukti1.jpg', NULL, NULL, NULL),
(2, 2, 1, 2, '2023-12-27', '08:49:11', 'Verifikasi', 'bukti2.jpg', 'bersalah', 'banding2.jpeg', NULL),
(3, 2, 1, 3, '2023-12-27', '08:49:11', 'Dikerjakan', 'bukti3.jpeg', 'bersalah', 'banding3.jpeg', NULL),
(4, 2, 1, 4, '2023-12-27', '08:49:11', 'Selesai', 'bukti4.jpeg', 'bersalah', 'banding4.jpg', '1.pdf'),
(6, 2, 1, 3, '2023-12-27', '12:11:00', 'Selesai', 'BuktiRambut.png', NULL, NULL, 'PengerjaanSanksiRambut.pdf'),
(7, 2, 1, 13, '2023-12-27', '12:14:00', 'Selesai', 'BuktiPerusakan1.jpg', 'Gambar tersebut bukanlah saya, pada jam tersebut saya tidak ada jam mata kuliah. Untuk bukti lanjut saya cantumkan jadwal perkuliahan pada hari tersebut.', 'BandingPerusakan1.png', NULL),
(8, 2, 1, 13, '2023-12-27', '12:18:00', 'Selesai', 'BuktiPerusakan2.jpg', 'Gambar tersebut bukanlah saya, pada jam tersebut saya sedang tidak berada di kampus.', 'BandingPerusakan2.jpg', 'PengerjaanSanksi1.jpg');

--
-- Triggers `riwayat_pelanggaran`
--
DELIMITER $$
CREATE TRIGGER `update_riwayat_pelanggaran` BEFORE UPDATE ON `riwayat_pelanggaran` FOR EACH ROW BEGIN
    IF NEW.status = 'Baru' THEN
        SET NEW.banding = NULL;
        SET NEW.bukti_banding = NULL;
        SET NEW.kumpul_sanksi = NULL;
    ELSEIF NEW.status IN ('Verifikasi', 'Dikerjakan') THEN
        SET NEW.kumpul_sanksi = NULL;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `sanksi`
--

CREATE TABLE `sanksi` (
  `id` int(11) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanksi`
--

INSERT INTO `sanksi` (`id`, `deskripsi`) VALUES
(1, 'Teguran lisan disertai dengan surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, ditandatangani mahasiswa yang bersangkutan dan DPA.'),
(2, 'Teguran tertulis disertai dengan surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, ditandatangani mahasiswa yang bersangkutan dan DPA.'),
(3, 'Membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, ditandatangani mahasiswa yang bersangkutan dan DPA dan Melakukan tugas khusus, misalnya bertanggung jawab untuk memperbaiki atau membersihkan kembali, dan tugas - tugas lainnya.'),
(4, 'Dikenakan penggantian kerugian atau penggantian benda / barang semacamnya dan / atau melakukan tugas layanan sosial dalam jangka waktu tertentu dan / atau diberikan nilai D pada mata kuliah terkait saat melakukan pelanggaran.'),
(5, 'Dinonaktifkan (Cuti Akademik / Terminal) selama dua semester dan / atau diberhentikan sebagai mahasiswa.');

-- --------------------------------------------------------

--
-- Table structure for table `tingkat_pelanggaran`
--

CREATE TABLE `tingkat_pelanggaran` (
  `id` int(11) NOT NULL,
  `tingkat` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tingkat_pelanggaran`
--

INSERT INTO `tingkat_pelanggaran` (`id`, `tingkat`, `deskripsi`) VALUES
(1, 'V', 'Pelanggaran ringan'),
(2, 'IV', 'Pelanggaran sedang'),
(3, 'III', 'Pelanggaran cukup berat'),
(4, 'II', 'Pelanggaran berat'),
(5, 'I', 'Pelanggaran sangat berat');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `level` enum('admin','dosen','mahasiswa') NOT NULL,
  `tanda` enum('simpan','hapus') DEFAULT 'simpan'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `salt`, `level`, `tanda`) VALUES
(1, '001', '$2y$10$2d16e387d10d3719c571674bf2c73a2cb7f15f98caac532b94f0b2f7dfb1083a', '2d16e387d10d3719c571674bf2c73a2c', 'admin', 'simpan'),
(2, '2241720024', '$2y$10$b17ab033ccce3e3830cb79fbb10d00f585b71f67e8892122f64ca22ec5721eb2', 'b17ab033ccce3e3830cb79fbb10d00f5', 'mahasiswa', 'simpan'),
(3, '2241720233', '$2y$10$233b4cfe924148c5209bbd665a5f4a4bb5e884f46f8c750e27e5e5953cd2cb39', '233b4cfe924148c5209bbd665a5f4a4b', 'mahasiswa', 'simpan'),
(4, '2241720151', '$2y$10$6b6fd4ac56f00f892ff23e0ff785ecc637dc00a321f68e7c710563c631ba534f', '6b6fd4ac56f00f892ff23e0ff785ecc6', 'mahasiswa', 'simpan'),
(5, '2241720012', '$2y$10$30d8ee69bb9f97a513e1a944be084bbe1cb4952f63e769bf2d2732abef365f07', '30d8ee69bb9f97a513e1a944be084bbe', 'mahasiswa', 'simpan'),
(6, '2241720018', '$2y$10$ad3af6c621adceb58cb6326b748fc6ae7de98a20446dd8af727d82658c5bd700', 'ad3af6c621adceb58cb6326b748fc6ae', 'mahasiswa', 'simpan'),
(7, '0023089102', '$2y$10$ded30ab51fabb05ade5145dbbf4d8964bcb13ac465d2956ac9ee9e6e36f86618', 'ded30ab51fabb05ade5145dbbf4d8964', 'dosen', 'simpan'),
(8, '0716037502', '$2y$10$d97c93e3a76006d5cc206adf9852a9caa17492583ff6743cdbb2f3f0f4b3f91c', 'd97c93e3a76006d5cc206adf9852a9ca', 'dosen', 'simpan'),
(9, '0031019404', '$2y$10$748edc29008983d4512bc92557c5906e2664fac083f48c00a4348de20b5db7e0', '748edc29008983d4512bc92557c5906e', 'dosen', 'simpan'),
(10, '0005078102', '$2y$10$016768fc50d39cc88742d73c52ff11005b5a468b213d67819bbe8d62f21d3ac6', '016768fc50d39cc88742d73c52ff1100', 'dosen', 'simpan'),
(11, '0017129402', '$2y$10$0b739f70dd0313c7f2c86567692a33b0391be7d738a21d1f39a2aec8a07e7193', '0b739f70dd0313c7f2c86567692a33b0', 'dosen', 'simpan'),
(12, '19560701', '$2y$10$06f33da327fc28ef01a732588444d6fb66528334b927db3a70c410851b232cf4', '06f33da327fc28ef01a732588444d6fb', 'dosen', 'simpan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhs`
--
ALTER TABLE `mhs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `riwayat_pelanggaran`
--
ALTER TABLE `riwayat_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sanksi`
--
ALTER TABLE `sanksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tingkat_pelanggaran`
--
ALTER TABLE `tingkat_pelanggaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mhs`
--
ALTER TABLE `mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelanggaran`
--
ALTER TABLE `pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `riwayat_pelanggaran`
--
ALTER TABLE `riwayat_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sanksi`
--
ALTER TABLE `sanksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tingkat_pelanggaran`
--
ALTER TABLE `tingkat_pelanggaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
