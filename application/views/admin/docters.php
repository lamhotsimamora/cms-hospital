<!DOCTYPE html>
<html lang="en">

<head>

	<title>Docters</title>


	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" href="<?= base_url('') ?>public/assets/fontawesome-free/css/all.min.css">

	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<link rel="stylesheet" href="<?= base_url('') ?>public/assets/css/sb-admin-2.css">
	<link rel="stylesheet" href="<?= base_url('') ?>public/assets/css/toast.css">

	<script src="<?= base_url('') ?>public/assets/js/vony.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/vue.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/sweet-alert.js"></script>

	<script src="<?= base_url('') ?>public/assets/js/toast.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/toast-app.js"></script>

	<script src="<?= base_url('') ?>public/assets/js/popper.min.js"></script>
	<script src="<?= base_url('') ?>public/assets/js/tippy-bundle.umd.js"></script>


	<style>
		.v-cloak {
			display: none;
		}
	</style>

</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">
		<?php include('component/sidebar.php') ?>

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>
					<?php include('component/topbar-search.php') ?>
					<?php include('component/topbar-navbar.php') ?>


				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<!-- Page Heading -->
					<div class="d-sm-flex align-items-center justify-content-between mb-4">
						<h1 class="h3 mb-0 text-gray-800">Docters</h1>
						<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> </a>
					</div>

					<!-- Content Row -->
					<div class="row">

						<?php include('component/top-card.php') ?>
					</div>

					<!-- Content Row -->

					<div class="container-fluid">

						<div class="card shadow mb-4">
							<div class="card-header py-3">
								<h6 class="m-0 font-weight-bold text-primary">
									<a href="">Data Docters</a>
								</h6>
							</div>
							<div class="card-body" id="table_docter" v-cloak>

								<div class="table-responsive">
									<button data-toggle="modal" data-target="#addDocterModal" class="btn btn-primary">+
										Add Docter</button>
									<button @click="goToSpesialis" class="btn btn-success">Spesialis</button>

									<hr>
									<div class="input-group">
										<input type="text" v-model="search" @keypress="searchData" ref="search" class="form-control bg-light border-0 small" placeholder="Search Docters By Name" aria-label="Search" aria-describedby="basic-addon2">
									</div><br>
									<table class="table table-bordered" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Docter Name</th>
												<th>Spesialis</th>
												<th>Foto</th>
												<th>@</th>
											</tr>
										</thead>

										<tbody>
											<tr v-for="data in data_docters">
												<td>{{ data . nama }}</td>
												<td>{{ data . spesialis }}</td>
												<td v-html="viewFotoDocters(data.foto)"></td>
												<td>
													<button data-toggle="modal" data-target="#editDocterModal" @click="showEditModal(data.id_docter,data.name,data.id_spesialis,data.foto)" class="btn btn-warning btn-sm">Edit</button>
													<button @click="deleteData(data.id_docter)" class="btn btn-danger btn-sm">x</button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>


					</div>


				</div>
				<!-- /.container-fluid -->

			</div>
			<!-- End of Main Content -->


			<?php include('component/footer.php') ?>

		</div>
		<!-- End of Content Wrapper -->

	</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>



	<!-- Edit Docter Modal-->
	<div class="modal fade" id="editDocterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Edit Docter</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<div v-if="alert" class="alert alert-danger" role="alert">
						@{{ error_message }}
					</div>

					<div class="input-group">
						<input type="text" v-model="docter_name" ref="docter_name" class="form-control bg-light border-0 small" placeholder="Docter Name" aria-label="Search" aria-describedby="basic-addon2">

					</div>
					<br>
					<div class="form-group">
						<label for="exampleFormControlSelect1">Select SPESIALIS</label>
						<select v-model="spesialis" @change="selectSpesialis" class="form-control form-control-sm" id="exampleFormControlSelect1">
							<option :value="spesialis.id_spesialis" v-for="spesialis in data_spesialis">
								@{{ spesialis . spesialis }}</option>
						</select>
					</div>
					<hr>
					<center>
						<input type="file" onchange="selectFoto(event)" accept="image/*" id="file_img" name="file_img"> <br><br>
						<img :src="img_docter" alt="" width="100px" height="100px" id="img_docter" name="img_docter">
					</center> <br>


				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="#" @click="updateData">Update</a>
				</div>
			</div>
		</div>
	</div>
	<!-- End Edit Docter Modal-->


	<!-- Add Docter Modal-->
	<div class="modal fade" id="addDocterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Add Docter</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">

					<div v-if="alert" class="alert alert-danger" role="alert">
						@{{ error_message }}
					</div>

					<div class="input-group">
						<input type="text" @keypress="enterSave" v-model="docter_name" ref="docter_name" class="form-control bg-light border-0 small" placeholder="Docter Name" aria-label="Search" aria-describedby="basic-addon2">

					</div>
					<hr>
					<div class="form-group">
						<label for="exampleFormControlSelect1">Select SPESIALIS</label>
						<select @keypress="enterSave" v-model="spesialis" @change="selectSpesialis" class="form-control form-control-sm" id="exampleFormControlSelect1">
							<option :value="spesialis.id_spesialis" v-for="spesialis in data_spesialis">
								@{{ spesialis . spesialis }}</option>
						</select>
					</div>

				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="#" @click="save">Save</a>
				</div>
			</div>
		</div>
	</div>
	<!-- End Add Docter Modal-->

	<?php include('component/logout.php') ?>
	<script>
		// get token from 
		const _TOKEN_ = '';
		const _URL_SERVER_ = '<?= base_url() ?>';
	</script>


	<script src="<?= base_url('') ?>public/assets/js/jquery/jquery.js"></script>
	<script src="<?= base_url('') ?>public/assets/bootstrap/js/bootstrap.bundle.js"></script>


	<script src="<?= base_url('') ?>public/assets/js/sb-admin-2.min.js"></script>

	<script>
		new Vue({
			el: '#table_docter',
			data: {
				data_docters: null,
				search: null
			},
			methods: {
				deleteData: function(){

				},
				viewFotoDocters: function() {

				},
				goToSpesialis: function() {

				},
				loadData: function() {
					Vony({
						url: _URL_SERVER_ + 'admin/api_load_data_docters',
						method: 'post'
					}).ajax((response) => {
						var obj = JSON.parse(response);

						if (obj) {
							this.data_docters = obj.data;
						}
					})
				},
				searchData: function() {

				}
			},
			mounted() {
				this.loadData();
			},
		})
	</script>

</body>

</html>
