@extends('layouts.main')

@section('title', 'Profile')
@section('content')

    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="Welcome-text">
                    <span class="ml-1">Profile</span>
                </div>
            </div>
            <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Mobil</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Create</a></li>
                </ol>
            </div>
        </div>


        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible alert-alt solid fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                            class="mdi mdi-close"></i></span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li><strong>Warning!</strong> {{ $error }}. Silahkan Cek
                            Kembali.</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible alert-alt solid fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                            class="mdi mdi-close"></i></span>
                </button>
                <li><strong>Success!</strong> {{ session('success') }}</li>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible alert-alt solid fade show">
                <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i
                            class="mdi mdi-close"></i></span>
                </button>
                <li><strong>Warning!</strong> {{ session('warning') }}. Silahkan Cek
                    Kembali.</li>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tambah Data Mobil</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form text-dark">
                            <form action="{{ route('mobil.create') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Merek</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="merek"
                                            value="{{ old('merek')}}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Warna</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="warna"
                                            value="{{ old('warna')}}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Plat Nomor</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="plat_nomor"
                                            value="{{ old('plat_nomor')}}" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Foto</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="foto" required>
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
