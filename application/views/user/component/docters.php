<!-- slideshow -->
<main class="container">

	<?php

	$total_docter = count($data_docter);

	?>

	<div class="alert alert-secondary" role="alert">
		Total Docters : <span class="badge text-bg-info"><?= $total_docter ?></span>
	</div>
	<br>

	<section id="main-slider" class="splide" aria-label="Data Docters">
		<div class="splide__track">
			<ul class="splide__list">

				<?php

				$server = base_url();
				$no_img = base_url() . 'public/assets/img/no-img.png';

				foreach ($data_docter as $key => $value) {
					$foto = $value['foto'];
					$nama = $value['nama'];

					if ($foto === '' || $foto == null) {
						$foto = $no_img;
					} else {
						$foto =  $server . 'public/img/docters/' . $foto;
					}

					echo '<li class="splide__slide">
							<h5 style="background-color:#ecf0f1;">' . $nama . '</h5>
							<img width="auto" height="auto" src="' . $foto . '" alt="" />
						</li>';
				}

				?>


			</ul>
		</div>
	</section>

</main>
