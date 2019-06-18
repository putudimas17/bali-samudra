-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Jun 2019 pada 14.58
-- Versi server: 10.1.31-MariaDB
-- Versi PHP: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bali_samudra`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_agent_tiket`
--

CREATE TABLE `tb_agent_tiket` (
  `id_agent_tiket` int(10) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `no_telp` int(15) NOT NULL,
  `nama` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_pembelian`
--

CREATE TABLE `tb_detail_pembelian` (
  `id_detail_pem` int(11) NOT NULL,
  `id_pembelian` varchar(20) NOT NULL,
  `kode_brg` varchar(20) NOT NULL,
  `jumlah` int(15) NOT NULL,
  `harga` int(15) NOT NULL,
  `total` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_penjualan`
--

CREATE TABLE `tb_detail_penjualan` (
  `id_detail_pen` int(15) NOT NULL,
  `id_penjualan` varchar(20) DEFAULT NULL,
  `kode_brg` varchar(20) DEFAULT NULL,
  `harga` int(15) DEFAULT NULL,
  `jumlah` int(15) DEFAULT NULL,
  `subtotal` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(10) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'wisata lovina '),
(2, 'wisata lempuyang'),
(3, 'wisata ubud'),
(4, 'wisata kintamani');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembelian`
--

CREATE TABLE `tb_pembelian` (
  `id_pembelian` int(10) NOT NULL,
  `id_supel` int(10) NOT NULL,
  `tgl` date NOT NULL,
  `total` int(10) NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `INV` varchar(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `no_referensi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_penjualan`
--

CREATE TABLE `tb_penjualan` (
  `id_penjualan` int(11) NOT NULL,
  `INV` varchar(255) NOT NULL,
  `tgl` datetime NOT NULL,
  `total` int(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_penjualan`
--

INSERT INTO `tb_penjualan` (`id_penjualan`, `INV`, `tgl`, `total`, `id_user`, `status`, `bayar`, `kembali`) VALUES
(1, 'TRX-0000001', '2018-11-23 09:15:34', 0, 8, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_supel`
--

CREATE TABLE `tb_supel` (
  `id_supel` int(10) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Alamat` text NOT NULL,
  `No_tlp` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tiket`
--

CREATE TABLE `tb_tiket` (
  `Kode_tiket` varchar(15) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `Nama_tiket` varchar(30) NOT NULL,
  `Harga_jual` int(10) NOT NULL,
  `Harga_beli` int(10) NOT NULL,
  `Satuan` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(10) NOT NULL,
  `Nama` varchar(50) NOT NULL,
  `Username` varchar(30) DEFAULT NULL,
  `Password` varchar(30) DEFAULT NULL,
  `Level` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `Nama`, `Username`, `Password`, `Level`) VALUES
(1, 'Wijaya', 'admin', 'admin', 'admin'),
(8, 'Putu dimas', 'Karyawan', 'karyawan', 'karyawan'),
(9, 'Awen yui', 'owner', 'owner', 'owner');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_agent_tiket`
--
ALTER TABLE `tb_agent_tiket`
  ADD PRIMARY KEY (`id_agent_tiket`);

--
-- Indeks untuk tabel `tb_detail_pembelian`
--
ALTER TABLE `tb_detail_pembelian`
  ADD PRIMARY KEY (`id_detail_pem`);

--
-- Indeks untuk tabel `tb_detail_penjualan`
--
ALTER TABLE `tb_detail_penjualan`
  ADD PRIMARY KEY (`id_detail_pen`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  ADD PRIMARY KEY (`id_pembelian`);

--
-- Indeks untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `tb_supel`
--
ALTER TABLE `tb_supel`
  ADD PRIMARY KEY (`id_supel`);

--
-- Indeks untuk tabel `tb_tiket`
--
ALTER TABLE `tb_tiket`
  ADD PRIMARY KEY (`Kode_tiket`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_detail_pembelian`
--
ALTER TABLE `tb_detail_pembelian`
  MODIFY `id_detail_pem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_penjualan`
--
ALTER TABLE `tb_detail_penjualan`
  MODIFY `id_detail_pen` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kategori` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_pembelian`
--
ALTER TABLE `tb_pembelian`
  MODIFY `id_pembelian` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_penjualan`
--
ALTER TABLE `tb_penjualan`
  MODIFY `id_penjualan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_supel`
--
ALTER TABLE `tb_supel`
  MODIFY `id_supel` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
