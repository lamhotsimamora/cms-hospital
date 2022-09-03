<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
	<div class="carousel-indicators">
		<button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
		<button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
		<button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
	</div>
	<div class="carousel-inner">
		<!-- CONTENT -->

		<!-- carosel1 -->
		<?php


		$server = base_url() . 'public/';
		$no_image = 'no-img.png';

		$i = 1;
		foreach ($data_slideshow as $key => $value) {
			$title = $value['title'];
			$image = $value['image'];

			if ($image==='' || $image==null){
				$image = 'assets/img/'.$no_image;
			}else{
				$image = 'img/slideshow/'.$image;
			}

			$description = $value['description'];

			$active  = '';
			if ($i == 1) {
				$active = 'active';
			} else {
				$active = '';
			}

			echo '<div class="carousel-item ' . $active . '">
			<img class="bd-placeholder-img" width="100%" height="100%" src="' . $server . $image . '" alt="">
			
	
			<div class="container">
				<div class="carousel-caption text-start" style="color:black">
					<h1 style="background-color:DodgerBlue;">
						' . $title . '
					</h1>
					<p style="background-color:white;">
						' . $description . '
					</p>
					<p><a class="btn btn-lg btn-primary" href="#">News</a></p>
				</div>
			</div>
		</div>';

			$i++;
		}
		?>
		<!-- carosel1 -->


		<!-- CONTENT -->
	</div>

	<button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Previous</span>
	</button>
	<button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="visually-hidden">Next</span>
	</button>
</div>
