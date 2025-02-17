
<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('translation.basic-tables'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<!-- Bootstrap 5 -->
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Styling untuk dropdown hasil pencarian */
        /* #result {
            position: absolute;
            width: 100%;
            background: white;
            border-radius: 5px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            max-height: 250px;
            overflow-y: auto;
            display: none;
        } */
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Tabel Pasien</h4>
                <div class="hstack gap-3 flex-wrap">
                    <a href="javascript:void(0);" class="link-success fs-15" data-bs-toggle="modal"
                        data-bs-target="#addData">Tambah Data</a>
                </div>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="live-preview">
                    <div class="table-responsive table-card">
                        <table class="table align-middle table-nowrap table-striped-columns mb-0">
                            <thead class="table-light">
                                <tr>
                                    <!-- <th scope="col" style="width: 46px;">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="cardtableCheck">
                                            <label class="form-check-label" for="cardtableCheck"></label>
                                        </div>
                                    </th> -->
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Lokasi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                    <!-- <th scope="col"></th> -->
                                    <th scope="col" style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <!-- <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="cardtableCheck01">
                                            <label class="form-check-label" for="cardtableCheck01"></label>
                                        </div>
                                    </td> -->
                                    <td><a href="#" class="fw-medium"><?php echo e($patient->PATIENT_ID); ?></a></td>
                                    <td><?php echo e($patient->PATIENT_NAME); ?></td>
                                    <td>
                                        <?php if($patient->PATIENT_SEX == 'F'): ?>
                                        Perempuan
                                        <?php else: ?>
                                        Laki - laki
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="badge bg-danger">Menunggu</span></td>
                                    <?php if(is_null($patient->ID_REPORT_RIS)): ?>
                                    <td></td>
                                    <?php else: ?>
                                    <td><span class="badge bg-warning">Proses</span></td>
                                    <?php endif; ?>
                                    <?php if(is_null($patient->ACCESSION_NO)): ?>
                                    <td></td>
                                    <?php else: ?>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <?php endif; ?>
                                    <td>
                                        <div class="hstack gap-3 flex-wrap">
                                            <a href="javascript:void(0);" class="link-success fs-15"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editPatient<?php echo e($patient->PATIENT_ID); ?>"><i
                                                    class="ri-edit-2-line"></i></a>
                                            <a href="javascript:void(0);" class="link-danger fs-15"
                                                data-bs-toggle="modal" data-bs-target="#myModal"><i
                                                    class="ri-delete-bin-line"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <div id="editPatient<?php echo e($patient->PATIENT_ID); ?>" class="modal fade" tabindex="-1"
                                    aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Edit Data Pasien</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mt-2">
                                                    <label for="placeholderInput" class="form-label">ID Pasien</label>
                                                    <input type="name" class="form-control" id="ID"
                                                        placeholder="ID Pasien"
                                                        value="<?php echo e(old('nama', $patient->PATIENT_ID)); ?>" disabled>
                                                </div>
                                                <div class="mt-2">
                                                    <label for="placeholderInput" class="form-label">Nama</label>
                                                    <input type="name" class="form-control" id="nama pasien"
                                                        placeholder="Nama Pasien"
                                                        value="<?php echo e(old('nama', $patient->PATIENT_NAME)); ?>">
                                                </div>
                                                <div class="mt-2">
                                                    <label for="exampleInputdate" class="form-label">Tanggal</label>
                                                    <input type="date" class="form-control" id="tanggal">
                                                </div>
                                                <div class="p-3 row">
                                                    <div class="col form-check mb-2">
                                                        <!-- <label for="exampleInputdate" class="form-label">Status</label> -->
                                                        <input class="form-check-input" type="checkbox" id="formCheck1">
                                                        <label class="form-check-label" for="formCheck1">
                                                            Status
                                                        </label>
                                                    </div>
                                                    <div class="col form-check mb-2">
                                                        <!-- <label for="exampleInputdate" class="form-label">Status</label> -->
                                                        <input class="form-check-input" type="checkbox" id="formCheck2">
                                                        <label class="form-check-label" for="formCheck2">
                                                            Status
                                                        </label>
                                                    </div>
                                                    <div class="col form-check mb-2">
                                                        <!-- <label for="exampleInputdate" class="form-label">Status</label> -->
                                                        <input class="form-check-input" type="checkbox" id="formCheck3">
                                                        <label class="form-check-label" for="formCheck3">
                                                            Status
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary ">Save Changes</button>
                                            </div>

                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Default Modals -->
                <div id="addData" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                    style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Tambah Data Pasien</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mt-2">
                                    <label for="placeholderInput" class="form-label">Nama</label>
                                    <input type="text" id="search" placeholder="Cari nama pasien..." autocomplete="off" class="form-control">
                                    <select name="antrian" id="hasil" class="form-select">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <!-- <div class="mt-2">
                                    <label for="placeholderInput" class="form-label">Nama</label>
                                    <input type="name" class="form-control" id="nama dokter"
                                        placeholder="Masukkan Nama Dokter">
                                </div> -->
                                <div class="mt-2">
                                    <label for="placeholderInput" class="form-label">ACCESSION NO</label>
                                    <input type="number" placeholder="Masukkan Accession Number" class="form-control">
                                    <!-- <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Laki - laki
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2">
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Perempuan
                                        </label>
                                    </div> -->
                                </div>
                                <!-- <div class="mt-2">
                                    <label for="placeholderInput" class="form-label">Status</label>
                                    <div class="p-2 row">
                                        <div class="col form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="formCheck1">
                                            <label class="form-check-label" for="formCheck1">
                                                Menunggu
                                            </label>
                                        </div>
                                        <div class="col form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="formCheck2">
                                            <label class="form-check-label" for="formCheck2">
                                                Proses
                                            </label>
                                        </div>
                                        <div class="col form-check mb-2">
                                            <input class="form-check-input" type="checkbox" id="formCheck3">
                                            <label class="form-check-label" for="formCheck3">
                                                Selesai
                                            </label>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="mt-2">
                                    <label for="exampleInputdate" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control" id="tanggal">
                                </div> -->
                                <!-- <div class="p-3 row">
                                    <div class="col form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck1">
                                        <label class="form-check-label" for="formCheck1">
                                            Status
                                        </label>
                                    </div>
                                    <div class="col form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck2">
                                        <label class="form-check-label" for="formCheck2">
                                            Status
                                        </label>
                                    </div>
                                    <div class="col form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="formCheck3">
                                        <label class="form-check-label" for="formCheck3">
                                            Status
                                        </label>
                                    </div>
                                </div> -->

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary ">Save Changes</button>
                            </div>

                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div>
                <!-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Standard
                    Modal</button> -->

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<!--jquery cdn-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--select2 cdn-->
<script src="<?php echo e(URL::asset('build/js/pages/form-advanced.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/form-input-spin.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            let query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: "antrian/search",
                    type: "GET",
                    data: { query: query },
                    success: function(data) {
                        let resultHtml = "";
                        if (data.length > 0) {
                            data.forEach(patient => {
                                resultHtml += `<option>${patient.PATIENT_ID}-${patient.PATIENT_NAME}</option>`;
                            });
                        } else {
                            resultHtml = "<div class='search-item text-muted'>Tidak ada hasil</div>";
                        }
                        $('#hasil').html(resultHtml).fadeIn();
                    }
                });
            } else {
                $('#hasil').fadeOut();
            }
        });

        // Klik hasil pencarian untuk mengisi input
        $(document).on('click', '.search-item', function() {
            $('#search').val($(this).text());
            $('#hasil').fadeOut();
        });

        // Klik di luar input untuk menyembunyikan hasil
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#search, #hasil').length) {
                $('#hasil').fadeOut();
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.layout-horizontal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp82\htdocs\rsud-dev\resources\views/antrian/tables/pasien/index.blade.php ENDPATH**/ ?>