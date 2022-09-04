<main class="container">
<div class="bg-light p-5 rounded">

	<?php 
	$server = base_url();
	$no_image = $server.'public/assets/img/no-img.png';

	foreach ($data_post as $key => $value) {
		$title = $value['title'];
		$description = $value['description'];
		$cover = $value['cover'];
		$date = $value['date_created'];
		$link = $value['id_post'];

		if ($cover===''||$cover==null){
			$cover = $no_image;
		}

		echo '  <h1>'.$title.'</h1>
		<hr>
					<p class="lead">
						<img class="thumbnail" src="'.$server.'public/img/posts/'.$cover.'"></img>
					</p>
					<small>'.$date.'</small><hr>
					<a class="btn btn-lg btn-primary btn-sm" href="'.$server.'post/detail/'.$link.'">
						Read More
					</a>';
	}

	?>

  
</div>
</main>
