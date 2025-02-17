@extends('layouts.master')
@section('title')
    RSUD Bangil
@endsection
@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card rounded-0 bg-success-subtle mx-n4 mt-n4 border-top">
                <div class="px-4">
                    <div class="row">
                        <div class="col-xxl-5 align-self-center">
                            <div class="py-4">
                                <h4 class="display-6 coming-soon-text">Selamat Datang</h4>
                                <p class="text-muted fs-15 mt-3">Sistem Monitoring RSUD Bangil</p>
                                <div class="hstack flex-wrap gap-2">
                                    <!-- <button type="button" class="btn btn-primary btn-label rounded-pill"><i
                                            class="ri-mail-line label-icon align-middle rounded-pill fs-16 me-2"></i> Email
                                        Us</button>
                                    <button type="button" class="btn btn-info btn-label rounded-pill"><i
                                            class="ri-twitter-line label-icon align-middle rounded-pill fs-16 me-2"></i>
                                        Send Us Tweet</button> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 ms-auto">
                            <div class="mb-n5 pb-1 faq-img d-none d-xxl-block">
                                <img src="{{ URL::asset('build/images/faq-img.png') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>

@endsection

@section('script')

@endsection