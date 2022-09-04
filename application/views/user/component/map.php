<main class="container">

	<div class="card">
		<div class="card-header">
			Map
		</div>
		<div class="card-body">
			<div class="mapouter">
				<div class="gmap_canvas">
					<center>

						<iframe width="300" height="300" id="gmap_canvas" src="<?php echo $data_map['location'] ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
					</center>
					<br>
					<style>
						.mapouter {
							position: relative;
							text-align: right;
							height: 300px;
							width: 300px;
						}
					</style>
					<style>
						.gmap_canvas {
							overflow: hidden;
							background: none !important;
							height: 300px;
							width: 300px;
						}
					</style>
				</div>
			</div>
		</div>
	</div>

	<br>
	<div class="card">
		<div class="card-body">
			<p>
				Partners
			</p>
			<hr>
			<?php 
			$server = base_url().'public/img/partners/';
			
			foreach ($data_partner as $key => $value) {
				$image = $value['image'];
				$title = $value['title'];
				$link = $value['link'];

				echo '<br>
				<a target="_blank" href="'.$link.'">
					<img src="'.$server.$image.'" width="80" height="80" class="img-thumbnail" alt="'.$title.'">
					<strong>'.$title.'</strong>
				</a><br>';
			}


			?>
			

		</div>
	</div>

</main>
