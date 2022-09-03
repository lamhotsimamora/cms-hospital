<!-- slideshow -->
<main class="container">
	
<div class="alert alert-info" role="alert">
  Docters
</div>
<br>

	<section id="main-slider" class="splide" aria-label="Data Docters">
		<div class="splide__track">
			<ul class="splide__list">



				<?php

				$server = base_url() . 'public/img/docters/';

				foreach ($data_docter as $key => $value) {
					$foto = $value['foto'];
					$nama = $value['nama'];

					echo '<li class="splide__slide">
						<h4>' . $nama . '</h4>
						<img src="' . $server . $foto . '" alt="" />
					</li>';
				}

				?>


			</ul>
		</div>
	</section>

	<ul id="thumbnails" class="thumbnails">

		<?php 

		$server = base_url().'public/img/docters/';

		foreach ($data_docter as $key => $value) {
			$foto = $value['foto'];
			$nama = $value['nama'];

			echo '<li class="thumbnail">
					<img src="' . $server . $foto . '" alt="" />
				</li>';
		}

		?>
		

	</ul>
</main>
<!-- slideshow -->
