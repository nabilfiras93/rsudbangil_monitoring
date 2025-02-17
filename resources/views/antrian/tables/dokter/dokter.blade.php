@extends('layout.layout-horizontal')
@section('title')
@lang('translation.basic-tables')
@endsection
@section('content')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Tabel Dokter</h4>
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
                                    <th scope="col">Foto</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Gelar Belakang</th>
                                    <th scope="col" style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctors as $doctor)
                                <tr>
                                    <!-- <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="cardtableCheck01">
                                            <label class="form-check-label" for="cardtableCheck01"></label>
                                        </div>
                                    </td> -->
                                    <td>
                                        <a href="#" class="fw-medium">{{$doctor->id}}</a>
                                    </td>
                                    <td>
                                        <img src="{{asset('antrian/account.png')}}" alt=""
                                            class="avatar-xs rounded-circle me-2">
                                    </td>
                                    <td>{{$doctor->nama}}</td>
                                    <td>{{$doctor->gelar_belakang}}</td>
                                    <!-- <td><span class="badge bg-success">Paid</span></td> -->
                                    <td>
                                        <div class="hstack gap-3 flex-wrap">
                                            <a href="#" class="link-success fs-15" data-bs-toggle="modal"
                                                data-bs-target="#editDokter{{$doctor->id}}"><i
                                                    class="ri-edit-2-line"></i></a>
                                            <a href="javascript:void(0);" class="link-danger fs-15"
                                                data-bs-toggle="modal" data-bs-target="#myModal"><i
                                                    class="ri-delete-bin-line"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <div id="editDokter{{$doctor->id}}" class="modal fade" tabindex="-1"
                                    aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel">Edit Data Dokter</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mt-2">
                                                    <label>Foto Dokter</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="form-control"
                                                            value="{{asset('antrian/account.png')}}" name="foto"
                                                            id="exampleInputFile">
                                                        <label class="custom-file-label"
                                                            for="exampleInputFile"></label>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <label for="placeholderInput" class="form-label">Nama Dokter</label>
                                                    <input type="name" class="form-control" id="nama dokter"
                                                        placeholder="Nama Dokter"
                                                        value="{{ old('nama', $doctor->nama) }}">
                                                </div>
                                                <div class="mt-2">
                                                    <label for="placeholderInput" class="form-label">Gelar
                                                        Belakang</label>
                                                    <input type="name" class="form-control" id="gelar belakang"
                                                        placeholder="Gelar Belakang"
                                                        value="{{ old('gelar_belakang', $doctor->gelar_belakang) }}">
                                                </div>
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
                                                <button type="button" class="btn btn-light"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary ">Save Changes</button>
                                            </div>

                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Default Modals -->
                <!-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal">Standard
                    Modal</button> -->
                <div id="addData" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                    style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Tambah Data Dokter</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="mt-2">
                                    <label for="placeholderInput" class="form-label">Foto</label>
                                    <input type="file" class="form-control" id="foto"
                                        placeholder="Masukkan File Foto">
                                </div>
                                <div class="mt-2">
                                    <label for="placeholderInput" class="form-label">Nama</label>
                                    <input type="name" class="form-control" id="nama dokter"
                                        placeholder="Masukkan Nama Dokter">
                                </div>
                                <div class="mt-2">
                                    <label for="placeholderInput" class="form-label">Gelar Belakang</label>
                                    <input type="name" class="form-control" id="gelar belakang"
                                        placeholder="Masukkan Gelar Belakang">
                                </div>
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
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>

<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
