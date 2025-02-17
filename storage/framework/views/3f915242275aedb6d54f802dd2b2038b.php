<?php $__env->startSection('title'); ?>
<?php echo app('translator')->get('translation.horizontal'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<link href="<?php echo e(URL::asset('build/libs/swiper/swiper-bundle.min.css')); ?>" rel="stylesheet">
<link href="<?php echo e(URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')); ?>" rel="stylesheet">
<style>
    /* Card ukuran 100% */
    .full-card {
        width: 100%;
        height: 100vh;
        /* Full tinggi layar */
    }

    /* Membuat tabel bisa di-scroll */
    .table-container {
        height: 290px;
        /* Sesuaikan tinggi tabel */
        overflow-y: hidden;
        /* Hanya scroll ke bawah */
        overflow-x: hidden;
        /* Tidak ada scroll ke samping */
    }

    /* Fixed table layout for consistent column widths */
    .table-fixed {
        table-layout: fixed;
        width: 100%;
    }

    /* Running text animation */
    .running-text {
        position: relative;
        animation: scrollUp 15s linear infinite;
    }

    /* Keyframes for scrolling */
    @keyframes scrollUp {
        0% {
            transform: translateY(0%);
        }

        100% {
            transform: translateY(-100%);
        }
    }

    /* Keep <thead> static */
    thead {
        position: sticky;
        top: 0;
        background-color: white;
        z-index: 1;
    }

    /* Pusatkan teks dalam header */
    thead th {
        /* text-align: center;  */
        vertical-align: middle;
        /* Pusatkan vertikal */
    }

</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<!-- <div class="card">
    <div class="card-body">
        <div class="row g-2">
            <div class="col-sm-4">
                <div class="search-box">
                    <input type="text" class="form-control" id="searchMemberList"
                        placeholder="Search for name or designation...">
                    <i class="ri-search-line search-icon"></i>
                </div>
            </div>
            <div class="col-sm-auto ms-auto">
                <div class="list-grid-nav hstack gap-1">
                    <button type="button" id="grid-view-button"
                        class="btn btn-soft-info nav-link btn-icon fs-14 active filter-button"><i
                            class="ri-grid-fill"></i></button>
                    <button type="button" id="list-view-button"
                        class="btn btn-soft-info nav-link  btn-icon fs-14 filter-button"><i
                            class="ri-list-unordered"></i></button>
                    <button type="button" id="dropdownMenuLink1" data-bs-toggle="dropdown" aria-expanded="false"
                        class="btn btn-soft-info btn-icon fs-14"><i class="ri-more-2-fill"></i></button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                        <li><a class="dropdown-item" href="#">All</a></li>
                        <li><a class="dropdown-item" href="#">Last Week</a></li>
                        <li><a class="dropdown-item" href="#">Last Month</a></li>
                        <li><a class="dropdown-item" href="#">Last Year</a></li>
                    </ul>
                    <button class="btn btn-success addMembers-modal" data-bs-toggle="modal"
                        data-bs-target="#addmemberModal"><i class="ri-add-fill me-1 align-bottom"></i> Add
                        Members</button>
                </div>
            </div>
        </div>
    </div>
</div> -->

<div class="row">
    <div class="col-lg-12">
        <div class="swiper cryptoSlider">
            <div class="swiper-wrapper">
                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="swiper-slide">
                    <div class="card doctor-card">
                        <div class="card-body">
                            <div class="row align-items-end g-0">
                                <div class="col-12 d-flex align-items-center">
                                    <img src="<?php echo e(asset('antrian/account.png')); ?>" alt=""
                                        class="avatar-xs rounded-circle me-2">
                                        <a href="#javascript: void(0);" class="text-body fw-medium"><?php echo e($doctor->nama); ?> <?php echo e($doctor->gelar_belakang); ?></a>
                                </div>
                                <div class="col-6">
                                    <!-- <p class="text-success fw-medium mb-0">+13.11%<span
                                            class="text-muted ms-2 text-uppercase">(btc)</span></p> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6">
        <div class="ratio ratio-16x9">
            <video class="rounded" width="640" height="360" autoplay loop controls muted>
                <source src="<?php echo e(asset('antrian/video.mp4')); ?>" type="video/mp4">
                Browser Anda tidak mendukung video tag.
            </video>
        </div>
    </div>

    <div class="col-xl-6">
        <div class="card full-card">
            <!-- <div class="card-header">
                <h4>Daftar antrian</h4>
            </div> -->
            <div class="card-body">

                <div class="table-container">
                    <div class="table-responsive table-card">
                        <!-- Tables Without Borders -->
                        <table class="table table-borderless table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                    <!-- <th scope="col"></th> -->
                                </tr>
                            </thead>
                            <tbody class="running-text">
                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($row->PATIENT_ID); ?></th>
                                    <td><?php echo e($row->PATIENT_NAME); ?></td>
                                    <!-- <td>Industrial Designer</td> -->
                                    <!-- <td>10, Nov 2021</td> -->
                                    
                                    <td><span class="badge bg-danger">Menunggu</span></td>
                                    <?php if(is_null($row->ID_REPORT_RIS)): ?>
                                    <td></td>
                                    <?php else: ?>
                                    <td><span class="badge bg-warning">Proses</span></td>
                                    <?php endif; ?>
                                    <?php if(is_null($row->ACCESSION_NO)): ?>
                                    <td></td>
                                    <?php else: ?>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    <?php endif; ?>
                                    <!-- <td>
                                        <div class="hstack gap-3 fs-15">
                                            <a href="javascript:void(0);" class="link-primary"><i
                                                    class="ri-settings-4-line"></i></a>
                                            <a href="javascript:void(0);" class="link-danger"><i
                                                    class="ri-delete-bin-5-line"></i></a>
                                        </div>
                                    </td> -->
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="d-none code-view">
                    <pre class="language-markup" style="height: 275px;"><code>&lt;!-- Bordered Tables --&gt;

                </div>
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/js/pages/dashboard-crypto.init.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/libs/prismjs/prism.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.layout-horizontal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp82\htdocs\rsud-dev\resources\views/antrian/dashboard.blade.php ENDPATH**/ ?>