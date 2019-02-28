-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 09 Sep 2016 pada 23.07
-- Versi Server: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `warehouse`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_barang`
--

CREATE TABLE IF NOT EXISTS `m_barang` (
`id_barang` int(11) NOT NULL,
  `nama_barang` varchar(30) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data untuk tabel `m_barang`
--

INSERT INTO `m_barang` (`id_barang`, `nama_barang`) VALUES
(9, 'Minyak tanah'),
(10, 'Minyak goreng'),
(11, 'Beras'),
(12, 'Drill'),
(13, 'Gula'),
(14, 'Test');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_kelas`
--

CREATE TABLE IF NOT EXISTS `m_kelas` (
`id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(2) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `m_kelas`
--

INSERT INTO `m_kelas` (`id_kelas`, `nama_kelas`) VALUES
(7, 'C'),
(8, 'B');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_owner`
--

CREATE TABLE IF NOT EXISTS `m_owner` (
`id_owner` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `perusahaan` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `m_owner`
--

INSERT INTO `m_owner` (`id_owner`, `nama`, `perusahaan`) VALUES
(1, 'Malik', 'FOUNDER ISLAMIC PROG');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_satuan`
--

CREATE TABLE IF NOT EXISTS `m_satuan` (
`id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(4) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data untuk tabel `m_satuan`
--

INSERT INTO `m_satuan` (`id_satuan`, `nama_satuan`) VALUES
(6, 'l'),
(7, 'kg'),
(8, 'gr');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_user`
--

CREATE TABLE IF NOT EXISTS `m_user` (
`id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `lvl` enum('admin','user') NOT NULL,
  `fullname` text NOT NULL,
  `ket` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data untuk tabel `m_user`
--

INSERT INTO `m_user` (`id`, `username`, `password`, `lvl`, `fullname`, `ket`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'Administrator', 'Since 2016');

-- --------------------------------------------------------

--
-- Struktur dari tabel `paket_barang`
--

CREATE TABLE IF NOT EXISTS `paket_barang` (
  `kode_paket` varchar(50) NOT NULL,
  `nama_paket` text NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `nom_satuan` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `paket_barang`
--

INSERT INTO `paket_barang` (`kode_paket`, `nama_paket`, `id_barang`, `id_kelas`, `id_satuan`, `nom_satuan`) VALUES
('9/7/20/7', 'Minyak tanah/C/20/kg', 9, 7, 7, '20'),
('9/7/23/7', 'Minyak tanah/C/23/kg', 9, 7, 7, '23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_barang`
--

CREATE TABLE IF NOT EXISTS `stok_barang` (
`id_stok_barang` int(11) NOT NULL,
  `kode_paket` varchar(50) NOT NULL,
  `jml` text NOT NULL,
  `id_owner` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data untuk tabel `stok_barang`
--

INSERT INTO `stok_barang` (`id_stok_barang`, `kode_paket`, `jml`, `id_owner`) VALUES
(9, '9/7/20/7', '336', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_barang_keluar`
--

CREATE TABLE IF NOT EXISTS `t_barang_keluar` (
`id_barang_keluar` int(11) NOT NULL,
  `kode_paket` text NOT NULL,
  `jml_awal` text NOT NULL,
  `jml_out` text NOT NULL,
  `jml_now` text NOT NULL,
  `outputdate` text NOT NULL,
  `outputtime` text NOT NULL,
  `outputby` varchar(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data untuk tabel `t_barang_keluar`
--

INSERT INTO `t_barang_keluar` (`id_barang_keluar`, `kode_paket`, `jml_awal`, `jml_out`, `jml_now`, `outputdate`, `outputtime`, `outputby`) VALUES
(5, '9/7/20/7', '290', '100', '190', '1470416400', '1470474669', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `t_barang_masuk`
--

CREATE TABLE IF NOT EXISTS `t_barang_masuk` (
`id_barang_masuk` int(11) NOT NULL,
  `kode_paket` text NOT NULL,
  `jml_awal` text NOT NULL,
  `jml_in` text,
  `jml_now` text NOT NULL,
  `inputdate` text,
  `inputtime` text,
  `inputby` varchar(5) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data untuk tabel `t_barang_masuk`
--

INSERT INTO `t_barang_masuk` (`id_barang_masuk`, `kode_paket`, `jml_awal`, `jml_in`, `jml_now`, `inputdate`, `inputtime`, `inputby`) VALUES
(18, '9/7/20/7', '0', '100', '100', '1470243600', '1470317873', '1'),
(19, '9/7/20/7', '100', '90', '190', '1470330000', '1470334613', '1'),
(20, '9/7/20/7', '190', '100', '290', '1470416400', '1470474653', '1'),
(21, '9/7/20/7', '190', '90', '280', '1471194000', '1471229096', '1'),
(22, '9/7/20/7', '280', '23', '303', '1471885200', '1471917021', '1'),
(23, '9/7/20/7', '303', '33', '336', '1471885200', '1471917041', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_barang`
--
ALTER TABLE `m_barang`
 ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `m_kelas`
--
ALTER TABLE `m_kelas`
 ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `m_owner`
--
ALTER TABLE `m_owner`
 ADD PRIMARY KEY (`id_owner`);

--
-- Indexes for table `m_satuan`
--
ALTER TABLE `m_satuan`
 ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `m_user`
--
ALTER TABLE `m_user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket_barang`
--
ALTER TABLE `paket_barang`
 ADD PRIMARY KEY (`kode_paket`);

--
-- Indexes for table `stok_barang`
--
ALTER TABLE `stok_barang`
 ADD PRIMARY KEY (`id_stok_barang`);

--
-- Indexes for table `t_barang_keluar`
--
ALTER TABLE `t_barang_keluar`
 ADD PRIMARY KEY (`id_barang_keluar`);

--
-- Indexes for table `t_barang_masuk`
--
ALTER TABLE `t_barang_masuk`
 ADD PRIMARY KEY (`id_barang_masuk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_barang`
--
ALTER TABLE `m_barang`
MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `m_kelas`
--
ALTER TABLE `m_kelas`
MODIFY `id_kelas` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `m_owner`
--
ALTER TABLE `m_owner`
MODIFY `id_owner` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `m_satuan`
--
ALTER TABLE `m_satuan`
MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `m_user`
--
ALTER TABLE `m_user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stok_barang`
--
ALTER TABLE `stok_barang`
MODIFY `id_stok_barang` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `t_barang_keluar`
--
ALTER TABLE `t_barang_keluar`
MODIFY `id_barang_keluar` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `t_barang_masuk`
--
ALTER TABLE `t_barang_masuk`
MODIFY `id_barang_masuk` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
