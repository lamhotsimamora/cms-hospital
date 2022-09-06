-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Sep 2022 pada 16.39
-- Versi server: 10.4.21-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_cms_hospital`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id_admin`, `username`, `password`, `token`) VALUES
(1, 'admin', '32f6fdffe48c908deb0f4c3bd36c032e7232', '2hz6j7jzbkxhkg9wtx4rpt1ng');

-- --------------------------------------------------------

--
-- Struktur dari tabel `docters`
--

CREATE TABLE `docters` (
  `id_docter` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_spesialis` int(11) NOT NULL,
  `ket` varchar(255) DEFAULT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `docters`
--

INSERT INTO `docters` (`id_docter`, `nama`, `id_spesialis`, `ket`, `foto`) VALUES
(12, 'Richard Lee', 2, '-', 'j4ophz6tk0m1nawt6x6moeui6-5rao04rqxdtvnfvecd204h4hi.jpeg'),
(13, 'John Doe', 2, '-', 'y2t4h5xuwxih9g4bydwvvrntn-87iff2hto0ehhynfokrz0q67v.jpg'),
(14, 'Johnson', 2, '-', '7i1qxpq1ckos4t0xmxs4hvjxu-ko7ttk4mewu1p911k2obt3rrm.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `id_feedback` int(11) NOT NULL,
  `rating` int(5) NOT NULL COMMENT '1=Sangat Baik\r\n2=Baik\r\n3=Kurang Baik\r\n4=Sangat Buruk\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`id_feedback`, `rating`) VALUES
(1, 3),
(2, 3),
(3, 1),
(4, 2),
(5, 4),
(6, 2),
(7, 4),
(8, 4),
(9, 1),
(10, 1),
(11, 3),
(12, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `footer`
--

CREATE TABLE `footer` (
  `id_footer` int(11) NOT NULL,
  `footer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `footer`
--

INSERT INTO `footer` (`id_footer`, `footer`) VALUES
(1, 'Copyright@2022 | PDR Technology');

-- --------------------------------------------------------

--
-- Struktur dari tabel `header`
--

CREATE TABLE `header` (
  `id_header` int(11) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `header`
--

INSERT INTO `header` (`id_header`, `foto`) VALUES
(1, '6w8skdv4tyvr3d9qm4zhf7ml7-boccfraotei2e1547vr6oprrv.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `hospitals`
--

CREATE TABLE `hospitals` (
  `id_hospital` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `hp` varchar(25) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hospitals`
--

INSERT INTO `hospitals` (`id_hospital`, `nama`, `alamat`, `hp`, `foto`) VALUES
(1, 'RSD Siloam', 'Jakarta', '081212121', 'ih4qn8l6xluk2lua4kolzzhtu-hefabsvovofnocuva94etux32.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `map`
--

CREATE TABLE `map` (
  `id_map` int(11) NOT NULL,
  `location` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `map`
--

INSERT INTO `map` (`id_map`, `location`) VALUES
(1, 'https://maps.google.com/maps?q=Siloam%20Hospitals%20Agora&t=&z=13&ie=UTF8&iwloc=&output=embed');

-- --------------------------------------------------------

--
-- Struktur dari tabel `navbar`
--

CREATE TABLE `navbar` (
  `id_navbar` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `navbar`
--

INSERT INTO `navbar` (`id_navbar`, `title`, `link`) VALUES
(14, 'Profile', 'profile'),
(15, 'About', 'visi-misi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `navbar_child`
--

CREATE TABLE `navbar_child` (
  `id_navbar_child` int(11) NOT NULL,
  `id_navbar` int(11) NOT NULL,
  `title_child` varchar(255) NOT NULL,
  `link_child` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `navbar_child`
--

INSERT INTO `navbar_child` (`id_navbar_child`, `id_navbar`, `title_child`, `link_child`) VALUES
(3, 13, 'Visi Misi', 'visi-misi'),
(4, 13, 'Mantap', 'ready'),
(8, 14, 'Visi Misi', 'visi-misi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `page`
--

CREATE TABLE `page` (
  `id_page` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `page`
--

INSERT INTO `page` (`id_page`, `name`, `slug`, `description`, `date_created`, `time_created`) VALUES
(10, 'Profile', 'profile', '-', '2022-09-05', '12:54:00'),
(11, 'Visi Misi', 'visi-misi', '-', '2022-09-05', '12:58:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `partners`
--

CREATE TABLE `partners` (
  `id_partner` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `partners`
--

INSERT INTO `partners` (`id_partner`, `title`, `image`, `link`) VALUES
(5, 'BPJS', '37zjqgvp0pbudvjtretgsh1re-2dsstr5gcxx0ie65q1d85qa1l.png', 'https://bpjs-kesehatan.go.id/bpjs/'),
(6, 'Mandiri In Health', 'ifveyzgmmbxw3y7pghdvo2bpb-9ufcf3vp2ezkkkw74b36e7ys9.jpg', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `post`
--

CREATE TABLE `post` (
  `id_post` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `post`
--

INSERT INTO `post` (`id_post`, `title`, `description`, `cover`, `date_created`, `time_created`) VALUES
(8, 'Daftar Rumah Sakit Rujukan Covid-19 di DKI Jakarta', '<p>JAKARTA, KOMPAS.com- Situasi pandemi Covid-19 di Jakarta semakin memburuk. Pada Minggu (6/2/2022), ada penambahan 15.825 kasus Covid-19 dalam satu hari. Lonjakan kasus dengan angka di atas 10.000 bahkan terjadi dalam waktu empat hari terakhir. Sejalan dengan kenaikan kasus dan permintaan ambulans, tingkat keterisian tempat tidur atau bed occupancy ratio (BOR) di rumah sakit rujukan Covid-19 wilayah DKI Jakarta juga meningkat. Berdasarkan data Pemprov DKI Jakarta, BOR isolasi sudah mencapai 63 persen per Sabtu (5/1/2022).</p>\n\n<p>Artikel ini telah tayang di Kompas.com dengan judul ', 'a8k5z8hqfjqym5t76iz1l2dgw-38omcy8m94tga58k00nt89wkw.jpg', '2022-09-05', '12:43:00'),
(9, 'Siap Oke ', '<p>Oke</p>\n', NULL, '2022-09-05', '12:57:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `slideshows`
--

CREATE TABLE `slideshows` (
  `id_slideshow` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `slideshows`
--

INSERT INTO `slideshows` (`id_slideshow`, `image`, `title`, `description`, `date_created`) VALUES
(5, 'jxzzfu7ofk860koc9inp7ikbn-ltqhitasundpevyg9jeqh292z.jpg', 'Profile', 'Enim eiusmod laborum commodo culpa culpa incididunt minim reprehenderit excepteur in laborum dolor consequat velit. Est mollit amet nulla do. Ullamco tempor commodo cillum fugiat labore eiusmod commodo et deserunt ut et. Esse anim eiusmod veniam et deseru', '2022-09-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `spesialis`
--

CREATE TABLE `spesialis` (
  `id_spesialis` int(11) NOT NULL,
  `spesialis` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `spesialis`
--

INSERT INTO `spesialis` (`id_spesialis`, `spesialis`) VALUES
(1, 'Dokter Umum'),
(2, 'Spesialis Penyakit Dalam');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_docters`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_docters` (
`id_docter` int(11)
,`nama` varchar(255)
,`id_spesialis` int(11)
,`ket` varchar(255)
,`foto` varchar(255)
,`spesialis` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `view_navbar_child`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `view_navbar_child` (
`id_navbar` int(11)
,`title` varchar(255)
,`link` varchar(255)
,`id_navbar_child` int(11)
,`title_child` varchar(255)
,`link_child` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `view_docters`
--
DROP TABLE IF EXISTS `view_docters`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_docters`  AS SELECT `docters`.`id_docter` AS `id_docter`, `docters`.`nama` AS `nama`, `docters`.`id_spesialis` AS `id_spesialis`, `docters`.`ket` AS `ket`, `docters`.`foto` AS `foto`, `spesialis`.`spesialis` AS `spesialis` FROM (`docters` join `spesialis`) WHERE `docters`.`id_spesialis` = `spesialis`.`id_spesialis` ;

-- --------------------------------------------------------

--
-- Struktur untuk view `view_navbar_child`
--
DROP TABLE IF EXISTS `view_navbar_child`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_navbar_child`  AS SELECT `navbar`.`id_navbar` AS `id_navbar`, `navbar`.`title` AS `title`, `navbar`.`link` AS `link`, `navbar_child`.`id_navbar_child` AS `id_navbar_child`, `navbar_child`.`title_child` AS `title_child`, `navbar_child`.`link_child` AS `link_child` FROM (`navbar` join `navbar_child`) WHERE `navbar`.`id_navbar` = `navbar_child`.`id_navbar` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `docters`
--
ALTER TABLE `docters`
  ADD PRIMARY KEY (`id_docter`);

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id_feedback`);

--
-- Indeks untuk tabel `footer`
--
ALTER TABLE `footer`
  ADD PRIMARY KEY (`id_footer`);

--
-- Indeks untuk tabel `header`
--
ALTER TABLE `header`
  ADD PRIMARY KEY (`id_header`);

--
-- Indeks untuk tabel `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`id_hospital`);

--
-- Indeks untuk tabel `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id_map`);

--
-- Indeks untuk tabel `navbar`
--
ALTER TABLE `navbar`
  ADD PRIMARY KEY (`id_navbar`);

--
-- Indeks untuk tabel `navbar_child`
--
ALTER TABLE `navbar_child`
  ADD PRIMARY KEY (`id_navbar_child`);

--
-- Indeks untuk tabel `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`id_page`),
  ADD KEY `slug` (`slug`);

--
-- Indeks untuk tabel `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id_partner`);

--
-- Indeks untuk tabel `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id_post`);

--
-- Indeks untuk tabel `slideshows`
--
ALTER TABLE `slideshows`
  ADD PRIMARY KEY (`id_slideshow`);

--
-- Indeks untuk tabel `spesialis`
--
ALTER TABLE `spesialis`
  ADD PRIMARY KEY (`id_spesialis`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `docters`
--
ALTER TABLE `docters`
  MODIFY `id_docter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id_feedback` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `footer`
--
ALTER TABLE `footer`
  MODIFY `id_footer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `header`
--
ALTER TABLE `header`
  MODIFY `id_header` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `id_hospital` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `map`
--
ALTER TABLE `map`
  MODIFY `id_map` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `navbar`
--
ALTER TABLE `navbar`
  MODIFY `id_navbar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `navbar_child`
--
ALTER TABLE `navbar_child`
  MODIFY `id_navbar_child` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `page`
--
ALTER TABLE `page`
  MODIFY `id_page` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `partners`
--
ALTER TABLE `partners`
  MODIFY `id_partner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `post`
--
ALTER TABLE `post`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `slideshows`
--
ALTER TABLE `slideshows`
  MODIFY `id_slideshow` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `spesialis`
--
ALTER TABLE `spesialis`
  MODIFY `id_spesialis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
