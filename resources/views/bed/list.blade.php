@extends('layouts.layouts-horizontal-only-topbar')
@section('title')
    Monitoring Kamar Tidur Pasien
@endsection
@section('content')
    
    <div class="row">
        <div class="col-xl-12">
            <div id="showRuangan"></div>
        </div>
    </div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        checkCollapse()
        getDataBed().then(res => {
            let showAll = '';

            if(Object.keys(res.data).length > 0){
                Object.entries(res.data).forEach(([namaRuangan, arrKamar]) => {
                    let showKamar = '';
                    let namaRuangan2 = namaRuangan.replace(/ /g,"_");

                    Object.entries(arrKamar).forEach(([namaKamar, v]) => {
                        let showBedKamar = '';
                        let showInfo = '';
                        Object.entries(v).forEach(([key, val]) => {
                            let kelas = (val.kelas==null) ? '' : val.kelas;
                            let bed = val.jumlah_tt;
                            showInfo += `
                                <div class="badge bg-warning text-dark fs-15 mb-1">Kelas(${kelas}) = ${bed}</div>
                            `;
                            for (let i = 1; i<=parseInt(bed); i++) {
                                showBedKamar += `<button type="button" class="mb-1 me-1 btn btn-danger text-dark fw-bold">${kelas} | Bed ${i}</button>`;
                            }
                        });

                        showKamar += `<div class="col-xxl-3 col-sm-6">
                            <div class="card profile-project-card shadow-none profile-project-warning">
                                <div class="card-body p-2">
                                    <div class="text-center mb-2">
                                        <div class="badge bg-info text-dark fs-15 d-center mb-3">${namaKamar}</div><br>
                                        ${showInfo}
                                    </div>
                                    <div class="d-flex">
                                        <div class="flex-grow-1 text-muted overflow-hidden">
                                            ${showBedKamar}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    });

                    showAll += `
                        <div class="card">
                            <div class="card-header bg-success">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 text-center">
                                        <a data-bs-toggle="collapse" href="#collapse${namaRuangan2}" role="button" aria-expanded="false" class="collapseButton"><h6 class="card-title mb-0 text-dark">Ruang ${namaRuangan}</h6></a>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <ul class="list-inline card-toolbar-menu d-flex align-items-center mb-0">
                                            <li class="list-inline-item">
                                                <a class="align-middle text-dark" href="javascript:void(0);" data-toggle="customer-loader">
                                                    <i class="mdi mdi-refresh align-middle"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body collapse show" id="collapse${namaRuangan2}">
                                <div class="card">
                                    <div class="row">
                                            ${showKamar}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }
            $(`#showRuangan`).html(showAll);
        });
    });

    const getDataBed = async (attempt = 1) => {
        let retry = 3;
        try {
            let url = "{{ url('dashboard/bed') }}";
            const response = await fetch(url, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
            });
            if (response.status != 200) {
                throw new Error(`HTTP Error: ${response.status}`);
            }
            const res = await response.json();
            return res;
        } catch (error) {
            if (attempt < retry) {
                attempt++;
                getDataBed(attempt)
            }
        }
    };


    const checkCollapse = async () => {
        let collapse = ['collapseAnggrek'];
        $.each(collapse, function(i, val){
            if(localStorage.getItem(`#${val}`)){
                $(`#${val}`).addClass('show');
            } else {
                $(`#${val}`).removeClass('show');
            }
        });
    }

    $(".collapseButton").click(function () {
        let id = $(this).attr('href');
        if(localStorage.getItem(id)){
            localStorage.removeItem(id);
        } else {
            localStorage.setItem(id, 'true');
        }
    });
</script>
@endsection