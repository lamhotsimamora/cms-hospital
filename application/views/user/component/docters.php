<!-- slideshow -->
<main class="container">

	<div class="alert alert-secondary" role="alert">
		Data Docters
	</div>
	<br>

	<section id="main-slider" class="splide" aria-label="Data Docters">
		<div class="splide__track">
			<ul class="splide__list">

				<?php

				$server = base_url();
				$no_img = base_url().'public/assets/img/no-img.png';

				foreach ($data_docter as $key => $value) {
					$foto = $value['foto'];
					$nama = $value['nama'];

					if ($foto==='' || $foto==null)
					{
						$foto = $no_img;
					}else{
						$foto =  $server.'public/img/docters/'.$foto;
					}

					echo '<li class="splide__slide">
							<img width="150" height="150" src="' . $foto . '" alt="" />
							<h5 style="background-color:#ecf0f1;">' . $nama . '</h5>
						</li>';
				}

				?>


			</ul>
		</div>
	</section>

	<ul id="thumbnails" class="thumbnails">

		<?php

		
		foreach ($data_docter as $key => $value) {
			$foto = $value['foto'];
			$nama = $value['nama'];

			if ($foto==='' || $foto==null)
			{
				$foto = $no_img;
			}else{
				$foto =  $server.'public/img/docters/'.$foto;
			}

			echo '<li class="thumbnail">
					<img width="60" height="60" src="'  . $foto . '" alt="" />
				</li>';
		}

		?>


	</ul>
</main>
<!-- slideshow -->
