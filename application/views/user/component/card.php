<main class="container">

	<div class="card">
		<div class="card-header">
			Map
		</div>
		<div class="card-body">
			<div class="mapouter">
				<div class="gmap_canvas">
					<iframe width="300" height="300" id="gmap_canvas" 
					src="https://maps.google.com/maps?q=Siloam%20Hospitals%20Kebon%20Jeruk&t=&z=13&ie=UTF8&iwloc=&output=embed" 
					frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
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
			<a href="#">
				<img src="<?= base_url('') ?>public/assets/img/bpjs.png" width="80" height="80" class="img-thumbnail" alt="BPJS Kesehatan">
				<strong>BPJS Kesehatan</strong>
			</a>
			<br><br>

			<a href="#">
				<img src="<?= base_url('') ?>public/assets/img/jasa-raharja.jpg" width="80" height="80" class="img-thumbnail" alt="Jasa Raharja">
				<strong>Jasa Raharja</strong>
			</a>

			<br> <br>
			<a href="#">
				<img src="<?= base_url('') ?>public/assets/img/mandiri.png" width="80" height="80" class="img-thumbnail" alt="Mandiri in health">
				<strong>Mandiri in health</strong>
			</a>

		</div>
	</div>

</main>
