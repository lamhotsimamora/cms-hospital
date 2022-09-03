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
	<script src="<?= base_url('') ?>public/assets/js/upload.js"></script>

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

									<hr>
									<div class="input-group">
										<input type="text" v-model="search" @keypress="enterSearch" ref="search" class="form-control bg-light border-0 small" placeholder="Search Docters" aria-label="Search" aria-describedby="basic-addon2">
									</div><br>
									<table class="table table-bordered" width="100%" cellspacing="0">
										<thead>
											<tr>
												<th>Nama</th>
												<th>Spesialis</th>
												<th>Keterangan</th>
												<th>Foto</th>
												<th>@</th>
											</tr>
										</thead>

										<tbody>
											<tr v-for="data in data_docters">
												<td>{{ data . nama }}</td>
												<td>{{ data . spesialis }}</td>
												<td>{{ data . ket }}</td>
												<td v-html="viewFotoDocters(data.foto)"></td>
												<td>
													<button data-toggle="modal" data-target="#editDocterModal" @click="showEditModal(data)" class="btn btn-warning btn-sm">Edit</button>
													<button class="btn btn-success btn-sm" data-toggle="modal" data-target="#uploadFotoModal" @click="getIdDocter(data.id_docter)">Foto</button>
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
						{{ error_message }}
					</div>

					<div class="input-group">
						<input type="text" @keypress="enterUpdate" v-model="docter_name" ref="docter_name" class="form-control bg-light border-0 small" placeholder="Docter Name" aria-label="Search" aria-describedby="basic-addon2">

					</div>
					<br>
					<div class="form-group">
						<label for="exampleFormControlSelect1">Select SPESIALIS</label>
						<select v-model="spesialis" @change="selectSpesialis" class="form-control form-control-sm" id="exampleFormControlSelect1">
							<option :value="spesialis.id_spesialis" v-for="spesialis in data_spesialis">
								{{ spesialis . spesialis }}
							</option>
						</select>
					</div>
					<hr>
					<div class="input-group">
						<input type="text" @keypress="enterUpdate" v-model="ket" ref="ket" class="form-control bg-light border-0 small" placeholder="Keterangan" aria-label="Search" aria-describedby="basic-addon2">
					</div>

				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="#" @click="updateData">Update</a>
				</div>
			</div>
		</div>
	</div>
	<!-- End Edit Docter Modal-->

	<!-- upload foto Modal-->
	<div class="modal fade" id="uploadFotoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Upload Foto Docter</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<center v-if="loading">
						<div class="spinner-border text-primary" role="status">
							<span class="visually-hidden"></span>
						</div>
					</center>
					<hr>
					<center>
						<input type="file" @change="selectFoto" accept="image/*" id="file_img" name="file_img"> <br><br>
						<img :src="img_docter" alt="" width="100px" height="100px" id="img_docter" name="img_docter">
					</center> <br>


				</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<a class="btn btn-primary" href="#" @click="uploadFoto">Upload</a>
				</div>
			</div>
		</div>
	</div>
	<!-- End Upload Foto Docter Modal-->



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
						{{ error_message }}
					</div>

					<div class="input-group">
						<input type="text" @keypress="enterSave" v-model="docter_name" ref="docter_name" class="form-control bg-light border-0 small" placeholder="Docter Name" aria-label="Search" aria-describedby="basic-addon2">
					</div>
					<hr>
					<div class="form-group">
						<label for="exampleFormControlSelect1">Select SPESIALIS</label>
						<select @keypress="enterSave" v-model="spesialis" @change="selectSpesialis" class="form-control form-control-sm" id="exampleFormControlSelect1">
							<option :value="spesialis.id_spesialis" v-for="spesialis in data_spesialis">
								{{ spesialis . spesialis }}
							</option>
						</select>
					</div>
					<hr>
					<div class="input-group">
						<input type="text" @keypress="enterSave" v-model="ket" ref="ket" class="form-control bg-light border-0 small" placeholder="Keterangan" aria-label="Search" aria-describedby="basic-addon2">
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
		const _SPESIALIS_LOAD_DATA_ = _URL_SERVER_ + 'admin/api_load_spesialis';

		const _DOCTER_ADD_DATA_ = _URL_SERVER_ + 'admin/api_add_docter';
		const _DOCTER_UPDATE_DATA_ = _URL_SERVER_ + 'admin/api_update_docter';
		const _DOCTER_DELETE_DATA_ = _URL_SERVER_ + 'admin/api_delete_docter';
		const _DOCTER_SEARCH_DATA_ = _URL_SERVER_ + 'admin/api_search_docter';

		const NO_IMAGE = _URL_SERVER_ + 'public/assets/img/no-img.png';

		var _READY_UPLOAD_FOTO_ = false;
		const $typefile_allowed = ['image/png', 'image/jpeg'];
	</script>


	<script src="<?= base_url('') ?>public/assets/js/jquery/jquery.js"></script>
	<script src="<?= base_url('') ?>public/assets/bootstrap/js/bootstrap.bundle.js"></script>


	<script src="<?= base_url('') ?>public/assets/js/sb-admin-2.min.js"></script>

	<script>
		var $docter = new Vue({
			el: '#table_docter',
			data: {
				data_docters: null,
				search: null,
				id_docter: null
			},
			methods: {
				showEditModal: function(data) {
					$editDocter.docter_name = data.nama;
					$editDocter.spesialis = data.spesialis;
					$editDocter.ket = data.ket;
					$editDocter.id_docter = data.id_docter;
				},
				getIdDocter: function(id_docter) {
					$uploadFoto.id_docter = id_docter;
				},
				deleteData: function(id_docter) {
					if (id_docter) {
						Swal.fire({
							title: 'Yakin mau hapus data ini ?',
							text: "",
							icon: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Yes'
						}).then((result) => {
							if (result.isConfirmed) {
								Vony({
									url: _DOCTER_DELETE_DATA_,
									method: 'POST',
									data: {
										_token: _TOKEN_,
										id_docter: id_docter
									}
								}).ajax($response => {
									const $obj = JSON.parse($response);
									if ($obj.result == true) {
										showToast('Data has been deleted !', 'success')
										this.loadData();
									} else {
										this.data_docters = null;
										showToast('Data gagal dihapus !')
									}
								});
							}
						})
					}
				},
				viewFotoDocters: function(data) {

					var path = 'public/img/docters/';
					if (data === '' || data == null) {
						data = NO_IMAGE;
					} else {
						data = _URL_SERVER_ + path + data;
					}

					return `<img src="${data}" width="80" height="80" class="img-thumbnail"></img>`;
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
					if (this.search == null || this.search === '') {
						this.$refs.search.focus();
						this.loadData()
						return;
					}
					Vony({
						url: _DOCTER_SEARCH_DATA_,
						method: 'POST',
						data: {
							_token: _TOKEN_,
							search:this.search
						}
					}).ajax($response => {
						const $obj = JSON.parse($response);
						if ($obj.result == true) {
							this.data_docters = $obj.data;
						} else {
							this.data_docters = null;
							showToast('Failed load data !', 'danger')
						}
					});

				},
				enterSearch:function(e){
					if (e.keyCode==13){
						this.searchData()
					}
				}
			},
			mounted() {
				this.loadData();
			},
		})

		new Vue({
			el: "#addDocterModal",
			data: {
				docter_name: null,
				spesialis: null,
				error_message: null,
				data_spesialis: null,
				alert: null,
				ket: null
			},
			mounted() {
				this.loadSpesialis();
			},
			methods: {

				loadSpesialis: function() {
					Vony({
						url: _SPESIALIS_LOAD_DATA_,
						method: 'POST',
						data: {
							_token: _TOKEN_
						}
					}).ajax($response => {
						const $obj = JSON.parse($response);
						if ($obj.result == true) {
							this.data_spesialis = $obj.data;
						} else {
							this.data_spesialis = null;
							showToast('Failed load data !', 'danger')
						}
					});
				},
				selectSpesialis: function() {

				},
				enterSave: function(e) {
					if (e.keyCode == 13) {
						this.save();
					}
				},
				save: function() {
					if (this.docter_name == null || this.docter_name === '') {
						this.$refs.docter_name.focus();
						return;
					}

					if (this.spesialis === 'NULL' || this.spesialis == null) {
						this.error_message = "Pilih Spesialis Dulu...";
						this.alert = true;
						return;
					}
					if (this.ket == null || this.ket === '') {
						this.$refs.ket.focus();
						return;
					}
					this.alert = false;
					Vony({
						url: _DOCTER_ADD_DATA_,
						method: 'POST',
						data: {
							_token: _TOKEN_,
							nama: this.docter_name,
							id_spesialis: this.spesialis,
							ket: this.ket
						}
					}).ajax($response => {
						const $obj = JSON.parse($response);

						if ($obj) {
							const $result = $obj.result;

							if ($result) {
								this.docter_name = null;
								this.ket = null
								$docter.loadData();
								showToast('Data has been added !', 'success')
							} else {
								var message = $obj.message;
								showToast(message, 'danger')
							}
						}
					});
				}
			},
		})

		var $uploadFoto = new Vue({
			el: '#uploadFotoModal',
			data: {
				img_docter: NO_IMAGE,
				alert: null,
				loading: false,
				id_docter: null
			},
			methods: {

				selectFoto: function(event) {
					if (event.target.files && event.target.files[0]) {
						const obj_file = event.target.files[0];

						var image = URL.createObjectURL(obj_file);

						const fileName = obj_file.name;

						var sizeFile = obj_file.size / 1000;
						sizeFile = Math.floor(sizeFile);
						const typefile = obj_file.type;

						var $typefile_not_allowed = false;

						// check ukuran file jika lebih dari 2.5 mb maka akan ditolak
						if (sizeFile > 1500) {
							Swal.fire({
								title: 'Uppz!',
								text: 'Maximum size file is 1.5 Mb',
								icon: 'error',
								confirmButtonText: 'Ok'
							})
							_READY_UPLOAD_FOTO_ = false;
							this.img_docter = NO_IMAGE;
							return;
						}

						if (typefile === $typefile_allowed[0] ||
							typefile === $typefile_allowed[1]) {
							$typefile_not_allowed = true;
						}

						// check jenis file apakah file gambar atau bukan
						if ($typefile_not_allowed) {
							_READY_UPLOAD_FOTO_ = true;
							console.log("Ready To Upload");
							this.img_docter = image;
						} else {
							_READY_UPLOAD_FOTO_ = false;
							Swal.fire({
								title: 'Uppz!',
								text: 'File extension is not allowed',
								icon: 'error',
								confirmButtonText: 'Ok'
							});
							this.img_docter = NO_IMAGE;
						}
					} else {
						_READY_UPLOAD_FOTO_ = false;
						Swal.fire({
							title: 'Uppz!',
							text: 'Foto belum dipilih :)',
							icon: 'error',
							confirmButtonText: 'Ok'
						});

						this.img_docter = NO_IMAGE;
					}

				},
				uploadFoto: function() {
					if (_READY_UPLOAD_FOTO_ == false) {
						console.log("Not ready")
						return;
					}

					console.log(this.id_docter)
					if (this.id_docter == null) {
						console.log("Not ready")
						return;
					}
					this.loading = true;
					new Upload({
						// Array
						el: ['file_img'],
						// String
						url: _URL_SERVER_ + '/admin/api_upload_foto_docter',
						// String
						data: this.id_docter,
						// String
						token: _TOKEN_
					}).start(($response) => {
						var obj = JSON.parse($response);

						if (obj) {
							var result = obj.result;

							if (result == true) {
								Swal.fire({
									icon: 'success',
									title: 'Success',
									text: 'File Berhasil Diupload !',
									footer: '<a href=""></a>'
								});
								$docter.loadData();
								_READY_UPLOAD_FOTO_ = false;
								this.img_docter = NO_IMAGE;
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: 'File Gagal Diupload !',
									footer: '<a href="">Silahkan coba lagi</a>'
								})
							}
							this.loading = false;
						}
					});
				}
			},
		})


		var $editDocter = new Vue({
			el: "#editDocterModal",
			data: {
				id_docter: null,
				docter_name: null,
				spesialis: null,
				error_message: null,
				data_spesialis: null,
				alert: null,
				ket: null
			},
			mounted() {
				this.loadSpesialis()
			},
			methods: {
				enterUpdate: function(e) {
					if (e.keyCode == 13) {
						this.updateData()
					}
				},
				showEditModal: function(data) {
					console.log(data)
				},
				selectSpesialis: function() {

				},
				updateData: function() {
					if (this.id_docter==null){
						console.log('id docter null')
						return;
					}

					if (this.docter_name == null || this.docter_name === '') {
						this.$refs.docter_name.focus();
						return;
					}

					if (this.spesialis === 'NULL' || this.spesialis == null) {
						this.error_message = "Pilih Spesialis Dulu...";
						this.alert = true;
						return;
					}
					if (this.ket == null || this.ket === '') {
						this.$refs.ket.focus();
						return;
					}
					this.alert = false;

					Vony({
						url: _DOCTER_UPDATE_DATA_,
						method: 'POST',
						data: {
							_token: _TOKEN_,
							id_docter : this.id_docter,
							nama : this.docter_name,
							id_spesialis : this.spesialis,
							ket: this.ket
						}
					}).ajax($response => {
						const $obj = JSON.parse($response);

						if ($obj) {
							const $result = $obj.result;

							if ($result) {
								this.spesialis = null;
								$docter.loadData();
								showToast('Data has been updated !', 'success')
							} else {
								var message = $obj.message;
								showToast(message, 'danger')
							}
						}
					});

				},
				loadSpesialis: function() {
					Vony({
						url: _SPESIALIS_LOAD_DATA_,
						method: 'POST',
						data: {
							_token: _TOKEN_
						}
					}).ajax($response => {
						const $obj = JSON.parse($response);
						if ($obj.result == true) {
							this.data_spesialis = $obj.data;
						} else {
							this.data_spesialis = null;
							showToast('Failed load data !', 'danger')
						}
					});
				}
			},
		})
	</script>

</body>

</html>
