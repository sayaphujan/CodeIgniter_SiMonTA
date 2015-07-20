-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 01, 2015 at 03:09 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbsimonta`
--

-- --------------------------------------------------------

--
-- Table structure for table `akses`
--

CREATE TABLE IF NOT EXISTS `akses` (
  `akses_id` int(2) NOT NULL AUTO_INCREMENT,
  `level_id` int(2) NOT NULL,
  `menu` int(2) NOT NULL,
  `akses_status` enum('AKTIF','NON-AKTIF') COLLATE latin1_general_ci NOT NULL DEFAULT 'AKTIF',
  PRIMARY KEY (`akses_id`),
  KEY `level_id` (`level_id`,`menu`),
  KEY `menu` (`menu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=104 ;

--
-- Dumping data for table `akses`
--

INSERT INTO `akses` (`akses_id`, `level_id`, `menu`, `akses_status`) VALUES
(22, 11, 18, 'AKTIF'),
(24, 2, 3, 'AKTIF'),
(25, 2, 5, 'AKTIF'),
(30, 2, 4, 'AKTIF'),
(36, 3, 15, 'AKTIF'),
(42, 2, 23, 'AKTIF'),
(44, 2, 14, 'AKTIF'),
(45, 12, 3, 'AKTIF'),
(47, 12, 6, 'AKTIF'),
(49, 12, 13, 'AKTIF'),
(51, 12, 29, 'AKTIF'),
(52, 12, 18, 'AKTIF'),
(54, 3, 3, 'AKTIF'),
(58, 10, 3, 'AKTIF'),
(60, 10, 6, 'AKTIF'),
(61, 10, 13, 'AKTIF'),
(62, 10, 29, 'AKTIF'),
(63, 10, 18, 'AKTIF'),
(64, 4, 24, 'AKTIF'),
(65, 4, 25, 'AKTIF'),
(66, 11, 3, 'AKTIF'),
(68, 11, 6, 'AKTIF'),
(69, 11, 29, 'AKTIF'),
(70, 11, 26, 'AKTIF'),
(71, 11, 13, 'AKTIF'),
(72, 12, 26, 'AKTIF'),
(73, 10, 26, 'AKTIF'),
(74, 13, 3, 'AKTIF'),
(76, 13, 6, 'AKTIF'),
(77, 13, 13, 'AKTIF'),
(78, 13, 29, 'AKTIF'),
(79, 13, 18, 'AKTIF'),
(80, 13, 26, 'AKTIF'),
(81, 10, 27, 'AKTIF'),
(82, 11, 27, 'AKTIF'),
(83, 12, 27, 'AKTIF'),
(84, 13, 27, 'AKTIF'),
(89, 2, 1, 'AKTIF'),
(94, 10, 30, 'AKTIF'),
(95, 11, 30, 'AKTIF'),
(96, 12, 30, 'AKTIF'),
(97, 13, 30, 'AKTIF'),
(98, 2, 33, 'AKTIF'),
(99, 2, 32, 'AKTIF'),
(100, 10, 34, 'AKTIF'),
(101, 11, 34, 'AKTIF'),
(102, 12, 34, 'AKTIF'),
(103, 13, 34, 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `alihbimbingan`
--

CREATE TABLE IF NOT EXISTS `alihbimbingan` (
  `alih_id` int(5) NOT NULL AUTO_INCREMENT,
  `mhs_id` int(5) NOT NULL,
  `lap_id` int(5) NOT NULL,
  `pgw_id` int(4) NOT NULL,
  `bimb_file` varchar(100) NOT NULL,
  `bimb_komentar` varchar(200) NOT NULL,
  `bimb_tgl` date NOT NULL,
  `bimb_waktu` time NOT NULL,
  `bimb_status` enum('ACC','REVISI - P2','REVISI - P1','Menunggu Diperiksa','Menunggu Diperiksa Dosen P1') NOT NULL DEFAULT 'Menunggu Diperiksa',
  `tapel_id` int(4) NOT NULL,
  `dos_status` enum('DOSEN P1','DOSEN P2') NOT NULL,
  PRIMARY KEY (`alih_id`),
  KEY `lap_id` (`lap_id`),
  KEY `pgw_id` (`pgw_id`),
  KEY `tapel_id` (`tapel_id`),
  KEY `mhs_id` (`mhs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `bagidosen`
--

CREATE TABLE IF NOT EXISTS `bagidosen` (
  `bagi_id` int(4) NOT NULL AUTO_INCREMENT,
  `pgw_id` int(4) NOT NULL,
  `p1` enum('Y','T') NOT NULL,
  `p2` enum('Y','T') NOT NULL,
  PRIMARY KEY (`bagi_id`),
  KEY `pgw_id` (`pgw_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `bagidosen`
--

INSERT INTO `bagidosen` (`bagi_id`, `pgw_id`, `p1`, `p2`) VALUES
(1, 1, 'T', 'Y'),
(2, 5, 'Y', 'T'),
(3, 2, 'Y', 'T'),
(4, 4, 'Y', 'T'),
(5, 9, 'T', 'Y'),
(6, 20, 'T', 'Y'),
(7, 0, 'Y', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE IF NOT EXISTS `berita` (
  `berita_id` int(5) NOT NULL AUTO_INCREMENT,
  `berita_judul` varchar(255) NOT NULL,
  `berita_isi` text NOT NULL,
  `berita_img` varchar(100) NOT NULL DEFAULT 'ci.gif',
  `berita_tanggal` date NOT NULL,
  `berita_waktu` time NOT NULL,
  `katberita_id` int(5) NOT NULL,
  `berita_status` enum('AKTIF','NON-AKTIF') NOT NULL,
  PRIMARY KEY (`berita_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`berita_id`, `berita_judul`, `berita_isi`, `berita_img`, `berita_tanggal`, `berita_waktu`, `katberita_id`, `berita_status`) VALUES
(38, 'tes lagi', 'qwertyuiop[asdfghjkl;zxcvbnm,.lkmbf vvbaklknb gvbhajiok,mn bvnmc,lkjdshbnmc,xlkjncb vnxmz,mx ncbncmx,.szmncxb vcmx,cn b,xzmcn `xz,mnc vcx,sancb vcmcnv bncmdxkn vbcm,dmcnv bc,smnvc bcmdx,cnv cm,dxcn vcmx,mdcn vc,xmn v', 'logo.png', '2014-06-26', '17:31:00', 1, 'AKTIF'),
(42, 'Onno W Purbo beri Kuliah IT Online Gratis', 'Pakar informasi dan telekomunikasi (IT) Onno Widodo Purbo memberi kuliah IT online secara gratis melalui laman cyberlearning.web.id. \r\n<br/>\r\n<br/>\r\n"Untuk mempermudah transfer ilmu saya sengaja buat satu situs khusus, http://cyberlearning.web.id. Kalau ada yang mau belajar, silakan ikut kuliah di situ," kata Onno sebelum mengawali kuliah onlinenya di Jakarta, Senin. \r\n<br/>\r\n<br/>\r\nPegiat IT proletar ini mengatakan telah menyiapkan bahan perkuliahan untuk mengajarkan cara membuat sistem operasi Android sendiri hingga Desember. Seluruh materi perkuliahan dapat diakses melalui situs yang telah dikembangkan. \r\n<br/>\r\n<br/>\r\n"Ada kuisnya juga di setiap akhir pembahasan. Ada ujian akhir juga, tapi nanti dibebaskan apa mau buat sistem Android sendiri atau e-book," ujar dia. \r\n<br/>\r\n<br/>\r\nSemua konten di situs tersebut, menurut dia, sudah digarap bersama rekan-rekan pengajar lain. Dengan tampilan yang sederhana, semua materi kuliah yang pernah diajarkan Onno dan kawan-kawan tersedia lengkap dan bisa dinikmati gratis. \r\n<br/>\r\n<br/>\r\nBagi mereka yang ingin menjadi mahasiswanya, Onno menyarakan agar dapat langsung masuk ke bagian eLearning Rakyat di situs yang telah dibuat. Dan jika tidak ingin repot membuat akun bisa langsung masuk dengan cara hadir sebagai guess dengan kata sandi "tamu". \r\n<br/>\r\n<br/>\r\n"Dalam waktu dua minggu, yang ikut di cyberlearning ini sekarang sudah hampir 800 peserta. Kebanyakan mereka berasal dari luar Pulau Jawa," ujar Onno.">Kuliah online sehubungan dengan misi untuk mencerdaskan bangsa sekaligus melakukan sumbangsih untuk pembangunan akses internet yang merata dan terjangkau di seluruh Indonesia dilakukan mereka yang tergabung dalam "Onno Center #Internetrakyat". \r\n<br/>\r\n<br/>\r\nPada perkuliahan online kali ini selain dapat diikuti langsung di Gedung IDC 3D, Duren Tiga, Jakarta, dan juga dapat diikuti secara streaming dari tiga situs berbeda mengajarkan cara membuat Sistem Operasi Android Sendiri.">Pakar informasi dan telekomunikasi (IT) Onno Widodo Purbo memberi kuliah IT online secara gratis melalui laman cyberlearning.web.id. \r\n<br/>\r\n<br/>\r\n"Untuk mempermudah transfer ilmu saya sengaja buat satu situs khusus, http://cyberlearning.web.id. Kalau ada yang mau belajar, silakan ikut kuliah di situ," kata Onno sebelum mengawali kuliah onlinenya di Jakarta, Senin. \r\n<br/>\r\n<br/>', 'Onno-Widodo-Purbo.jpg', '2014-12-04', '20:20:44', 1, 'AKTIF');
INSERT INTO `berita` (`berita_id`, `berita_judul`, `berita_isi`, `berita_img`, `berita_tanggal`, `berita_waktu`, `katberita_id`, `berita_status`) VALUES
(45, '2 in 1, PC yang Tepat untuk Pelajar', '<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adalah pilihan yang cerdas.</p>\r\n<p>Bagaimana 2 in 1 membantu dalam belajar?</p>\r\n<p>2 in 1 adalah perangkat yang dimulai sebagai notebook namun dapat berubah menjadi tablet. Artinya, anda dapat menggunakannya sesuai kehendak. Baik sebagai notebook untuk membuat makalah dan presentasi atau sebagai tablet yang sangat sesuai untuk menjelajahi web dan membaca.</p>\r\n<p><strong>Daya Tahan Baterai Luar Biasa</strong></p>\r\n<p>Sebagai siswa, anda menghabiskan jumlah waktu yang sama di luar sekolah dengan di dalam kelas, sehingga daya tahan baterai sangat penting. Untungnya, model 2 in 1 terbaru dilengkapi dengan prosesor Intel Core generasi ke-4 yang hemat energi, sehingga dapat membantu memperpanjang daya tahan baterai1.</p>\r\n<p><strong>Cukup Ringan untuk Dibawa ke Mana Saja</strong></p>\r\n<p>Tas sekolah sudah cukup berat. 2 in 1 adalah komputer ringan yang dapat dibawa kemana saja sambil tetap menikmati kinerja notebook penuh. Bahkan, pada sebagian model Anda dapat melepas layar dan menggunakannya sebagai tablet, sehingga keyboard bisa ditinggalkan dalam tas atau loker apabila tidak dibutuhkan.</p>\r\n<p><strong>Grafis Hebat Berarti Proyek Multimedia Hebat</strong></p>\r\n<p>Jika anda perlu membuat proyek video untuk sekolah, 2 in 1 adalah alat yang tepat untuk itu. Ingat prosesor Intel yang kami sebutkan di atas? Itu juga dilengkapi dengan kinerja dan grafis untuk membuat video menakjubkan. Ketika saatnya tiba untuk ditunjukkan ke guru, ganti ke mode tablet untuk menjadikan presentasi anda super keren.</p>\r\n<p><strong>Anak-Anak Senang Bermain</strong></p>\r\n<p>Sebagaimana kata pepatah, bekerja terus tanpa bermain menjadikan kita bosan. Dengan 2 in 1, ini tidak akan terjadi. Perangkat 2 in 1 dilengkapi grafis yang mengagumkan, sehingga bermain game menjadi sangat menyenangkan dan menghanyutkan (tentu saja setelah pekerjaan rumah selesai). Anda juga dapat menikmati semua game yang tersedia pada tablet dan PC dalam satu perangkat.</p>\r\n</div>\r\n<p><strong>(ahm)</strong></p>\r\n<div class="signature">&nbsp;</div>\r\n<p>&nbsp;</p>\r\n<p>"&gt;</p>\r\n<div class="dtlnews">\r\n<div>\r\n<p><strong>KINI</strong>, hampir merupakan keharusan bagi setiap siswa memiliki PC untuk keperluan sekolah. Komputer telah menjadi alat bantu belajar yang esensial, membantu menyelesaikan tugas belajar setiap hari, proyek, dan tentu saja pekerjaan rumah. Mencari komputer yang tepat untuk sekolah? PC 2 in 1 yang baru adala', 'android_intel.png', '2014-12-28', '12:45:43', 1, 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `bimbingan`
--

CREATE TABLE IF NOT EXISTS `bimbingan` (
  `bim_id` int(5) NOT NULL AUTO_INCREMENT,
  `lap_id` int(5) NOT NULL,
  `pgw_id` int(4) NOT NULL,
  `bimb_file` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT 'Tak ada File Revisi',
  `bimb_komentar` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT 'Tak Ada Komentar',
  `bimb_tgl` date NOT NULL,
  `bimb_waktu` time NOT NULL,
  `bimb_status` enum('ACC','REVISI - P2','REVISI - P1','Menunggu Diperiksa','Menunggu Diperiksa Dosen P1','Diajukan Untuk Diperiksa Dosen P1') COLLATE latin1_general_ci NOT NULL DEFAULT 'Menunggu Diperiksa',
  `tapel_id` int(4) NOT NULL,
  `p1` enum('1','0') COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  `p2` enum('1','0') COLLATE latin1_general_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`bim_id`),
  KEY `lap_id` (`lap_id`),
  KEY `pgw_id` (`pgw_id`),
  KEY `tapel_id` (`tapel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=16 ;

--
-- Dumping data for table `bimbingan`
--

INSERT INTO `bimbingan` (`bim_id`, `lap_id`, `pgw_id`, `bimb_file`, `bimb_komentar`, `bimb_tgl`, `bimb_waktu`, `bimb_status`, `tapel_id`, `p1`, `p2`) VALUES
(6, 2, 5, 'Tak ada File Revisi', 'Tak ada Komentar', '2015-02-13', '16:51:10', 'ACC', 9, '1', '0'),
(7, 3, 0, 'Tak ada File Revisi', 'Tak Ada Komentar', '2015-02-21', '07:31:00', 'ACC', 9, '0', '0'),
(13, 9, 5, 'Tak ada File Revisi', 'Tak ada Komentar', '2015-03-01', '20:59:16', 'ACC', 2, '1', '0'),
(15, 11, 5, 'Tak ada File Revisi', 'Tak ada Komentar', '2015-03-01', '21:46:06', 'ACC', 3, '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard_oto`
--

CREATE TABLE IF NOT EXISTS `dashboard_oto` (
  `dash_id` int(5) NOT NULL AUTO_INCREMENT,
  `mhs_id` int(5) NOT NULL,
  `daftar` enum('AKTIF','NON AKTIF') NOT NULL DEFAULT 'NON AKTIF',
  `judul` enum('AKTIF','NON AKTIF') NOT NULL DEFAULT 'NON AKTIF',
  `proposal` enum('AKTIF','NON AKTIF') NOT NULL DEFAULT 'NON AKTIF',
  `bab1` enum('AKTIF','NON AKTIF') NOT NULL DEFAULT 'NON AKTIF',
  `bab2` enum('AKTIF','NON AKTIF') NOT NULL DEFAULT 'NON AKTIF',
  `bab3` enum('AKTIF','NON AKTIF') NOT NULL DEFAULT 'NON AKTIF',
  `bab4` enum('AKTIF','NON AKTIF') NOT NULL DEFAULT 'NON AKTIF',
  `bab5` enum('AKTIF','NON AKTIF') NOT NULL DEFAULT 'NON AKTIF',
  `bab6` enum('AKTIF','NON AKTIF') NOT NULL DEFAULT 'NON AKTIF',
  PRIMARY KEY (`dash_id`),
  KEY `mhs_id` (`mhs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=51 ;

--
-- Dumping data for table `dashboard_oto`
--

INSERT INTO `dashboard_oto` (`dash_id`, `mhs_id`, `daftar`, `judul`, `proposal`, `bab1`, `bab2`, `bab3`, `bab4`, `bab5`, `bab6`) VALUES
(1, 70, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(4, 75, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(5, 76, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(6, 77, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(7, 78, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(8, 79, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(9, 80, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(10, 81, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(11, 82, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(12, 83, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(13, 86, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(14, 87, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(15, 88, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(16, 89, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(17, 90, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(18, 91, 'AKTIF', 'AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(19, 92, 'AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(20, 93, 'AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(21, 94, 'AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(22, 95, 'AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(23, 96, 'AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(24, 97, 'AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(25, 98, 'AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(36, 69, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(37, 71, 'NON AKTIF', 'AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(39, 111, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(40, 112, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(41, 113, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(44, 117, 'NON AKTIF', 'AKTIF', 'AKTIF', 'AKTIF', 'AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF'),
(50, 122, 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF', 'NON AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `dospem`
--

CREATE TABLE IF NOT EXISTS `dospem` (
  `dospem_id` int(5) NOT NULL AUTO_INCREMENT,
  `mhs_id` int(5) NOT NULL,
  `pgw_id` int(4) NOT NULL,
  `p1` enum('1','0') COLLATE latin1_general_ci NOT NULL,
  `p2` enum('1','0') COLLATE latin1_general_ci NOT NULL,
  `tapel_id` int(4) NOT NULL,
  PRIMARY KEY (`dospem_id`),
  KEY `pgw_id` (`pgw_id`),
  KEY `mhs_id` (`mhs_id`),
  KEY `tapel_id` (`tapel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=85 ;

--
-- Dumping data for table `dospem`
--

INSERT INTO `dospem` (`dospem_id`, `mhs_id`, `pgw_id`, `p1`, `p2`, `tapel_id`) VALUES
(41, 79, 3, '1', '0', 10),
(42, 79, 1, '0', '1', 10),
(43, 114, 5, '1', '0', 10),
(44, 114, 1, '0', '1', 10),
(53, 117, 5, '1', '0', 9),
(54, 117, 1, '0', '1', 9),
(57, 117, 5, '1', '0', 10),
(58, 117, 1, '0', '1', 10),
(75, 71, 5, '1', '0', 2),
(76, 71, 1, '0', '1', 2),
(81, 71, 5, '1', '0', 3),
(82, 71, 1, '0', '1', 3),
(83, 71, 2, '1', '0', 9),
(84, 71, 1, '0', '1', 9);

-- --------------------------------------------------------

--
-- Table structure for table `jurusan`
--

CREATE TABLE IF NOT EXISTS `jurusan` (
  `jur_id` int(2) NOT NULL AUTO_INCREMENT,
  `jur_nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `jur_kode` int(3) NOT NULL,
  `jur_status` enum('AKTIF','NON-AKTIF') COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`jur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `jurusan`
--

INSERT INTO `jurusan` (`jur_id`, `jur_nama`, `jur_kode`, `jur_status`) VALUES
(1, 'Sistem informatika', 230, 'AKTIF'),
(2, 'Teknik Informatika', 240, 'AKTIF'),
(3, 'Manajemen Informatika', 110, 'AKTIF'),
(4, 'Komputerisasi Akuntansi', 120, 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `katberita`
--

CREATE TABLE IF NOT EXISTS `katberita` (
  `katberita_id` int(2) NOT NULL AUTO_INCREMENT,
  `katberita_nama` varchar(50) NOT NULL,
  `katberita_status` enum('AKTIF','NON-AKTIF') NOT NULL,
  PRIMARY KEY (`katberita_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `katberita`
--

INSERT INTO `katberita` (`katberita_id`, `katberita_nama`, `katberita_status`) VALUES
(1, 'Uncategory', 'AKTIF'),
(2, 'Web', 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_laporan`
--

CREATE TABLE IF NOT EXISTS `kategori_laporan` (
  `kat_lap_id` int(2) NOT NULL AUTO_INCREMENT,
  `kat_lap` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`kat_lap_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `kategori_laporan`
--

INSERT INTO `kategori_laporan` (`kat_lap_id`, `kat_lap`) VALUES
(0, 'judul'),
(1, 'laporan'),
(2, 'revisi proposal sidang'),
(3, 'pesan'),
(11, 'bab1'),
(12, 'bab2'),
(13, 'bab3'),
(14, 'bab4'),
(15, 'bab5'),
(16, 'bab6');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_nilai_sidang`
--

CREATE TABLE IF NOT EXISTS `kategori_nilai_sidang` (
  `id_kat_nilai` int(2) NOT NULL AUTO_INCREMENT,
  `kriteria` varchar(1) NOT NULL,
  `nilai` int(3) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_kat_nilai`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `kategori_nilai_sidang`
--

INSERT INTO `kategori_nilai_sidang` (`id_kat_nilai`, `kriteria`, `nilai`, `status`) VALUES
(1, 'l', 80, '0'),
(3, 'l', 70, '1');

-- --------------------------------------------------------

--
-- Table structure for table `konsentrasi`
--

CREATE TABLE IF NOT EXISTS `konsentrasi` (
  `kon_id` int(2) NOT NULL AUTO_INCREMENT,
  `kon_nama` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `kon_status` enum('AKTIF','NON-AKTIF') COLLATE latin1_general_ci NOT NULL,
  `jur_id` int(2) NOT NULL,
  PRIMARY KEY (`kon_id`),
  KEY `jur_id` (`jur_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=8 ;

--
-- Dumping data for table `konsentrasi`
--

INSERT INTO `konsentrasi` (`kon_id`, `kon_nama`, `kon_status`, `jur_id`) VALUES
(1, 'Business Intelligence System', 'AKTIF', 1),
(2, 'e-business', 'AKTIF', 1),
(3, 'Computer Graphic and Multimedia', 'AKTIF', 2),
(4, 'Mobile Application and Web Programming', 'AKTIF', 2),
(5, 'Programming and Database Administration', 'AKTIF', 3),
(6, 'Multimedia', 'AKTIF', 3),
(7, 'Accounting', 'AKTIF', 4);

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE IF NOT EXISTS `laporan` (
  `lap_id` int(5) NOT NULL AUTO_INCREMENT,
  `mhs_id` int(5) NOT NULL,
  `kat_lap_id` int(2) NOT NULL,
  `lap_file` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `lap_tgl` date NOT NULL,
  `lap_waktu` time NOT NULL,
  `tapel_id` int(4) NOT NULL,
  PRIMARY KEY (`lap_id`),
  KEY `mhs_id` (`mhs_id`),
  KEY `kat_lap_id` (`kat_lap_id`),
  KEY `tapel_id` (`tapel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`lap_id`, `mhs_id`, `kat_lap_id`, `lap_file`, `lap_tgl`, `lap_waktu`, `tapel_id`) VALUES
(2, 117, 2, 'b2fc2b7953efe1c3c9f73e911e2f478c0115_Bab_I_II.docx', '2015-02-13', '15:58:02', 9),
(3, 117, 11, 'tes.docx', '2015-02-21', '07:30:00', 9),
(9, 71, 2, '675290a1164294e8b769893020d04a83surat_ijin.docx', '2015-03-01', '20:58:37', 2),
(11, 71, 11, '5390947686c849ab539131e73a66faf4PEMFITNAH.docx', '2015-03-01', '21:45:38', 3);

-- --------------------------------------------------------

--
-- Table structure for table `leveldosen`
--

CREATE TABLE IF NOT EXISTS `leveldosen` (
  `leveldos_id` int(2) NOT NULL AUTO_INCREMENT,
  `pgw_id` int(4) NOT NULL,
  `level_id` int(2) NOT NULL,
  PRIMARY KEY (`leveldos_id`),
  KEY `pgw_id` (`pgw_id`),
  KEY `level_id` (`level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=20 ;

--
-- Dumping data for table `leveldosen`
--

INSERT INTO `leveldosen` (`leveldos_id`, `pgw_id`, `level_id`) VALUES
(2, 1, 2),
(4, 2, 12),
(5, 5, 11),
(6, 5, 4),
(11, 2, 4),
(16, 1, 4),
(18, 4, 4),
(19, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `leveluser`
--

CREATE TABLE IF NOT EXISTS `leveluser` (
  `level_id` int(2) NOT NULL AUTO_INCREMENT,
  `level_name` varchar(50) NOT NULL,
  `level_status` enum('AKTIF','NON-AKTIF') NOT NULL,
  PRIMARY KEY (`level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `leveluser`
--

INSERT INTO `leveluser` (`level_id`, `level_name`, `level_status`) VALUES
(1, 'All User', 'AKTIF'),
(2, 'Administrator', 'AKTIF'),
(3, 'Dosen PA', 'AKTIF'),
(4, 'Dosen Pembimbing', 'AKTIF'),
(5, 'Dosen Tetap', 'AKTIF'),
(6, 'Mahasiswa', 'AKTIF'),
(7, 'Dosen Tidak Tetap', 'AKTIF'),
(10, 'Ka Progdi SI', 'AKTIF'),
(11, 'Ka Progdi TI', 'AKTIF'),
(12, 'Ka Progdi MI', 'AKTIF'),
(13, 'Ka Progdi KA', 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `mhs_id` int(5) NOT NULL AUTO_INCREMENT,
  `mhs_nim` varchar(11) NOT NULL,
  `mhs_nama` varchar(50) NOT NULL,
  `mhs_pass` text NOT NULL,
  `jur_id` int(4) NOT NULL,
  `kon_id` int(4) NOT NULL,
  `level_id` int(4) NOT NULL DEFAULT '6',
  `mhs_foto` varchar(100) DEFAULT 'anonim.png',
  `mhs_status` enum('AKTIF','NON-AKTIF') NOT NULL DEFAULT 'AKTIF',
  `angkatan` int(4) NOT NULL,
  PRIMARY KEY (`mhs_id`),
  UNIQUE KEY `nim` (`mhs_nim`),
  KEY `jur_id` (`jur_id`),
  KEY `kon_id` (`kon_id`),
  KEY `level_id` (`level_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`mhs_id`, `mhs_nim`, `mhs_nama`, `mhs_pass`, `jur_id`, `kon_id`, `level_id`, `mhs_foto`, `mhs_status`, `angkatan`) VALUES
(55, '11.120.0001', 'Nur Rissa', 'c740d6848b6a342dcc26c177ea2c49fe', 4, 7, 6, 'anonim.png', 'AKTIF', 2011),
(69, '11.110.0002', 'M. Habibie Abdurrahman', '28b662d883b6d76fd96e4ddc5e9ba780', 3, 5, 6, 'anonim.png', 'AKTIF', 2011),
(70, '11.110.0003', 'Shinta Setiawati', 'fe4ecc6dd32ceb6fb6d13b2ac09e6691', 3, 5, 6, '11.110.0003.jpg', 'AKTIF', 2011),
(71, '10.240.0001', 'M. Rofiudin', '28b662d883b6d76fd96e4ddc5e9ba780', 2, 4, 6, 'anonim.png', 'AKTIF', 2010),
(75, '11.230.0001', 'Achmad Juni Arba', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 2, 6, 'anonim.png', 'AKTIF', 2011),
(76, '10.230.0002', 'Danial Sigit Pratama', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 2, 6, 'anonim.png', 'AKTIF', 2010),
(77, '11.110.0004', 'IIs Risalatul', '28b662d883b6d76fd96e4ddc5e9ba780', 3, 1, 6, 'anonim.png', 'AKTIF', 2011),
(78, '11.230.0004', 'Danial Pratama', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 2, 6, 'anonim.png', 'AKTIF', 2011),
(79, '11.230.0005', 'tes5', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 2, 6, 'anonim.png', 'AKTIF', 2011),
(80, '11.230.0006', 'tes6', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 1, 6, 'anonim.png', 'AKTIF', 2011),
(81, '11.230.0007', 'tes7', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 1, 6, 'anonim.png', 'AKTIF', 2011),
(82, '11.230.0008', 'tes8', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 1, 6, 'anonim.png', 'AKTIF', 2011),
(83, '11.230.0009', 'tes9', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 1, 6, 'anonim.png', 'AKTIF', 2011),
(86, '11.230.0010', 'tes10', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 1, 6, 'anonim.png', 'AKTIF', 2011),
(87, '11.230.0011', 'tes11', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 1, 6, 'anonim.png', 'AKTIF', 2011),
(88, '11.230.0012', 'tes12', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 1, 6, 'anonim.png', 'AKTIF', 2011),
(89, '11.230.0013', 'tes13', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 2, 6, 'anonim.png', 'AKTIF', 2011),
(90, '11.230.0014', 'tes14', '28b662d883b6d76fd96e4ddc5e9ba780', 1, 2, 6, 'anonim.png', 'AKTIF', 2011),
(91, '10.240.0002', 'tes15', '28b662d883b6d76fd96e4ddc5e9ba780', 2, 3, 6, 'anonim.png', 'AKTIF', 2010),
(92, '11.240.0003', 'tes16', '28b662d883b6d76fd96e4ddc5e9ba780', 2, 3, 6, 'anonim.png', 'AKTIF', 2011),
(93, '11.240.0004', 'tes17', '28b662d883b6d76fd96e4ddc5e9ba780', 2, 3, 6, 'anonim.png', 'AKTIF', 2011),
(94, '11.240.0005', 'tes18', '28b662d883b6d76fd96e4ddc5e9ba780', 2, 3, 6, 'anonim.png', 'AKTIF', 2011),
(95, '11.240.0006', 'tes19', '28b662d883b6d76fd96e4ddc5e9ba780', 2, 3, 6, 'anonim.png', 'AKTIF', 2011),
(96, '11.240.0007', 'tes20', '28b662d883b6d76fd96e4ddc5e9ba780', 2, 4, 6, 'anonim.png', 'AKTIF', 2011),
(97, '11.240.0008', 'tes21', '28b662d883b6d76fd96e4ddc5e9ba780', 2, 4, 6, 'anonim.png', 'AKTIF', 2011),
(98, '11.240.0009', 'tes22', '28b662d883b6d76fd96e4ddc5e9ba780', 2, 4, 6, 'anonim.png', 'AKTIF', 2011),
(111, '11.120.0002', 'sephia', '28b662d883b6d76fd96e4ddc5e9ba780', 4, 7, 6, 'anonim.png', 'AKTIF', 2011),
(112, '11.120.0003', 'sephia sahili', '28b662d883b6d76fd96e4ddc5e9ba780', 4, 7, 6, 'Frozen-Sister-and-Olaf-Laughing-Wallpaper.png', 'AKTIF', 2011),
(113, '11.110.0005', 'ismail', '28b662d883b6d76fd96e4ddc5e9ba780', 3, 6, 6, 'Dragonball GT 63.mkv_snapshot_13.47_[2012.05.05_12.56.52].jpg', 'AKTIF', 2011),
(114, '11.240.0011', 'jono', '28b662d883b6d76fd96e4ddc5e9ba780', 2, 2, 6, 'anonim.png', 'AKTIF', 2011),
(115, '11.110.0007', 'jono2', '28b662d883b6d76fd96e4ddc5e9ba780', 3, 5, 6, 'anonim.png', 'AKTIF', 2011),
(117, '11.240.0010', 'tes20', '28b662d883b6d76fd96e4ddc5e9ba780', 2, 3, 6, 'anonim.png', 'AKTIF', 2011),
(122, '11.120.0004', 'tes22', '28b662d883b6d76fd96e4ddc5e9ba780', 4, 7, 6, 'anonim.png', 'AKTIF', 2011);

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `menu_id` int(2) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(50) NOT NULL,
  `menu_description` varchar(50) NOT NULL,
  `menu_group` varchar(50) NOT NULL,
  `menu_path` varchar(50) NOT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `menu_description`, `menu_group`, `menu_path`) VALUES
(1, 'akademik', 'Data Akademik', 'user', 'admin/tapel'),
(2, 'buku-tamu', 'Buku Tamu', 'admin', 'admin/notifikasi'),
(3, 'mahasiswa', 'Data Mahasiswa', 'user', 'admin/mahasiswa'),
(4, 'berita', 'Data Berita', 'admin', 'admin/berita'),
(5, 'pegawai', 'Data Dosen', 'user', 'admin/dosen'),
(6, 'dospem', 'Data Dosen Pembimbing', 'dosen', 'admin/dospem'),
(7, 'proposal', 'Proposal', 'ta', 'proposal'),
(8, 'jurusan', 'Data Jurusan', 'akademik', 'admin/jurusan'),
(9, 'konsentrasi', 'Data Konsentrasi', 'akademik', 'admin/konsentrasi'),
(10, 'jabatan', 'Data Jabatan', 'akademik', 'admin/jabatan'),
(11, 'kompetensi', 'Data Kompetensi', 'akademik', 'admin/kompetensi'),
(12, 'level', 'Data Level', 'admin', 'admin/level'),
(13, 'tema', 'Data Tema', 'ta', 'admin/tema'),
(14, 'hak-akses', 'Data Hak Akses', 'admin', 'admin/akses'),
(15, 'bimbingan-akademik', 'Bimbingan Akademik', '', 'admin/akademik'),
(18, 'judul dosen', 'Data Pengajuan Judul', 'ta', 'admin/pengajuan'),
(19, 'laporan', 'Laporan', 'ta', 'laporan'),
(20, 'proposal', 'Proposal', 'ta', 'admin/proposal'),
(21, 'laporan', 'Laporan', 'ta', 'admin/laporan'),
(22, 'listlevel', 'Listing Level', 'admin', 'admin/level/listing'),
(23, 'pengajuan_admin', 'Data Pengajuan Judul', 'ta', 'admin/pengajuan_admin'),
(24, 'sidang', 'Sidang Proposal', 'ta', 'admin/sidang'),
(25, 'bimbingan', 'Bimbingan', 'ta', 'admin/bimbingan'),
(26, 'progress', 'Data Progress Mahasiswa', 'ta', 'admin/progress'),
(27, 'nilai-sidang', 'Data Nilai Sidang', 'ta', 'admin/sidang/lihatnilai'),
(29, 'alihbimbingan', 'Data Alih Dosen Pembimbing', 'dosen', 'admin/dospem/change'),
(30, 'rekap', 'Rekap Data', '0', 'admin/ta'),
(32, 'bagidosen', 'Data Pembagian Dosen', 'user', 'admin/dosen/bagi'),
(33, 'krs', 'Data Registrasi TA/ Skripsi', 'user', 'admin/tapel/ta'),
(34, 'kategori-nilai-sidang', 'Kriteria Nilai Sidang Proposal', 'ta', 'admin/sidang/katnilai');

-- --------------------------------------------------------

--
-- Table structure for table `mhs_akhir`
--

CREATE TABLE IF NOT EXISTS `mhs_akhir` (
  `akhir_id` int(5) NOT NULL AUTO_INCREMENT,
  `tapel_id` int(4) NOT NULL,
  `mhs_id` int(5) NOT NULL,
  `numsmester` int(2) NOT NULL,
  `statusmatkul` enum('B','U') NOT NULL,
  PRIMARY KEY (`akhir_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `mhs_akhir`
--

INSERT INTO `mhs_akhir` (`akhir_id`, `tapel_id`, `mhs_id`, `numsmester`, `statusmatkul`) VALUES
(7, 9, 117, 7, 'B'),
(20, 10, 117, 7, 'U'),
(22, 11, 117, 8, 'U'),
(23, 10, 112, 7, 'B'),
(32, 2, 71, 7, 'B'),
(35, 3, 71, 8, 'U'),
(36, 9, 71, 8, 'U');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE IF NOT EXISTS `pegawai` (
  `pgw_id` int(4) NOT NULL AUTO_INCREMENT,
  `pgw_nip` varchar(17) NOT NULL,
  `pgw_nama` varchar(50) NOT NULL,
  `pgw_username` varchar(100) NOT NULL,
  `pgw_pass` text NOT NULL,
  `pgw_status` enum('AKTIF','NON-AKTIF') NOT NULL DEFAULT 'AKTIF',
  `pgw_foto` varchar(100) DEFAULT 'anonim.png',
  `level_id` int(2) NOT NULL,
  PRIMARY KEY (`pgw_id`),
  KEY `nip` (`pgw_nip`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`pgw_id`, `pgw_nip`, `pgw_nama`, `pgw_username`, `pgw_pass`, `pgw_status`, `pgw_foto`, `level_id`) VALUES
(0, '0', 'Belum Dipilih', 'root', '63a9f0ea7bb98050796b649e85481845', 'AKTIF', 'anonim.png', 1),
(1, '43100810001', 'Tory Ariyanto', 'tory', 'e172dd95f4feb21412a692e73929961e', 'AKTIF', 'anonim.png', 2),
(2, '43100810002', 'Rifqi Maulana', 'rifqi', '72561baf6079c338cc2dd68e98d52055', 'AKTIF', 'anonim.png', 12),
(3, '43100810003', 'Christanto P.A', 'christanto', '6b34fe24ac2ff8103f6fce1f0da2ef57', 'AKTIF', 'anonim.png', 3),
(4, '09809898989', 'Eddy Priyadi', 'eddy', '5aa8fed9741d33c63868a87f1af05ab7', 'AKTIF', 'anonim.png', 3),
(5, '987654', 'Christian Yulianto Rusli', 'tata', '49d02d55ad10973b7b9d0dc9eba7fdf0', 'AKTIF', 'anonim.png', 11),
(6, '960401.720216.010', 'Prastuti Sulistyorini', 'pras', '164361f78dbf22b529438ea4cc7f6496', 'AKTIF', 'anonim.png', 10),
(7, '990801.691103.021', 'Tri Pudji W', 'tri', 'd2cfe69af2d64330670e08efb2c86df7', 'AKTIF', 'anonim.png', 13),
(9, '960401.720216.011', 'Asif bin Barkhiya', 'asif', 'd41d8cd98f00b204e9800998ecf8427e', 'AKTIF', 'Frozen-Sister-and-Olaf-Laughing-Wallpaper.png', 7),
(20, '960401.720216.012', 'nemo', 'nemo', 'd41d8cd98f00b204e9800998ecf8427e', 'AKTIF', 'The beatles - at the edvulian stadium.FLV_snapshot_02.47_[2012.05.18_20.20.23].jpg', 7),
(21, '960401.720216.015', 'wqw', 'w', 'd41d8cd98f00b204e9800998ecf8427e', 'AKTIF', 'The_beatles_-_at_the_edvulian_stadium.FLV_snapshot_07.31_[2012.05.13_17.03.55].jpg', 5),
(22, '960401.720216.019', 'fa', 'dfa', 'd41d8cd98f00b204e9800998ecf8427e', 'AKTIF', 'The_Beatles_-_Two_Of_Us_[HQ]_-_YouTube.flv_snapshot_02.01_[2012.05.07_17.25.45].jpg', 5),
(23, '960401.720216.018', 'dsm', 'm', 'd41d8cd98f00b204e9800998ecf8427e', 'AKTIF', 'The_beatles_-_at_the_edvulian_stadium.FLV_snapshot_05.29_[2012.05.13_17.06.35].jpg', 5),
(24, '960401.720216.017', 'mcm', 'mmm', 'd41d8cd98f00b204e9800998ecf8427e', 'AKTIF', 'The beatles - at the edvulian stadium.FLV_snapshot_02.09_[2012.05.18_20.19.36].jpg', 5),
(25, '123456.123456.123', 'tessatu', 'saint', 'd41d8cd98f00b204e9800998ecf8427e', 'AKTIF', 'anonim.png', 7);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE IF NOT EXISTS `pengajuan` (
  `peng_id` int(5) NOT NULL AUTO_INCREMENT,
  `mhs_id` int(5) NOT NULL,
  `tema_id` int(2) NOT NULL,
  `peng_judul` text COLLATE latin1_general_ci NOT NULL,
  `peng_label` longtext COLLATE latin1_general_ci NOT NULL,
  `peng_metpen` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `peng_ginput` longtext COLLATE latin1_general_ci NOT NULL,
  `peng_goutput` longtext COLLATE latin1_general_ci NOT NULL,
  `peng_tanggal` date NOT NULL,
  `peng_waktu` time NOT NULL,
  `peng_status` enum('PENDING','DISETUJUI','DITOLAK') COLLATE latin1_general_ci NOT NULL DEFAULT 'PENDING',
  `peng_komentar` varchar(200) COLLATE latin1_general_ci NOT NULL DEFAULT 'Belum Ada Komentar',
  `tapel_id` int(4) NOT NULL,
  PRIMARY KEY (`peng_id`),
  UNIQUE KEY `peng_judul` (`peng_judul`(100)),
  KEY `mhs_id` (`mhs_id`),
  KEY `tema_id` (`tema_id`),
  KEY `tapel_id` (`tapel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=56 ;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`peng_id`, `mhs_id`, `tema_id`, `peng_judul`, `peng_label`, `peng_metpen`, `peng_ginput`, `peng_goutput`, `peng_tanggal`, `peng_waktu`, `peng_status`, `peng_komentar`, `tapel_id`) VALUES
(37, 117, 4, 'JB', 'mnnk', 'knk', 'nknk', 'nknk', '2015-02-01', '03:28:00', 'DISETUJUI', 'Belum Ada Komentar', 9),
(41, 117, 4, 'ulang-JB', 'mnnk', 'knk', 'nknk', 'nknk', '2015-02-14', '03:47:29', 'DISETUJUI', 'Belum Ada Komentar', 10),
(42, 114, 2, 'tesJOno', 'tes', 'tes', 'tes', 'tes', '2015-02-16', '08:55:00', 'DISETUJUI', 'Belum Ada Komentar', 10),
(45, 91, 3, 'tes', '<p>esew</p>', 'xzq', '<p>zwx</p>', '<p>&nbsp;bnvn</p>', '2015-03-01', '18:58:27', 'PENDING', 'Belum Ada Komentar', 2),
(51, 71, 1, 'fuzzy logic', '<p>tyft</p>', 'drdt', '<p>sdrxtd</p>', '<p>dctc</p>', '2015-03-01', '20:52:17', 'DISETUJUI', 'pertama', 2),
(54, 71, 1, 'ulang-fuzzy logic', '<p>tyft</p>', 'drdt', '<p>sdrxtd</p>', '<p>dctc</p>', '2015-03-01', '21:44:53', 'DISETUJUI', 'pertama', 3),
(55, 71, 2, 'laporan keuangan basis web', '<p>nbjk</p>', 'jnjk', '<p>njkn</p>', '<p>knj</p>', '2015-03-01', '21:47:40', 'DISETUJUI', 'Belum Ada Komentar', 9);

-- --------------------------------------------------------

--
-- Table structure for table `pesan_dos`
--

CREATE TABLE IF NOT EXISTS `pesan_dos` (
  `pesan_id` int(4) NOT NULL AUTO_INCREMENT,
  `pgw_id` int(4) NOT NULL,
  `mhs_id` int(5) NOT NULL,
  `kat_lap_id` int(2) NOT NULL,
  `pesan_isi` text,
  `pesan_status` char(1) NOT NULL DEFAULT '0',
  `pesan_tgl` date NOT NULL,
  `pesan_waktu` time NOT NULL,
  PRIMARY KEY (`pesan_id`),
  KEY `mhs_id` (`mhs_id`),
  KEY `pgw_id` (`pgw_id`),
  KEY `kat_lap_id` (`kat_lap_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `pesan_dos`
--

INSERT INTO `pesan_dos` (`pesan_id`, `pgw_id`, `mhs_id`, `kat_lap_id`, `pesan_isi`, `pesan_status`, `pesan_tgl`, `pesan_waktu`) VALUES
(5, 5, 71, 0, NULL, '1', '2015-03-01', '20:45:47'),
(6, 5, 71, 0, NULL, '0', '2015-03-01', '20:52:30'),
(7, 5, 71, 0, NULL, '0', '2015-03-01', '21:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `pesan_mhs`
--

CREATE TABLE IF NOT EXISTS `pesan_mhs` (
  `pesan_id` int(5) NOT NULL AUTO_INCREMENT,
  `mhs_id` int(5) NOT NULL,
  `pgw_id` int(4) NOT NULL,
  `kat_lap_id` int(2) NOT NULL,
  `pesan_isi` text,
  `pesan_status` char(1) NOT NULL DEFAULT '0',
  `pesan_tgl` date NOT NULL,
  `pesan_waktu` time NOT NULL,
  PRIMARY KEY (`pesan_id`),
  KEY `mhs_id` (`mhs_id`),
  KEY `pgw_id` (`pgw_id`),
  KEY `kat_lap_id` (`kat_lap_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `pesan_mhs`
--

INSERT INTO `pesan_mhs` (`pesan_id`, `mhs_id`, `pgw_id`, `kat_lap_id`, `pesan_isi`, `pesan_status`, `pesan_tgl`, `pesan_waktu`) VALUES
(15, 71, 5, 0, NULL, '1', '2015-03-01', '20:45:30'),
(16, 71, 5, 0, NULL, '0', '2015-03-01', '20:52:17'),
(17, 71, 5, 2, NULL, '0', '2015-03-01', '20:58:37'),
(18, 71, 1, 2, NULL, '0', '2015-03-01', '20:58:37'),
(19, 71, 5, 11, NULL, '0', '2015-03-01', '21:39:48'),
(20, 71, 1, 11, NULL, '0', '2015-03-01', '21:39:48'),
(21, 71, 5, 11, NULL, '0', '2015-03-01', '21:39:49'),
(22, 71, 1, 11, NULL, '0', '2015-03-01', '21:39:49'),
(23, 71, 5, 11, NULL, '0', '2015-03-01', '21:45:38'),
(24, 71, 1, 11, NULL, '0', '2015-03-01', '21:45:38'),
(25, 71, 5, 11, NULL, '0', '2015-03-01', '21:45:38'),
(26, 71, 1, 11, NULL, '0', '2015-03-01', '21:45:38'),
(27, 71, 5, 0, NULL, '0', '2015-03-01', '21:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `sidang`
--

CREATE TABLE IF NOT EXISTS `sidang` (
  `sidang_id` int(5) NOT NULL AUTO_INCREMENT,
  `mhs_id` int(5) NOT NULL,
  `nilaiP1` int(3) NOT NULL,
  `nilaiP2` int(3) NOT NULL,
  `nilaiAkhir` int(3) NOT NULL,
  `sidang_status` enum('PENDING','LULUS','TIDAK LULUS') NOT NULL DEFAULT 'PENDING',
  `sidang_revisi` enum('PENDING','ACC','REVISI') NOT NULL DEFAULT 'PENDING',
  `aktifasi` enum('aktif','nonaktif') NOT NULL,
  `tapel_id` int(4) NOT NULL,
  PRIMARY KEY (`sidang_id`),
  KEY `mhs_id` (`mhs_id`),
  KEY `tapel_id` (`tapel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `sidang`
--

INSERT INTO `sidang` (`sidang_id`, `mhs_id`, `nilaiP1`, `nilaiP2`, `nilaiAkhir`, `sidang_status`, `sidang_revisi`, `aktifasi`, `tapel_id`) VALUES
(32, 117, 80, 80, 80, 'LULUS', 'REVISI', 'nonaktif', 9),
(33, 114, 0, 0, 0, 'PENDING', 'PENDING', 'aktif', 9),
(39, 71, 90, 90, 90, 'LULUS', 'REVISI', 'nonaktif', 2),
(40, 71, 0, 0, 0, 'PENDING', 'PENDING', 'aktif', 9);

-- --------------------------------------------------------

--
-- Table structure for table `ta`
--

CREATE TABLE IF NOT EXISTS `ta` (
  `ta_id` int(5) NOT NULL AUTO_INCREMENT,
  `angk` int(4) NOT NULL,
  `jur_id` int(2) NOT NULL,
  `ta_mulai` date NOT NULL,
  `ta_akhir` date NOT NULL,
  `ta_status` enum('AKTIF','NON AKTIF') NOT NULL,
  `tapel_id` int(4) NOT NULL,
  PRIMARY KEY (`ta_id`),
  KEY `jur_id` (`jur_id`),
  KEY `tapel_id` (`tapel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `ta`
--

INSERT INTO `ta` (`ta_id`, `angk`, `jur_id`, `ta_mulai`, `ta_akhir`, `ta_status`, `tapel_id`) VALUES
(1, 2010, 1, '2015-01-01', '2015-01-02', 'NON AKTIF', 9),
(2, 2010, 2, '2015-01-01', '2015-01-02', 'AKTIF', 9),
(4, 2011, 4, '2015-01-01', '2015-01-02', 'NON AKTIF', 9),
(5, 2011, 3, '2015-02-08', '2015-02-28', 'NON AKTIF', 9),
(9, 2011, 1, '2015-01-01', '2015-02-28', 'NON AKTIF', 9),
(10, 2011, 2, '2015-01-01', '2015-02-28', 'NON AKTIF', 9),
(19, 2011, 2, '2015-02-01', '2015-02-28', 'NON AKTIF', 10),
(20, 2011, 2, '2015-03-01', '2015-03-31', 'NON AKTIF', 11),
(22, 2011, 4, '2015-02-21', '2015-02-28', 'NON AKTIF', 10),
(23, 2011, 3, '2015-02-28', '2015-02-28', 'NON AKTIF', 10),
(24, 2010, 2, '2015-02-28', '2015-02-27', 'NON AKTIF', 2),
(25, 2010, 2, '2015-03-01', '2015-03-31', 'NON AKTIF', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tapel`
--

CREATE TABLE IF NOT EXISTS `tapel` (
  `tapel_id` int(4) NOT NULL AUTO_INCREMENT,
  `tapel_akad` varchar(9) NOT NULL,
  `tapel_mulai` date NOT NULL,
  `tapel_akhir` date NOT NULL,
  `tapel_semester` enum('GASAL','GENAP') NOT NULL,
  `tapel_status` enum('1','0') NOT NULL DEFAULT '0',
  PRIMARY KEY (`tapel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `tapel`
--

INSERT INTO `tapel` (`tapel_id`, `tapel_akad`, `tapel_mulai`, `tapel_akhir`, `tapel_semester`, `tapel_status`) VALUES
(2, '2013/2014', '2013-01-01', '2013-05-31', 'GASAL', '0'),
(3, '2013/2014', '2014-06-01', '2014-12-31', 'GENAP', '0'),
(9, '2014/2015', '2014-10-01', '2014-12-31', 'GASAL', '1'),
(10, '2014/2015', '2015-02-01', '2015-02-28', 'GENAP', '0'),
(11, '2015/2016', '2015-03-01', '2015-08-31', 'GASAL', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tema`
--

CREATE TABLE IF NOT EXISTS `tema` (
  `tema_id` int(2) NOT NULL AUTO_INCREMENT,
  `tema_nama` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `tema_status` enum('AKTIF','NON-AKTIF') COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`tema_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tema`
--

INSERT INTO `tema` (`tema_id`, `tema_nama`, `tema_status`) VALUES
(1, 'FUZZY', 'AKTIF'),
(2, 'WEB', 'AKTIF'),
(3, 'SPK', 'AKTIF'),
(4, 'Android', 'AKTIF');

-- --------------------------------------------------------

--
-- Table structure for table `topik_revisi`
--

CREATE TABLE IF NOT EXISTS `topik_revisi` (
  `topik_id` int(11) NOT NULL AUTO_INCREMENT,
  `topik_isi` longtext NOT NULL,
  `mhs_id` int(5) NOT NULL,
  `topik_status` enum('1','0') NOT NULL DEFAULT '1',
  `tapel_id` int(4) NOT NULL,
  PRIMARY KEY (`topik_id`),
  KEY `mhs_id` (`mhs_id`),
  KEY `tapel_id` (`tapel_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `topik_revisi`
--

INSERT INTO `topik_revisi` (`topik_id`, `topik_isi`, `mhs_id`, `topik_status`, `tapel_id`) VALUES
(16, 'mn,xnsm,xbn,sb cx,msc', 117, '1', 9),
(17, 'tes satu', 117, '0', 9),
(18, 'tes dua', 117, '0', 9),
(23, 'satu', 71, '0', 2),
(24, 'dua', 71, '0', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akses`
--
ALTER TABLE `akses`
  ADD CONSTRAINT `akses_ibfk_1` FOREIGN KEY (`level_id`) REFERENCES `leveluser` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `akses_ibfk_2` FOREIGN KEY (`menu`) REFERENCES `menu` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `alihbimbingan`
--
ALTER TABLE `alihbimbingan`
  ADD CONSTRAINT `alihbimbingan_ibfk_1` FOREIGN KEY (`lap_id`) REFERENCES `laporan` (`lap_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alihbimbingan_ibfk_2` FOREIGN KEY (`pgw_id`) REFERENCES `pegawai` (`pgw_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alihbimbingan_ibfk_3` FOREIGN KEY (`tapel_id`) REFERENCES `tapel` (`tapel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bagidosen`
--
ALTER TABLE `bagidosen`
  ADD CONSTRAINT `bagidosen_ibfk_1` FOREIGN KEY (`pgw_id`) REFERENCES `pegawai` (`pgw_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bimbingan`
--
ALTER TABLE `bimbingan`
  ADD CONSTRAINT `bimbingan_ibfk_2` FOREIGN KEY (`lap_id`) REFERENCES `laporan` (`lap_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bimbingan_ibfk_3` FOREIGN KEY (`pgw_id`) REFERENCES `pegawai` (`pgw_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bimbingan_ibfk_4` FOREIGN KEY (`tapel_id`) REFERENCES `tapel` (`tapel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dashboard_oto`
--
ALTER TABLE `dashboard_oto`
  ADD CONSTRAINT `dashboard_oto_ibfk_1` FOREIGN KEY (`mhs_id`) REFERENCES `mahasiswa` (`mhs_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `dospem`
--
ALTER TABLE `dospem`
  ADD CONSTRAINT `dospem_ibfk_1` FOREIGN KEY (`pgw_id`) REFERENCES `pegawai` (`pgw_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dospem_ibfk_2` FOREIGN KEY (`mhs_id`) REFERENCES `mahasiswa` (`mhs_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `dospem_ibfk_3` FOREIGN KEY (`tapel_id`) REFERENCES `tapel` (`tapel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `konsentrasi`
--
ALTER TABLE `konsentrasi`
  ADD CONSTRAINT `konsentrasi_ibfk_1` FOREIGN KEY (`jur_id`) REFERENCES `jurusan` (`jur_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`mhs_id`) REFERENCES `mahasiswa` (`mhs_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `laporan_ibfk_2` FOREIGN KEY (`tapel_id`) REFERENCES `tapel` (`tapel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `leveldosen`
--
ALTER TABLE `leveldosen`
  ADD CONSTRAINT `leveldosen_ibfk_1` FOREIGN KEY (`pgw_id`) REFERENCES `pegawai` (`pgw_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `leveldosen_ibfk_2` FOREIGN KEY (`level_id`) REFERENCES `leveluser` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD CONSTRAINT `mahasiswa_ibfk_1` FOREIGN KEY (`jur_id`) REFERENCES `jurusan` (`jur_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_2` FOREIGN KEY (`kon_id`) REFERENCES `konsentrasi` (`kon_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `mahasiswa_ibfk_3` FOREIGN KEY (`level_id`) REFERENCES `leveluser` (`level_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`tema_id`) REFERENCES `tema` (`tema_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_2` FOREIGN KEY (`mhs_id`) REFERENCES `mahasiswa` (`mhs_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pengajuan_ibfk_3` FOREIGN KEY (`tapel_id`) REFERENCES `tapel` (`tapel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesan_dos`
--
ALTER TABLE `pesan_dos`
  ADD CONSTRAINT `pesan_dos_ibfk_1` FOREIGN KEY (`pgw_id`) REFERENCES `pegawai` (`pgw_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesan_dos_ibfk_2` FOREIGN KEY (`mhs_id`) REFERENCES `mahasiswa` (`mhs_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesan_dos_ibfk_3` FOREIGN KEY (`kat_lap_id`) REFERENCES `kategori_laporan` (`kat_lap_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pesan_mhs`
--
ALTER TABLE `pesan_mhs`
  ADD CONSTRAINT `pesan_mhs_ibfk_1` FOREIGN KEY (`mhs_id`) REFERENCES `mahasiswa` (`mhs_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesan_mhs_ibfk_2` FOREIGN KEY (`pgw_id`) REFERENCES `pegawai` (`pgw_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pesan_mhs_ibfk_3` FOREIGN KEY (`kat_lap_id`) REFERENCES `kategori_laporan` (`kat_lap_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sidang`
--
ALTER TABLE `sidang`
  ADD CONSTRAINT `sidang_ibfk_1` FOREIGN KEY (`mhs_id`) REFERENCES `mahasiswa` (`mhs_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sidang_ibfk_2` FOREIGN KEY (`tapel_id`) REFERENCES `tapel` (`tapel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topik_revisi`
--
ALTER TABLE `topik_revisi`
  ADD CONSTRAINT `topik_revisi_ibfk_1` FOREIGN KEY (`mhs_id`) REFERENCES `mahasiswa` (`mhs_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topik_revisi_ibfk_2` FOREIGN KEY (`tapel_id`) REFERENCES `tapel` (`tapel_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
