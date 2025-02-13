<?php $__env->startSection('title'); ?>
RSUD BANGIL
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>

        <div class="shape">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 0 1440 120">
                <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="text-center mb-0 text-white-50">
                        <div>
                            <a href="index" class="d-inline-block auth-logo">
                                <img src="<?php echo e(URL::asset('images/rsud.png')); ?>" alt="" height="130">
                            </a>
                        </div>
                        <p class="mt-3 fs-23 text-dark fw-bolder">RSUD BANGIL</p>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-md-3 col-lg-3 col-xl-3 border-danger">
                    <div class="card pricing-box ribbon-box right border card-border-danger">
                        <div class="card-body p-4">
                            <!-- <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div> -->
                            <a href="<?php echo e(url('bed/list')); ?>">
                                <div class="p-4">
                                    <img src="<?php echo e(asset('images/icon/double-bed.png')); ?>" class="img-fluid mx-auto" />
                                </div>
                                <div>
                                    <div class="text-center">
                                        <h3 class="text-dark">Display Bed</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-lg-3 col-xl-3 border-danger">
                    <div class="card pricing-box ribbon-box right border card-border-danger">
                        <div class="card-body p-4">
                            <!-- <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div> -->
                            <a href="<?php echo e(url('bed/list')); ?>">
                                <div class="p-4">
                                    <img src="<?php echo e(asset('images/icon/x-ray.png')); ?>" class="img-fluid mx-auto" />
                                </div>
                                <div>
                                    <div class="text-center">
                                        <h3 class="text-dark">Antrian Radiology</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-lg-3 col-xl-3 border-danger">
                    <div class="card pricing-box ribbon-box right border card-border-danger">
                        <div class="card-body p-4">
                            <!-- <div class="ribbon-two ribbon-two-danger"><span>Popular</span></div> -->
                            <a href="<?php echo e(url('bed/list')); ?>">
                                <div class="p-4">
                                    <img src="<?php echo e(asset('images/icon/double-bed.png')); ?>" class="img-fluid mx-auto" />
                                </div>
                                <div>
                                    <div class="text-center">
                                        <h3 class="text-dark">Laboratorium</h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <script>
                            document.write(new Date().getFullYear())
                        </script> RSUD Bangil. Crafted with <i class="mdi mdi-heart text-danger"></i></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
<script src="<?php echo e(URL::asset('build/libs/particles.js/particles.js')); ?>"></script>
<script src="<?php echo e(URL::asset('build/js/pages/particles.app.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master-without-nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH G:\xampp82\htdocs\rsud\resources\views/portal.blade.php ENDPATH**/ ?>