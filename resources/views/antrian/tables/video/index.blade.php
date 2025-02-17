@extends('layout.layout-horizontal')
@section('title')
@lang('translation.basic-tables')
@endsection
@section('content')

<!-- Ratio Video 21:9 -->
<div class="ratio ratio-21x9">
    @foreach($data as $row)
    <video class="rounded" width="640" height="360" autoplay loop controls muted>
        <!-- <a href="{{ asset('storage/' . $row->videos) }}"></a> -->
        <source src="{{ Storage::url($row->path) }}" type="video/mp4">
        Browser Anda tidak mendukung video.
    </video>
    @endforeach
</div>

<div class="row mt-2">
    <div class="col-xl-12">
        <div class="card">
            <!-- <div class="card-header align-items-center d-flex">
                <a href="javascript:void(0);" class="link-success fs-15" data-bs-toggle="modal"
                    data-bs-target="#addData">Tambah Data</a>
                <h4 class="card-title mb-0 flex-grow-1">Tabel Pasien</h4>
            </div> -->

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
                                    <!-- <th scope="col">ID</th> -->
                                    <th scope="col">Path</th>
                                    <!-- <th scope="col">Tanggal</th> -->
                                    <!-- <th scope="col">Status</th> -->
                                    <th scope="col" style="width: 150px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <!-- <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="cardtableCheck01">
                                            <label class="form-check-label" for="cardtableCheck01"></label>
                                        </div>
                                    </td> -->
                                    <!-- <td><a href="#" class="fw-medium">#VL2110</a></td> -->
                                    <td>{{$row->path}}</td>
                                    <!-- <td>07 Oct, 2021</td> -->
                                    <!-- <td><span class="badge bg-success">Paid</span></td> -->
                                    <td>
                                        <div class="hstack gap-3 flex-wrap">
                                            <a href="javascript:void(0);" class="link-success fs-15"
                                                data-bs-toggle="modal" data-bs-target="#myModal"><i
                                                    class="ri-edit-2-line"></i></a>
                                            <!-- <a href="javascript:void(0);" class="link-danger fs-15"
                                                data-bs-toggle="modal" data-bs-target="#myModal"><i
                                                    class="ri-delete-bin-line"></i></a> -->
                                        </div>
                                    </td>
                                </tr>
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
                                <h5 class="modal-title" id="myModalLabel">Tambah File Video</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>

                            <form action="{{route('videos.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">

                                                <div class="card-body">

                                                    <input type="file" class="form-control" id="path" name="path"
                                                        placeholder="Path Video">

                                                    <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                        <li class="mt-2" id="dropzone-preview-list">
                                                            <!-- This is used as the file preview template -->
                                                            <div class="border rounded">
                                                                <div class="d-flex p-2">
                                                                    <div class="flex-shrink-0 me-3">
                                                                        <div class="avatar-sm bg-light rounded">
                                                                            <img data-dz-thumbnail
                                                                                class="img-fluid rounded d-block"
                                                                                src="{{URL::asset('build/images/new-document.png')}}"
                                                                                alt="Dropzone-Image" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <div class="pt-1">
                                                                            <h5 class="fs-14 mb-1" data-dz-name>&nbsp;
                                                                            </h5>
                                                                            <p class="fs-13 text-muted mb-0"
                                                                                data-dz-size>
                                                                            </p>
                                                                            <strong class="error text-danger"
                                                                                data-dz-errormessage></strong>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-3">
                                                                        <button data-dz-remove
                                                                            class="btn btn-sm btn-danger">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <!-- end dropzon-preview -->
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary ">Save Changes</button>
                                </div>
                            </form>
                        </div><!-- /.modal-content -->

                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
                    style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">Edit File Video</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <form action="{{ route('videos.update', $row->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">

                                                <div class="card-body">

                                                    <input type="file" class="form-control"
                                                        value="{{ old('path', $row->path) }}" name="path" id="path">
                                                    <!-- end dropzon-preview -->
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div> <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary ">Save Changes</button>
                                </div>
                            </form>

                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            </div><!-- end card-body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div><!-- end row -->

@endsection
@section('script')
<script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/form-file-upload.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
<script>
    document.getElementById('path').addEventListener('change', function (event) {
        var file = event.target.files[0];
        var videoPreview = document.getElementById('video-preview');

        if (file && file.type.includes('video')) {
            var fileURL = URL.createObjectURL(file);
            if (!videoPreview) {
                videoPreview = document.createElement('video');
                videoPreview.setAttribute('id', 'video-preview');
                videoPreview.setAttribute('class', 'rounded mt-2');
                videoPreview.setAttribute('width', '640');
                videoPreview.setAttribute('height', '360');
                videoPreview.setAttribute('controls', 'true');

                event.target.parentNode.appendChild(videoPreview);
            }
            videoPreview.src = fileURL;
        }
    });

</script>

@endsection
