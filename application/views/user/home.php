<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" href="<?= base_url('') ?>public/assets/css/bootstrap.css">
	<link rel="stylesheet" href="<?= base_url('') ?>public/assets/css/splide.css">
	<link rel="stylesheet" href="<?= base_url('') ?>public/assets/css/carousel.css">

	<script src="<?= base_url('') ?>public/assets/js/bootstrap.bundle.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/splide.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vony.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vue.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/sweet-alert.js"></script>

	<link rel="stylesheet" href="<?= base_url('') ?>public/assets/css/main.css">
</head>

<body style="background:blue">

	<?php include('component/navbar.php') ?>

	<?php include('component/slideshow.php') ?>

	<?php include('component/news.php') ?>
	<br>
	<?php include('component/docters.php') ?>
	<br>
	<?php include('component/hospital.php') ?>
	<br>
	<?php include('component/map.php')?>
	<br>
	<?php include('component/footer.php') ?>

	<script>
		var splide = new Splide("#main-slider", {
			width: 200,
			height: 350,
			pagination: true,
			cover: true
		});

		var thumbnails = document.getElementsByClassName("thumbnail");
		var current;

		for (var i = 0; i < thumbnails.length; i++) {
			initThumbnail(thumbnails[i], i);
		}

		function initThumbnail(thumbnail, index) {
			thumbnail.addEventListener("click", function() {
				splide.go(index);
			});
		}

		splide.on("mounted move", function() {
			var thumbnail = thumbnails[splide.index];

			if (thumbnail) {
				if (current) {
					current.classList.remove("is-active");
				}

				thumbnail.classList.add("is-active");
				current = thumbnail;
			}
		});
		splide.mount();
	</script>
</body>

</html>
