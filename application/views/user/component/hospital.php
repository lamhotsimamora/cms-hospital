<main class="container">
	<div class="bg-light p-5 rounded">
		<h1><?= ($data_hospital['nama']) ?></h1>
		
		<p class="lead">
		<?= ($data_hospital['alamat']).'-'.($data_hospital['hp']) ?>
		</p>
		
		<hr>
		<img src="<?= base_url().'public/img/hospital/'.$data_hospital['foto'] ?>" 
		class="rounded" width="150" height="150"  alt="">
	</div>
</main>
<br>
