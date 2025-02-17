<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('template/dist/css/adminlte.min.css?v=3.2.0')}}">

    <style>
        /* Container untuk running text */
        .marquee-vertical {
            height: 30px;           /* Atur tinggi container sesuai kebutuhan */
            overflow: hidden;       /* Sembunyikan teks yang keluar dari container */
            position: relative;     /* Menjadikan container sebagai referensi posisi anak */
        }

        /* Elemen teks yang akan dianimasikan */
        .marquee-vertical span {
            position: absolute;
            width: 100%;
            animation: verticalMarquee 5s linear infinite;
        }

        /* Definisi keyframes untuk animasi dari bawah ke atas */
        @keyframes verticalMarquee {
            0% {
                top: 100%;
            }
            100% {
                top: -100%;
            }
        }
    </style>

</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        @include('components.nav-bar')
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Lab PA</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <!-- <li class="breadcrumb-item"><a href="#">Layout</a></li> -->
                                <li class="breadcrumb-item active">Lab PA</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
   
            <!-- <div class="marquee-vertical">
                <span>Ini adalah running text yang bergerak dari atas ke bawah!</span>
            </div> -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <!-- <div class="col-lg-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>

                                    <p class="card-text">
                                        Some quick example text to build on the card title and make up the bulk of the
                                        card's
                                        content.
                                    </p>

                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>

                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>

                                    <p class="card-text">
                                        Some quick example text to build on the card title and make up the bulk of the
                                        card's
                                        content.
                                    </p>
                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
                        </div> -->
                        <!-- /.col-md-6 -->
                        <div class="col-lg-12">
                            <!-- <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title m-0">Featured</h5>
                                </div>
                                <div class="card-body">
                                    <h6 class="card-title">Special title treatment</h6>

                                    <p class="card-text">With supporting text below as a natural lead-in to additional
                                        content.</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div> -->

                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0">
                                            Radiology
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>Nama Dokter</b></h2>
                                                    <p class="text-muted text-sm"><b>About: </b> Web Designer /
                                                        UX / Graphic Artist / Coffee Lover </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-building"></i></span>
                                                            Address: Demo Street 123, Demo City 04312, NJ</li>
                                                        <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-phone"></i></span> Phone
                                                            #: + 800 - 12 12 23 52</li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="account.png" alt="user-avatar"
                                                        class="img-circle img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="card-footer">
                                                    <div class="text-right">
                                                        <a href="#" class="btn btn-sm bg-teal">
                                                            <i class="fas fa-comments"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-user"></i> View Profile
                                                        </a>
                                                    </div>
                                                </div> -->
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0">
                                            Radiology
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>Nama Dokter</b></h2>
                                                    <p class="text-muted text-sm"><b>About: </b> Web Designer /
                                                        UX / Graphic Artist / Coffee Lover </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-building"></i></span>
                                                            Address: Demo Street 123, Demo City 04312, NJ</li>
                                                        <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-phone"></i></span> Phone
                                                            #: + 800 - 12 12 23 52</li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="account.png" alt="user-avatar"
                                                        class="img-circle img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="card-footer">
                                                    <div class="text-right">
                                                        <a href="#" class="btn btn-sm bg-teal">
                                                            <i class="fas fa-comments"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-user"></i> View Profile
                                                        </a>
                                                    </div>
                                                </div> -->
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                    <div class="card bg-light d-flex flex-fill">
                                        <div class="card-header text-muted border-bottom-0">
                                            Radiology
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="lead"><b>Nama Dokter</b></h2>
                                                    <p class="text-muted text-sm"><b>About: </b> Web Designer /
                                                        UX / Graphic Artist / Coffee Lover </p>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-building"></i></span>
                                                            Address: Demo Street 123, Demo City 04312, NJ</li>
                                                        <li class="small"><span class="fa-li"><i
                                                                    class="fas fa-lg fa-phone"></i></span> Phone
                                                            #: + 800 - 12 12 23 52</li>
                                                    </ul>
                                                </div>
                                                <div class="col-5 text-center">
                                                    <img src="account.png" alt="user-avatar"
                                                        class="img-circle img-fluid">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="card-footer">
                                                    <div class="text-right">
                                                        <a href="#" class="btn btn-sm bg-teal">
                                                            <i class="fas fa-comments"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-user"></i> View Profile
                                                        </a>
                                                    </div>
                                                </div> -->
                                    </div>
                                </div>
                            </div>
                            <!-- /.col-md-6 -->
                            <div class="row">
                                <div class="col-md-6">
                                    <!-- timeline item -->
                                    <div>
                                        <div class="timeline-item">
                                            <div class="timeline-body">
                                                <div class="embed-responsive embed-responsive-16by9">
                                                    <iframe class="embed-responsive-item"
                                                        src="https://www.youtube.com/embed/tMWkeBIohBs"
                                                        allowfullscreen></iframe>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                </div>
                                <!-- /.card -->
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">Daftar Antrian</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">No.</th>
                                                        <th>Nama Pasien</th>
                                                        <th>Status</th>
                                                        <!-- <th style="width: 40px">Label</th> -->
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <div class="marquee-vertical">
                                                                <span>1</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="marquee-vertical">
                                                                <span>Update software</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="marquee-vertical">
                                                                <span><a class="btn btn-danger" href="#">Menunggu</a></span>
                                                                <span><a class="btn btn-warning" href="#">Proses</a></span>
                                                                <span><a class="btn btn-success" href="#">Selesai</a></span>
                                                            </div>
                                                        </td>
                                                        <!-- <td><span class="badge bg-danger">55%</span></td> -->
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                        <!-- <div class="card-footer clearfix">
                                            <ul class="pagination pagination-sm m-0 float-right">
                                                <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                                                <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                                <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                                            </ul>
                                        </div> -->
                                    </div>
                                    <!-- /.card -->

                                </div>

                            </div>
                            <!-- /.row -->
                        </div><!-- /.container-fluid -->
                    </div>
                    <!-- /.content -->
                </div>
                <!-- /.content-wrapper -->
            </div>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->

            <!-- Main Footer -->
            <!-- <footer class="main-footer">
                <div class="float-right d-none d-sm-inline">
                    Anything you want
                </div>
                <strong>Copyright &copy; PDE</strong> All
                rights
                reserved.
            </footer> -->
        </div>
        <!-- ./wrapper -->

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="{{asset('template/plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{asset('template/dist/js/adminlte.min.js?v=3.2.0')}}"></script>
</body>

</html>
