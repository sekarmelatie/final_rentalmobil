@extends('layouts.main')

@section('title', 'Riwayat Transaksi')
@section('content')
    <div class="container-fluid">
        <div class="row page-titles mx-0">
            <div class="col-sm-6 p-md-0">
                <div class="welcome-text">
                    <span class="ml-1">Riwayat Transaksi</span>
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
                        <h4 class="card-title">Riwayat</h4>
                    </div>
                    <div class="card-body">

                        <div class="table-responsive">
                            <table id="table-mobil" class="display nowrap text-dark" style="width:100%">
                                @php 
                                    $rolesUser = [];

                                    if (auth()->user()) {
                                        foreach (auth()->user()->roles as $item){
                                            array_push($rolesUser, $item->kode_role);
                                        }
                                    }
                                @endphp
                                @if (in_array('ADM', $rolesUser))
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Merek</th>
                                            <th>Plat Nomor</th>
                                            <th>Warna</th>
                                            <th>Foto</th>
                                            <th>Costumer</th>
                                            <th>No Telp</th>
                                            <th>Tgl Peminjaman</th>
                                            <th>Tgl Pengembalian</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayats as $riwayat)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $riwayat->mobil->merek }}</td>
                                                <td>{{ $riwayat->mobil->plat_nomor }}</td>
                                                <td>{{ $riwayat->mobil->warna }}</td>
                                                <td>
                                                    <img src="{{ asset('/storage/' . $riwayat->mobil->foto) }}"
                                                        alt="foto" style="width: 100px; height:100px;">
                                                </td>
                                                <td>{{ $riwayat->user->konsumen->nama }}</td>
                                                <td>{{ $riwayat->user->konsumen->no_hp }}</td>
                                                <td>{{ $riwayat->tgl_peminjaman }}</td>
                                                <td>{{ $riwayat->tgl_pengembalian }}</td>
                                                <td>{{ $riwayat->status }}</td>
                                                <td>
                                                    @if ($riwayat->status == 'pending')
                                                        <a href="{{ route('approve', $riwayat->id) }}"
                                                            class="btn btn-success">Approve</a>
                                                    @elseif ($riwayat->status == 'Berjalan')
                                                        <a href="{{ route('approve', $riwayat->id) }}"
                                                            class="btn btn-primary">Selesai</a>
                                                    @else
                                                        Tidak Ada Aksi
                                                    @endif
                                                </td>
                                            </tr> 
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Merek</th>
                                            <th>Plat Nomor</th>
                                            <th>Warna</th>
                                            <th>Foto</th>
                                            <th>Costumer</th>
                                            <th>No Telp</th>
                                            <th>Tgl Peminjaman</th>
                                            <th>Tgl Pengembalian</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                @elseif (in_array('CST', $rolesUser))
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Merek</th>
                                            <th>Plat Nomor</th>
                                            <th>Warna</th>
                                            <th>Foto</th>
                                            <th>Tgl Peminjaman</th>
                                            <th>Tgl Pengembalian</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayats as $riwayat)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $riwayat->mobil->merek }}</td>
                                                <td>{{ $riwayat->mobil->plat_nomor }}</td>
                                                <td>{{ $riwayat->mobil->warna }}</td>
                                                <td>
                                                    <img src="{{ asset('/storage/' . $riwayat->mobil->foto) }}"
                                                        alt="foto" style="width: 100px; height:100px;">
                                                </td>
                                                <td>{{ $riwayat->tgl_peminjaman }}</td>
                                                <td>{{ $riwayat->tgl_pengembalian }}</td>
                                                <td>{{ $riwayat->status }}</td>
                                                <td>
                                                    @if ($riwayat->status == 'pending')
                                                        <form action="{{ route('booking.batalkan', $riwayat->id) }}"
                                                            method="post">
                                                            @csrf
                                                            @method('delete')

                                                            <button class="btn btn-warning"
                                                                onclick="return confirm('Anda Yakin membatalkan ini!')">
                                                                Batalkan</button>
                                                        </form>
                                                    @else
                                                        Tidak Ada Aksi
                                                    @endif
                                                </td>
                                            </tr> 
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Merek</th>
                                            <th>Plat Nomor</th>
                                            <th>Warna</th>
                                            <th>Foto</th>
                                            <th>Tgl Peminjaman</th>
                                            <th>Tgl Pengembalian</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                @endif

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
