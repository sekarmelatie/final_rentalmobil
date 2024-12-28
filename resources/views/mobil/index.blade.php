@extends('layouts.main')

@section('title', 'Mobil')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <span class="ml-1">Mobil</span>
                </div>
            </div>
                        <!-- <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0)">Table</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:void(0)">Datatable</a></li>
                            </ol>
                        </div> -->
        </div>
        <!-- row -->

        @if (session('success'))
            <div class="alert alert-success alert-dismissible alert-alt solid fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                            class="mdi mdi-close"></i></span>
                </button>
                <li><strong>Success!</strong> {{ session('success') }}.</li>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Data Mobil</h4>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('mobil.create') }}" class="btn btn-primary">Create</a>

                        <div class="table-responsive">
                            <table id="table-mobil" class="display nowrap text-dark" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Merek</th>
                                        <th>Plat Nomor</th>
                                        <th>Warna</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($mobils as $mobil)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $mobil->merek }}</td>
                                            <td>{{ $mobil->plat_nomor }}</td>
                                            <td>{{ $mobil->warna }}</td>
                                            <td><img src="{{ asset('/storage/' . $mobil->foto) }}" alt="foto"
                                                    style="width: 200px; height:100px;"></td>
                                            <td>
                                                <form action="{{route('mobil.delete' , $mobil->id) }}" method="post">
                                                    @csrf
                                                    @method('delete')

                                                    <a href="{{ route('mobil.edit' , $mobil->id) }}"
                                                        class="btn btn-warning">Edit</a>

                                                    <button class="btn btn-danger" onclick="return confirm('Anda Yakin Hapus Data ini!')">Delete</button>
                                                </form>
                                            </td>
                                        </tr> 
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Merek</th>
                                        <th>Plat Nomor</th>
                                        <th>Warna</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        new DataTable('#table-mobil', {
            responsive: true,
            rowReorder: {
                selector: 'td:nth-child(2)'
            }
        });
    </script>
@endpush
