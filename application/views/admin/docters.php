<!DOCTYPE html>
<html lang="en">

<head>

    <title>Docters</title>

    @include('_structure/css_meta')
    <script src="{{ asset('storage/js/upload.js') }}"></script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        @include('_layout/sidebar')

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

                    @include('_layout/topbar-search')
                    @include('_layout/topbar-navbar')

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Docters</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> </a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        @include('_layout/top-card')
                    </div>

                    <!-- Content Row -->

                    <div class="container-fluid">

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <a href="{{ url('/docters') }}">Data Docters</a>
                                </h6>
                            </div>
                            <div class="card-body" id="table_docter" v-cloak>

                                <div class="table-responsive">
                                    <button data-toggle="modal" data-target="#addDocterModal" class="btn btn-primary">+
                                        Add Docter</button>
                                    <button @click="goToSpesialis" class="btn btn-success">Spesialis</button>
                                    <button @click="goToSchedules" class="btn btn-success">Schedules</button>

                                    <hr>
                                    <div class="input-group">
                                        <input type="text" v-model="search" @keypress="searchData" ref="search"
                                            class="form-control bg-light border-0 small"
                                            placeholder="Search Docters By Name" aria-label="Search"
                                            aria-describedby="basic-addon2">
                                    </div><br>
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                                <td>@{{ data . name }}</td>
                                                <td>@{{ data . spesialis }}</td>
                                                <td v-html="viewFotoDocters(data.foto)"></td>
                                                <td>
                                                    <button data-toggle="modal" data-target="#editDocterModal"
                                                        @click="showEditModal(data.id_docter,data.name,data.id_spesialis,data.foto)"
                                                        class="btn btn-warning btn-sm">Edit</button>
                                                    <button @click="deleteData(data.id_docter)"
                                                        class="btn btn-danger btn-sm">x</button>
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

            @include('_layout/footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Edit Docter Modal-->
    <div class="modal fade" id="editDocterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                        <input type="text" v-model="docter_name" ref="docter_name"
                            class="form-control bg-light border-0 small" placeholder="Docter Name" aria-label="Search"
                            aria-describedby="basic-addon2">

                    </div>
                    <br>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select SPESIALIS</label>
                        <select v-model="spesialis" @change="selectSpesialis" class="form-control form-control-sm"
                            id="exampleFormControlSelect1">
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
    <div class="modal fade" id="addDocterModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                        <input type="text" @keypress="enterSave" v-model="docter_name" ref="docter_name"
                            class="form-control bg-light border-0 small" placeholder="Docter Name" aria-label="Search"
                            aria-describedby="basic-addon2">

                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Select SPESIALIS</label>
                        <select @keypress="enterSave" v-model="spesialis" @change="selectSpesialis"
                            class="form-control form-control-sm" id="exampleFormControlSelect1">
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

    @include('_layout/logout')
    @include('_structure/js_bottom')


    <script src="{{ asset('storage/js/jnet.js') }}"></script>

    <script src="{{ asset('storage/js-app/init.js') }}"></script>
    <script src="{{ asset('storage/js-app/docters.js') }}"></script>

    <script src="{{ asset('storage/js-app/total.js') }}"></script>

</body>

</html>
