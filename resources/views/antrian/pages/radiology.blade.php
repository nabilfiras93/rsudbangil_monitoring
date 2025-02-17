@extends('layout.layouts-horizontal')
@section('title')
@lang('translation.horizontal')
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet">
<style>
    /* Card ukuran 100% */
    .full-card {
        width: 100%;
        height: 100vh;
        /* Full tinggi layar */
    }

    .doctor-card {
        width: 100%;
        height: 50vh;
        /* Full tinggi layar */
    }

    /* Membuat tabel bisa di-scroll */
    .table-container {
        height: 288px;
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
@endsection
@section('content')

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

<!-- <div class="row">
    <div class="col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Jumlah Antrian</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                data-target="28.05">{{$jumlah->count()}}</span> Orang</h2>
                        <p class="mb-0 text-muted"><span class="badge bg-light text-success mb-0">
                            </span> </p>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-users text-info">
                                    <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="9" cy="7" r="4"></circle>
                                    <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <div class="col-md-6">
        <div class="card card-animate">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-muted mb-0">Nomor Antrian</p>
                        <h2 class="mt-4 ff-secondary fw-semibold"><span class="counter-value"
                                data-target="97.66">0</span>k</h2>
                        <p class="mb-0 text-muted"><span class="badge bg-light text-danger mb-0">
                                <i class="ri-arrow-down-line align-middle"></i> 3.96 %
                            </span> vs. previous month</p>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-info-subtle rounded-circle fs-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-clock text-info">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>  -->

<div class="row">
    <div class="col-lg-12">
        <div class="swiper cryptoSlider">
            <div class="swiper-wrapper">
                @foreach($doctors as $doctor)
                <div class="swiper-slide">
                    <div class="card doctor-card">
                        <div class="card-body">
                            <div class="row align-items-end g-0">
                                <div class="col-12 d-flex align-items-center">
                                    <img src="{{asset('antrian/account.png')}}" alt=""
                                        class="avatar-xs rounded-circle me-2">
                                        <a href="#javascript: void(0);" class="text-body fw-medium">{{$doctor->nama}} {{$doctor->gelar_belakang}}</a>
                                </div>
                                <div class="col-6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6">
        <div class="ratio ratio-16x9">
            <video class="rounded" width="640" height="360" autoplay loop controls muted>
                <source src="{{ asset('antrian/video.mp4') }}" type="video/mp4">
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
                                @foreach($data as $row)
                                <tr>
                                    <th scope="row">{{$row->PATIENT_ID}}</th>
                                    <td>{{$row->PATIENT_NAME}}</td>
                                    <!-- <td>Industrial Designer</td> -->
                                    <!-- <td>10, Nov 2021</td> -->

                                    <td><span class="badge bg-danger">Menunggu</span></td>
                                    @if(is_null($row->ID_REPORT_RIS))
                                    <td></td>
                                    @else
                                    <td><span class="badge bg-warning">Proses</span></td>
                                    @endif
                                    @if(is_null($row->ACCESSION_NO))
                                    <td></td>
                                    @else
                                    <td><span class="badge bg-success">Selesai</span></td>
                                    @endif
                                    <!-- <td>
                                        <div class="hstack gap-3 fs-15">
                                            <a href="javascript:void(0);" class="link-primary"><i
                                                    class="ri-settings-4-line"></i></a>
                                            <a href="javascript:void(0);" class="link-danger"><i
                                                    class="ri-delete-bin-5-line"></i></a>
                                        </div>
                                    </td> -->
                                </tr>
                                @endforeach
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

@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/dashboard-crypto.init.js') }}"></script>
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
