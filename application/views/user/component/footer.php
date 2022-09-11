<div class="b-example-divider"></div>


<div class="container">
	<footer class="py-5">
		<div class="row">
			<div class="col-sm">
				<h5>News</h5>
				<hr>
				<ul class="nav flex-column">
					<?php 
					
					$server = base_url().'post/detail/';
					foreach ($data_post_limit as $key => $value) {
						$title = $value['title'];
						$link = $value['id_post'];

						$link  = $server.$link;
						echo '<li class="nav-item mb-2"><a href="'.$link.'" class="nav-link p-0 text-muted">'.$title.'</a></li>';		
					}

					?>

				</ul>
			</div>

			<div class="col-sm">
				<h5>Page</h5>
				<hr>
				<ul class="nav flex-column">
					<?php 
					
					$server = base_url().'page/p/';
					foreach ($data_pages as $key => $value) {
						$name = $value['name'];
						$slug = $value['slug'];

						$slug  = $server.$slug;
						echo '<li class="nav-item mb-2"><a href="'.$slug.'" class="nav-link p-0 text-muted">'.$name.'</a></li>';		
					}

					?>
				</ul>
			</div>


			<div class="col-sm">
				<form>
					<!-- <h5>Subscribe to our newsletter</h5>
					<p>Monthly digest of what's new and exciting from us.</p>
					<div class="d-flex flex-column flex-sm-row w-100 gap-2">
						<label for="newsletter1" class="visually-hidden">Email address</label>
						<input id="newsletter1" type="text" class="form-control" placeholder="Email address">
						<button class="btn btn-primary" type="button">Subscribe</button>
					</div>  -->

					<div class="mapouter">
				<div class="gmap_canvas">
					<center>

					<?php 

					$map = $data_map['location'];

					$html_map = 'https://maps.google.com/maps?q='.$map.'&t=&z=13&ie=UTF8&iwloc=&output=embed';

					?>

						<iframe width="300" height="300" id="gmap_canvas" src="<?php echo $html_map; ?>" 
						frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
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
				</form>
			</div>
		</div>

		<div class="d-flex flex-column flex-sm-row justify-content-between py-4 my-4 border-top">
			<p>
				<?php

				echo $data_footer['footer'];

				?>
			</p>
			<ul class="list-unstyled d-flex">
				<li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
							<use xlink:href="#twitter" />
						</svg></a></li>
				<li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
							<use xlink:href="#instagram" />
						</svg></a></li>
				<li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
							<use xlink:href="#facebook" />
						</svg></a></li>
			</ul>
		</div>
	</footer>
</div>
<!-- <footer class="footer mt-auto py-3 bg-light">
  <div class="container">
    <span class="text-muted">Place sticky footer content here.</span>
  </div>
</footer> -->
