<main class="container">
	<div class="bg-light p-5 rounded">
		<h1><?= ($data_hospital['nama']) ?></h1>
		
		<p class="lead">
		<?= ($data_hospital['alamat']) ?>
		</p>
		
		<hr>
		<img src="<?= base_url().'public/img/hospital/'.$data_hospital['foto'] ?>" class="img-thumbnail" width="80" height="80" alt="">
	</div>
</main>
