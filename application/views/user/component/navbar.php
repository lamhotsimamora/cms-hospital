<nav class="navbar navbar-expand-md navbar-dark bg-primary mb-auto">
	<div class="container-fluid">
		<a class="navbar-brand" href=".">Home</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarCollapse">
			<ul class="navbar-nav me-auto mb-2 mb-md-0">

				<?php

				for ($i = 0; $i < count($data_navbar); $i++) {
					$checking_dropdown = false;
					$template_dropdown = '';

					$id_navbar = $data_navbar[$i]['id_navbar'];

					foreach ($data_navbar_child as $key => $value) {
						$id_navbar_child = $value['id_navbar'];
						$title_child = $value['title_child'];
						$link_child = $value['link_child'];

						if ($id_navbar == $id_navbar_child) {
							$checking_dropdown = true;
							$template_dropdown .= '<li><a class="dropdown-item" href="' . $link_child . '">' . $title_child . '</a></li>';
						} else {
							$checking_dropdown = false;
						}
					}

					$title =  $data_navbar[$i]['title'];
					$link =  $data_navbar[$i]['link'];

					if ($checking_dropdown == false) {
						echo '<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="' . $link . '">' . $title . '</a>
							</li>';
					} else {
						echo '<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="' . $link . '" data-bs-toggle="dropdown" aria-expanded="false">' . $title . '</a>
								<ul class="dropdown-menu">
									' . $template_dropdown . '
								</ul>
							</li>';
					}
				}


				?>

			</ul>

			<form class="d-flex" role="search">
				<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success" type="button">Search</button>
			</form>
		</div>
	</div>
</nav>
