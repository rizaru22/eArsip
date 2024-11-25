-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25 Nov 2024 pada 05.09
-- Versi Server: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `earsip`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi`
--

CREATE TABLE `disposisi` (
  `iddisposisi` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `pengirim` int(5) NOT NULL,
  `idsuratmasuk` int(5) NOT NULL,
  `indeks` varchar(200) NOT NULL,
  `tingkat` varchar(20) NOT NULL,
  `instruksi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `disposisi`
--

INSERT INTO `disposisi` (`iddisposisi`, `tanggal`, `pengirim`, `idsuratmasuk`, `indeks`, `tingkat`, `instruksi`) VALUES
(1, '2017-12-15', 1, 2, 'Undangan', 'Biasa', 'Undangan SEKDA'),
(2, '2017-12-16', 2, 2, 'Re :Undangan', 'Biasa', 'Re :Undangan SEKDA'),
(3, '2017-12-17', 1, 1, 'Segera', 'Penting', 'Siapa kita kirim pak ?'),
(4, '2017-12-28', 1, 1, 'Tolong ditindak lanjuti', 'Rahasia', 'dfgs'),
(5, '2017-12-28', 1, 2, 'Coba lagi', 'Rahasia', 'Coba Lagi'),
(6, '2017-12-28', 1, 3, 'Coba kita kirim lagi', 'Penting', 'Coba ada enter nya\r\nBegini\r\nNah ada lagi\r\nKita tambah lagi\r\nOk lagi\r\n'),
(7, '2017-12-28', 2, 3, 'Re :Coba kita kirim lagi', 'Penting', 'Re :Coba ada enter nya\r\nBegini\r\nNah ada lagi\r\nKita tambah lagi\r\nOk lagi\r\n'),
(8, '2017-12-28', 2, 1, 'Re :Segera', 'Penting', 'Re :Siapa kita kirim pak ?'),
(9, '2018-01-06', 1, 5, 'fasdf', 'Rahasia', 'asdfad'),
(10, '2018-01-06', 1, 1, 'fhdfgh', 'Rahasia', 'dfgh'),
(11, '2018-01-06', 1, 5, 'rtwer', 'Rahasia', 'wert'),
(12, '2018-01-06', 1, 5, 'dgsd', 'Penting', 'sdfg'),
(13, '2018-01-06', 1, 1, 'dadf', 'Penting', 'asdf'),
(14, '2018-01-06', 1, 1, 'fghjgh', 'Rahasia', 'dfgh'),
(15, '2018-01-06', 1, 3, 'dfgsf', 'Rahasia', 'sfdg'),
(16, '2018-01-06', 1, 2, 'fgsdf', 'Rahasia', 'sdfg'),
(17, '2018-02-05', 1, 3, 'yguyg', 'Rahasia', 'nljhbjh'),
(18, '2023-08-23', 1, 6, '09234', 'Biasa', 'Disposisi'),
(19, '2023-08-23', 2, 3, 'Re :yguyg', 'Rahasia', 'Re :nljhbjh');

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisisk`
--

CREATE TABLE `disposisisk` (
  `id` int(10) NOT NULL,
  `tanggal` date NOT NULL,
  `pengirim` int(5) NOT NULL,
  `idsuratkeluar` int(5) NOT NULL,
  `indeks` varchar(200) NOT NULL,
  `tingkat` varchar(20) NOT NULL,
  `instruksi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `disposisisk`
--

INSERT INTO `disposisisk` (`id`, `tanggal`, `pengirim`, `idsuratkeluar`, `indeks`, `tingkat`, `instruksi`) VALUES
(2, '2017-12-16', 1, 1, 'Penting', 'Rahasia', 'bagaimana Pak kepala ?'),
(3, '2017-12-28', 1, 3, 'Coba kirim Disposisi Surat Keluar ', 'Penting', 'Siapa kita pilih pak ?'),
(4, '2017-12-28', 1, 2, 'Pilih lagi', 'Penting', 'ada'),
(5, '2018-01-06', 1, 3, 'dfasd', 'Penting', 'asdf'),
(6, '2018-01-06', 1, 3, 'ff', 'Rahasia', 'gsdfg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisisk_detail`
--

CREATE TABLE `disposisisk_detail` (
  `id` int(5) NOT NULL,
  `penerima` int(5) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `disposisisk_detail`
--

INSERT INTO `disposisisk_detail` (`id`, `penerima`, `status`) VALUES
(0, 2, 'Terkirim'),
(2, 2, 'Dibaca'),
(3, 2, 'Dibaca'),
(4, 2, 'Terkirim'),
(4, 3, 'Terkirim'),
(4, 4, 'Terkirim'),
(5, 2, 'Terkirim'),
(5, 3, 'Terkirim'),
(6, 3, 'Terkirim'),
(6, 4, 'Terkirim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `disposisi_detail`
--

CREATE TABLE `disposisi_detail` (
  `iddisposisi` int(5) NOT NULL,
  `penerima` int(5) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `disposisi_detail`
--

INSERT INTO `disposisi_detail` (`iddisposisi`, `penerima`, `status`) VALUES
(1, 2, 'Dibaca'),
(2, 3, 'Dibaca'),
(2, 4, 'Dibaca'),
(3, 2, 'Dibaca'),
(4, 3, 'Dibaca'),
(4, 4, 'Terkirim'),
(5, 3, 'Dibaca'),
(6, 2, 'Dibaca'),
(6, 3, 'Terkirim'),
(6, 4, 'Terkirim'),
(7, 1, 'Dibaca'),
(8, 3, 'Terkirim'),
(8, 4, 'Terkirim'),
(9, 2, 'Terkirim'),
(9, 3, 'Terkirim'),
(10, 4, 'Terkirim'),
(10, 5, 'Terkirim'),
(11, 2, 'Terkirim'),
(11, 3, 'Terkirim'),
(12, 3, 'Terkirim'),
(12, 4, 'Terkirim'),
(13, 4, 'Terkirim'),
(13, 5, 'Terkirim'),
(14, 2, 'Terkirim'),
(15, 2, 'Terkirim'),
(16, 4, 'Terkirim'),
(17, 2, 'Dibaca'),
(17, 5, 'Terkirim'),
(18, 2, 'Dibaca'),
(18, 3, 'Terkirim'),
(19, 5, 'Terkirim');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `idjabatan` int(5) NOT NULL,
  `jabatan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`idjabatan`, `jabatan`) VALUES
(1, 'Kepala Puskesmas'),
(2, 'Kasubbag Tata Usaha'),
(4, 'Dokter Gigi'),
(6, 'Bendahara'),
(7, 'Staf SKPM'),
(8, 'Perawat'),
(9, 'Staf TU'),
(10, 'PJ SP2TP'),
(11, 'Bendahara JKN'),
(12, 'Bendahara BOK'),
(13, 'Bendaharawan Barang '),
(14, 'Bidan Desa'),
(15, 'Dokter Poli Umum'),
(16, 'Dokter Poli Usila'),
(17, 'Konseling Pra Nikah '),
(18, 'Koordinator Bidan'),
(19, 'Pengelola JKN'),
(20, 'Petugas Jaga Malam'),
(21, 'Petugas Keamanan'),
(22, 'Petugas Kebersihan '),
(23, 'Petugas Kebersihan '),
(24, 'PJ  ISPA '),
(25, 'PJ  Surveilans'),
(26, 'PJ Apotik'),
(27, 'PJ DBD'),
(28, 'PJ Diare '),
(29, 'PJ Gizi'),
(30, 'PJ IGD'),
(31, 'PJ Imunisasi'),
(32, 'PJ Kartu'),
(33, 'PJ Kesehatan Jiwa'),
(34, 'PJ Kesling'),
(35, 'PJ KIA'),
(36, 'PJ Laboraturium'),
(37, 'PJ Malaria'),
(38, 'PJ MTBS'),
(39, 'PJ Poli KIA'),
(40, 'PJ Promkes     '),
(41, 'PJ TB Paru/Kusta'),
(42, 'PJ UKS'),
(43, 'Receptionist'),
(44, 'SIKDA'),
(45, 'Staf Apotik'),
(46, 'Staf Apotik'),
(47, 'Staf Gizi'),
(48, 'Staf IGD'),
(49, 'Staf Imunisasi'),
(50, 'Staf Kartu'),
(51, 'Staf KB'),
(52, 'Staf Kesehatan Jiwa'),
(53, 'Staf KIA'),
(54, 'Staf KIA'),
(55, 'Staf Laboraturium'),
(56, 'Staf MTBS'),
(57, 'Staf Poli Umum'),
(58, 'Staf Poli Usila'),
(59, 'Staf Poli Usila'),
(60, 'Staf Program Usila'),
(61, 'Staf Promkes'),
(62, 'Staf Rujukan'),
(63, 'Supir Ambulance');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kepegawaian`
--

CREATE TABLE `kepegawaian` (
  `id` int(5) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `nip` varchar(25) NOT NULL,
  `pangkat` int(3) NOT NULL,
  `jabatan` int(5) NOT NULL,
  `idpegawai` int(5) NOT NULL,
  `ttd` enum('Tidak','Ya') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kepegawaian`
--

INSERT INTO `kepegawaian` (`id`, `nama`, `nip`, `pangkat`, `jabatan`, `idpegawai`, `ttd`) VALUES
(1, 'Irwanudin, SKM', '19690206 199203 1 003', 13, 1, 2, 'Ya'),
(2, 'Sari Indah Fithriany SA, SKM', '19780830 200904 2 001', 10, 2, 1, 'Ya'),
(3, 'dr. Zuheni, M.Kes', '19680314 200003 2 004', 14, 15, 3, 'Ya'),
(4, 'dr. Maryan Suhadi, M.Kes', '19660904 199801 1 004', 14, 16, 4, 'Ya'),
(5, 'Buchari Muslim, SKM', '19651231 198812 1 006', 13, 8, 0, 'Tidak'),
(6, 'Rajinah ', '196605021989012000', 12, 8, 0, 'Tidak'),
(7, 'Zuraida, AMK', '196910051991012000', 12, 8, 0, 'Tidak'),
(8, 'Nuraini Lubis, A.Md.Keb', '197401141993032000', 12, 8, 0, 'Tidak'),
(9, 'Masliana, A.Md.Keb', '197204141992032000', 12, 8, 0, 'Tidak'),
(10, 'Sri Sundari ', '19720705199402002', 12, 8, 0, 'Tidak'),
(11, 'Ns. Yatimin, S.Kep ', '197505251997031000', 12, 8, 0, 'Tidak'),
(12, 'Yunus, AMK', '197303051994031000', 11, 8, 0, 'Tidak'),
(13, 'Rini Novita, Apt, S.Farm', '19821106 2011032001', 11, 8, 0, 'Tidak'),
(14, 'Endang SriJuarni, A.Md.Keb', '197011171990032000', 11, 8, 0, 'Tidak'),
(15, 'Israwati, AMKL', '198004012005042000', 11, 8, 0, 'Tidak'),
(16, 'Nurhafizah, A. Md.Kep', '198303102006042000', 11, 8, 0, 'Tidak'),
(17, 'Syamsuddin', '196101201983031000', 10, 8, 0, 'Tidak'),
(18, 'Umi Salamah', '197308301993022000', 10, 8, 0, 'Tidak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kirsehat`
--

CREATE TABLE `kirsehat` (
  `id` int(5) NOT NULL,
  `nosurat` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `pekerjaan` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `berat_badan` int(4) NOT NULL,
  `golongan_darah` enum('A','AB','B','O') NOT NULL,
  `tinggi_badan` int(4) NOT NULL,
  `buta_warna` enum('Normal','Parsial','Buta') NOT NULL,
  `keterangan` enum('Y','T') NOT NULL,
  `keperluan` text NOT NULL,
  `tanggal` date NOT NULL,
  `dokter` int(3) NOT NULL,
  `pegawai_tu` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kirsehat`
--

INSERT INTO `kirsehat` (`id`, `nosurat`, `nama`, `tempat_lahir`, `tanggal_lahir`, `pekerjaan`, `alamat`, `berat_badan`, `golongan_darah`, `tinggi_badan`, `buta_warna`, `keterangan`, `keperluan`, `tanggal`, `dokter`, `pegawai_tu`) VALUES
(1, '440/124/2017', 'Safrizal', 'Bendahara', '2017-12-30', 'PNS', 'Desa Simpang Empat\r\nKec. Karang Baru\r\nKab. Aceh Tamiang', 48, 'B', 163, 'Buta', 'Y', 'PPG', '2018-01-30', 4, 1),
(2, '440/125/2017', 'Siswa 1', 'Kualasimpang', '2017-12-24', 'Pelajar', 'Desa Simpang Empat\r\nKec. Karang Baru\r\nKab. Aceh Tamiang', 40, 'AB', 150, '', 'T', 'Melanjutkan pendidikan', '2017-12-27', 3, 1),
(3, '440/001/2018', 'we', 'asdf', '2018-01-25', 'asdf', 'asdf', 34, 'AB', 34, 'Normal', 'Y', 'ertwe', '2018-01-06', 3, 1),
(4, '440/002/2018', 'Jono', 'Bendahara', '1990-02-06', 'Mahasiswa', 'sadfasd\r\nasdfa\r\nasdfa', 67, 'AB', 167, 'Normal', 'Y', 'Tes CPNS', '2018-01-06', 3, 1),
(5, '440/004/2018', 'dfgdfgj', 'gdfgd dfgd', '2010-01-04', 'dfgh', 'dfghdfg', 56, 'B', 56, 'Normal', 'Y', 'dfhdfg', '2018-01-06', 3, 1),
(6, '440/006/2018', 'Feri', 'Aceh Tamiang', '1994-06-14', 'Pelajar', 'Karang Baru', 53, 'O', 165, 'Normal', 'T', 'Melanjutkan Pendidikan', '2018-02-05', 3, 1),
(7, '440/007/2018', 'qwer', 'retwe', '2015-06-23', 'wer', 'sdgs', 56, 'A', 6, 'Normal', 'Y', 'ugu', '2018-03-27', 3, 1),
(8, '1639/009/2018', 'SAFRIZAL, S.ST', 'Bendahara', '1987-05-30', 'Pegawai Negeri Sipil', 'Desa Simpang Empat, Kec. Karang Baru', 50, 'B', 163, 'Normal', 'Y', 'Lapor Diri PPGJ pada Universitas Negeri Yogyakarta', '2020-05-29', 3, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pangkat`
--

CREATE TABLE `pangkat` (
  `idpangkat` int(3) NOT NULL,
  `pangkat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pangkat`
--

INSERT INTO `pangkat` (`idpangkat`, `pangkat`) VALUES
(1, 'Juru Muda / I-a'),
(2, 'Juru Muda Tk.1 / I-b '),
(3, 'Juru / I-c '),
(4, 'Juru Tk.1 / I-d'),
(5, ' Pengatur Muda / II-a'),
(6, ' Pengatur Muda Tk.1 / II-b'),
(7, ' Pengatur /  II-c'),
(8, 'Pengatur Tk.1 /  II-d'),
(9, 'Penata Muda /  III-a'),
(10, 'Penata Muda Tk.1 /  III-b'),
(11, ' Penata /  III-c'),
(12, 'Penata Tk.1 /  III-d'),
(13, 'Pembina /  IV-a  '),
(14, 'Pembina Tk.1 /  IV-b '),
(15, 'Pembina Utama Muda /  IV-c '),
(16, 'Pembina Utama Madya /  IV-d  '),
(17, 'Pembina Utama /  IV-e  ');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `idpegawai` int(5) NOT NULL,
  `jabatan` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(30) NOT NULL,
  `status` enum('Y','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`idpegawai`, `jabatan`, `username`, `password`, `level`, `status`) VALUES
(2, 'Kepala Sekolah', 'kepsek', '8561863b55faf85b9ad67c52b3b851ac', 'Pengguna', 'Y'),
(7, 'Super Admin', 'superadmin', '202cb962ac59075b964b07152d234b70', 'Administrator', 'Y');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suratkeluar`
--

CREATE TABLE `suratkeluar` (
  `idsuratkeluar` int(5) NOT NULL,
  `nosurat` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `tujuan` varchar(50) NOT NULL,
  `perihal` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `filesurat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suratkeluar`
--

INSERT INTO `suratkeluar` (`idsuratkeluar`, `nosurat`, `tanggal`, `tujuan`, `perihal`, `keterangan`, `filesurat`) VALUES
(1, '440/2819/2017', '2017-10-19', 'Direktur RSUD Aceh Tamiang', 'Permintaan Data Kematian', 'Kasus kematiah Ny. Alina Desa Tanah Terban', '1513440239.jpg'),
(2, '440/2890/2017', '2017-10-30', 'Kepala Dinas Kesehatan Aceh Tamiang', 'Calon Tenaga Kesehatan Teladan', '', '1514477308.jpg'),
(3, '440/2810/2017', '2017-10-17', 'Kepala Dinas Informatika dan Persandian', 'Nama operator admin email', '', '1514477285.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suratmasuk`
--

CREATE TABLE `suratmasuk` (
  `idSuratMasuk` int(5) NOT NULL,
  `noAgenda` varchar(25) NOT NULL,
  `noSurat` varchar(25) NOT NULL,
  `tanggalSurat` date NOT NULL,
  `tanggalTerima` date NOT NULL,
  `sumber` varchar(30) NOT NULL,
  `tujuan` varchar(30) NOT NULL,
  `perihal` text NOT NULL,
  `keterangan` text NOT NULL,
  `fileSurat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suratmasuk`
--

INSERT INTO `suratmasuk` (`idSuratMasuk`, `noAgenda`, `noSurat`, `tanggalSurat`, `tanggalTerima`, `sumber`, `tujuan`, `perihal`, `keterangan`, `fileSurat`) VALUES
(6, '0034', '0098/123/ASN', '2023-08-21', '2023-08-23', 'Bupati Aceh Tamiang', 'Kepala SMKN 1 Karang Baru', 'Kegiatan Maulid Nabi', 'asdasdasdasdasdad', '1692766027.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `suratperintahtugas`
--

CREATE TABLE `suratperintahtugas` (
  `id` int(5) NOT NULL,
  `nosurat` varchar(30) NOT NULL,
  `tugas` varchar(200) NOT NULL,
  `tanggal_pelaksanaan` date NOT NULL,
  `lama_tugas` varchar(30) NOT NULL,
  `tempat` varchar(50) NOT NULL,
  `pembebanan_biaya` text NOT NULL,
  `tanggal_ttd` date NOT NULL,
  `pejabat_ttd` int(5) NOT NULL,
  `pegawai_tu` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suratperintahtugas`
--

INSERT INTO `suratperintahtugas` (`id`, `nosurat`, `tugas`, `tanggal_pelaksanaan`, `lama_tugas`, `tempat`, `pembebanan_biaya`, `tanggal_ttd`, `pejabat_ttd`, `pegawai_tu`) VALUES
(1, '001/800/2017', 'we', '2017-12-08', 'we', 'we', 'we', '2017-12-01', 1, 1),
(3, '003/800/2017', 'Mengantar Jenazah Tabrak Lari', '2017-12-08', '3 hari 3 malam', 'Kualasimpang', 'DPA SKPD Dinas Kesehatan Kabupaten Aceh Tamiang TA 2017\r\nNo DPA : 1.02.01.28.23.5.2\r\nNo Rek : 5.2.2.15.01', '2017-12-08', 1, 1),
(5, '004/800/2017', 'Suka hati', '2017-12-25', '1 hari', 'Langsa', 'DPA\r\nDPR\r\nMPR', '2017-12-25', 1, 1),
(8, '005/800/2017', 'dfa', '2017-12-30', '1 hari', 'fasd', 'adsf', '2017-12-30', 1, 1),
(9, '006/800/2017', 'Menyerahkan Laporan', '2017-12-31', '1 hari', 'BPJS Langsa', 'DPA\r\nN.Reg\r\nNo. Rek', '2017-12-31', 2, 1),
(10, '001/800/2018', 'dfgsdf', '2018-01-31', 's', 'fg', 'gsf', '2018-01-31', 1, 1),
(11, '002/800/2018', 'gh', '2018-01-29', 'sdfg', 'jfghjf', 'fhj', '2018-01-23', 1, 1),
(12, '003/800/2018', 'dggwert', '2018-01-31', 'ety', 'yet', 'ety', '2018-01-30', 1, 1),
(13, '004/800/2018', 'sfdg', '2018-01-13', 'ghdfg', 'dgh', 'dgh', '2018-01-13', 1, 1),
(14, '005/800/2018', 'kghkfg', '2018-01-31', 'fghj', 'fghj', 'fghj', '2018-01-30', 1, 1),
(15, '006/800/2018', 'hdfgh', '2018-01-04', 'dgh', 'dfgh', 'dfghd\r\ndfgh\r\ndgh\r\ndgf', '2018-02-01', 1, 1),
(16, '007/800/2018', 'dfgsdf', '2018-01-30', 'fgsdf sfdgs sdfg', 'dfgs', 'fgsdfg', '2018-01-06', 1, 1),
(17, '008/800/2018', 'sadf', '2018-01-30', 'sdfg', 'asdf', 'asdf', '2018-01-29', 1, 1),
(18, '001/800/2020', 'fasdf', '2020-01-08', '3', 'Bendahara', 'as', '2020-01-08', 1, 1),
(19, '001/800/2023', 'dfgsdfg', '2023-01-05', '3', 'asdfad', 'sdfasdf', '2023-01-09', 1, 1),
(20, '002/800/2023', 'Jemput anak presiden', '2023-01-07', '3', 'Jakarta', 'APBN', '2023-01-05', 1, 1),
(21, '003/800/2023', 'Jemput anak presiden', '2023-08-02', '3', 'Banda Aceh', 'Sekolah', '2023-08-25', 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `suratperintahtugas_detail`
--

CREATE TABLE `suratperintahtugas_detail` (
  `id` int(5) NOT NULL,
  `idkepegawaian` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suratperintahtugas_detail`
--

INSERT INTO `suratperintahtugas_detail` (`id`, `idkepegawaian`) VALUES
(1, 4),
(1, 8),
(1, 7),
(5, 1),
(5, 5),
(7, 1),
(7, 5),
(8, 4),
(3, 5),
(3, 13),
(3, 12),
(9, 10),
(9, 9),
(11, 4),
(11, 1),
(12, 11),
(12, 10),
(10, 4),
(10, 1),
(13, 9),
(13, 8),
(14, 5),
(14, 11),
(15, 1),
(15, 5),
(16, 12),
(16, 2),
(17, 4),
(18, 1),
(18, 5),
(19, 6),
(20, 6),
(20, 16),
(21, 1),
(21, 14);

-- --------------------------------------------------------

--
-- Struktur dari tabel `suratumum`
--

CREATE TABLE `suratumum` (
  `id` int(5) NOT NULL,
  `nosurat` varchar(30) NOT NULL,
  `lampiran` varchar(30) NOT NULL,
  `perihal` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `tujuan` varchar(100) NOT NULL,
  `tempat` varchar(25) NOT NULL,
  `isi` text NOT NULL,
  `pejabat_ttd` int(4) NOT NULL,
  `tembusan` text NOT NULL,
  `pegawai_tu` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `suratumum`
--

INSERT INTO `suratumum` (`id`, `nosurat`, `lampiran`, `perihal`, `tanggal`, `tujuan`, `tempat`, `isi`, `pejabat_ttd`, `tembusan`, `pegawai_tu`) VALUES
(1, '440/126/2017', '-23', 'Laporan Kunjungan dan Rujukan Bulan Pelayanan Mei ', '2017-12-07', 'Kepala Cabang BPJS Cabang Langsa', 'Langsa', '<p>Bersama dengan ini kami kirimkan Laporan Kunjungan dan Rujukan Pelayanan Bulan Mei 2017 Puskesmas Karang Baru sebagaimana terlampir, dengan perincian sebagai berikut :</p>\r\n<p>&nbsp;</p>\r\n<table style="height: 75px; width: 401px; margin-left: auto; margin-right: auto;" border="1" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="height: 16px;">\r\n<td style="width: 80px; height: 48px; text-align: center;" rowspan="3"><br />No<br /><br /></td>\r\n<td style="width: 295px; height: 16px; text-align: center;" colspan="3">Pelayanan</td>\r\n</tr>\r\n<tr style="height: 16px;">\r\n<td style="width: 80px; height: 32px; text-align: center;" rowspan="2">Kunjungan</td>\r\n<td style="width: 215px; height: 16px; text-align: center;" colspan="2">Rujukan</td>\r\n</tr>\r\n<tr style="height: 16px;">\r\n<td style="width: 80px; height: 16px; text-align: center;">Ambulance</td>\r\n<td style="width: 135px; height: 16px; text-align: center;">Non Ambulance</td>\r\n</tr>\r\n<tr style="height: 17px;">\r\n<td style="width: 80px; height: 17px; text-align: center;">1</td>\r\n<td style="width: 80px; height: 17px; text-align: center;">&nbsp;5590</td>\r\n<td style="width: 80px; height: 17px; text-align: center;">20</td>\r\n<td style="width: 135px; height: 17px; text-align: center;">&nbsp;2000</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="text-align: left;"><br />Demikianlah yang dapat kami laporkan, atas perhatian dan kerjasama yang baik kami ucapkan terima kasih.</p>\r\n<p style="text-align: left;">bla bla bla</p>', 1, '<ol>\r\n<li>Kepala Dinas Kesehatan Kabupaten Aceh Tamiang di Karang Baru</li>\r\n<li>Kepala Dinas Ketenaga Kerjaan</li>\r\n</ol>', 1),
(2, '440/127/2017', '-', 'Permohonan Papan Bunga', '2017-12-11', '..............................', 'Karang Baru', '<p>Dengan Hormat</p>\r\n<p style="text-align: justify;">&nbsp; &nbsp; &nbsp;Sehubungan dengan akan dilaksanakannya penilaian Akreditasi FKTP di Puskesmas Karang Baru yang dilaksanakan pada :</p>\r\n<p>&nbsp;</p>\r\n<table style="height: 84px; width: 370px;">\r\n<tbody>\r\n<tr style="height: 23px;">\r\n<td style="width: 95px; height: 23px;">Hari / Tanggal</td>\r\n<td style="width: 10px; height: 23px;">:</td>\r\n<td style="width: 247px; height: 23px;">Kamis / 3 Agustus 2017</td>\r\n</tr>\r\n<tr style="height: 24px;">\r\n<td style="width: 95px; height: 24px;">Tempat</td>\r\n<td style="width: 10px; height: 24px;">:</td>\r\n<td style="width: 247px; height: 24px;">Puskesmas Karang Baru</td>\r\n</tr>\r\n<tr style="height: 24px;">\r\n<td style="width: 95px; height: 24px;">Waktu&nbsp; &nbsp;</td>\r\n<td style="width: 10px; height: 24px;">:</td>\r\n<td style="width: 247px; height: 24px;">&nbsp;08.00 Wib s/d selesai</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p><br />&nbsp;</p>\r\n<p style="text-align: justify;">&nbsp; &nbsp; Sehubungan dengan rencana tersebut diatas, kami memohon kesediaan Bapak untuk dapat mengirimkan karangan bunga ucapan selamat atas penilaian Akreditasi tersebut dengan format:</p>\r\n<p style="text-align: center;">&nbsp;</p>\r\n<p style="text-align: center;"><strong>&ldquo; SELAMAT DAN SUKSES ATAS PENILAIAN AKREDITASI PUSKESMAS KARANG BARU&ldquo;</strong></p>\r\n<p>&nbsp;</p>\r\n<p>Demikian &nbsp;Permohonan kami, &nbsp;atas perhatian dan kerjasama yang baik kami ucapkan terima kasih.</p>', 1, '', 1),
(3, '440/2891/2017', '-', 'Laporan Kunjungan dan Rujukan Bulan Pelayanan Mei ', '2017-12-10', 'Kepala Cabang BPJS Cabang Langsa', 'Langsa', '<p>Bersama dengan ini kami kirimkan Laporan Kunjungan dan Rujukan Pelayanan Bulan Mei 2017 Puskesmas Karang Baru sebagaimana terlampir, dengan perincian sebagai berikut :</p>\r\n<p>&nbsp;</p>\r\n<table style="height: 74px; width: 468px; margin-left: auto; margin-right: auto;" border="1" cellspacing="0" cellpadding="0">\r\n<tbody>\r\n<tr style="height: 16px;">\r\n<td style="width: 35px; height: 42px; text-align: center;" rowspan="3"><br />NO</td>\r\n<td style="width: 437px; height: 16px; text-align: center;" colspan="3">&nbsp;Pelayanan</td>\r\n</tr>\r\n<tr style="height: 13px;">\r\n<td style="width: 148px; height: 26px; text-align: center;" rowspan="2">&nbsp;Kunjungan</td>\r\n<td style="width: 289px; height: 13px; text-align: center;" colspan="2">&nbsp;Rujukan</td>\r\n</tr>\r\n<tr style="height: 13px;">\r\n<td style="width: 125px; height: 13px; text-align: center;">&nbsp;Ambulance</td>\r\n<td style="width: 164px; height: 13px; text-align: center;">&nbsp;Non Ambulance</td>\r\n</tr>\r\n<tr style="height: 11px;">\r\n<td style="width: 35px; height: 11px; text-align: center;">&nbsp;1</td>\r\n<td style="width: 148px; height: 11px; text-align: center;">&nbsp;5574</td>\r\n<td style="width: 125px; height: 11px; text-align: center;">&nbsp;-</td>\r\n<td style="width: 164px; height: 11px; text-align: center;">&nbsp;393</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p style="text-align: left;">&nbsp;</p>\r\n<p style="text-align: left;"><span style="font-size: 18pt; font-family: impact, sans-serif;">Demikianlah yang dapat kami laporkan, atas perhatian dan kerjasama yang baik kami ucapkan terima kasih.</span></p>', 2, '', 1),
(4, '440/003/2018', '-', 'fghdfh dhdg dgh ', '2018-01-25', 'dfgh dhdfg', 'dfghdfghdfghdfg', '<p>dfghdfghdgh</p>\r\n<p>dfghdgh</p>\r\n<p>dfghdgh</p>\r\n<p>dfghdfg</p>\r\n<p>dfghdfgh</p>\r\n<p>dfghdfghdfghdfghdfghdfgh&nbsp;</p>', 1, '<p>dfghdfg dfghd dfghd</p>\r\n<p>d hdfgh</p>', 1),
(5, '440/005/2018', 'uityu', 'tyui', '2018-01-06', 'tyuit', 'utyui', '<p>tyui</p>', 1, '<p>yuityui</p>', 1),
(6, '440/008/2018', 'asdf', 'asd', '2018-03-19', 'sfdg', 'sdfgsdf', '<p>sdfsdfhsdfh</p>', 3, '<p>sdfasdfasd</p>', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disposisi`
--
ALTER TABLE `disposisi`
  ADD PRIMARY KEY (`iddisposisi`);

--
-- Indexes for table `disposisisk`
--
ALTER TABLE `disposisisk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`idjabatan`);

--
-- Indexes for table `kepegawaian`
--
ALTER TABLE `kepegawaian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kirsehat`
--
ALTER TABLE `kirsehat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pangkat`
--
ALTER TABLE `pangkat`
  ADD PRIMARY KEY (`idpangkat`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`idpegawai`);

--
-- Indexes for table `suratkeluar`
--
ALTER TABLE `suratkeluar`
  ADD PRIMARY KEY (`idsuratkeluar`);

--
-- Indexes for table `suratmasuk`
--
ALTER TABLE `suratmasuk`
  ADD PRIMARY KEY (`idSuratMasuk`);

--
-- Indexes for table `suratperintahtugas`
--
ALTER TABLE `suratperintahtugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suratumum`
--
ALTER TABLE `suratumum`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disposisi`
--
ALTER TABLE `disposisi`
  MODIFY `iddisposisi` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `disposisisk`
--
ALTER TABLE `disposisisk`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `idjabatan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `kepegawaian`
--
ALTER TABLE `kepegawaian`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `kirsehat`
--
ALTER TABLE `kirsehat`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `pangkat`
--
ALTER TABLE `pangkat`
  MODIFY `idpangkat` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `idpegawai` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `suratkeluar`
--
ALTER TABLE `suratkeluar`
  MODIFY `idsuratkeluar` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `suratmasuk`
--
ALTER TABLE `suratmasuk`
  MODIFY `idSuratMasuk` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `suratperintahtugas`
--
ALTER TABLE `suratperintahtugas`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `suratumum`
--
ALTER TABLE `suratumum`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
