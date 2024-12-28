@extends('layouts.main')
@section('title', 'Home Page')
@section('content')
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row page-titles mx-0">
                <div class="col-sm-6 p-md-0">
                    <div class="welcome-text">
                        <h4>Rental Mobil -> {{ $rentalMobil->nama_rental }}</h4>
                        <center>
                            <img class="card-img-top img-fluid m-4" src="{{ asset('/storage/' . $rentalMobil->foto) }}"
                                style="width: auto; height:300px;" alt="Card image cap">
                        </center>
                        <p class="card-text text-dark">{{ $rentalMobil->deskripsi }}</p>
                    </div>
                </div>
            </div>
            <d class="row">
                @foreach ($mobils as $mobil)
                    <div class="col-xl-4 col-xxl-6 col-lg-6 col-sm-6">
                        <div class="card mb-3">
                            <img class="card-img-top img-fluid" src="{{ asset('/storage/' . $mobil->foto) }}"
                                style="width: auto; height: 300px;" alt="Card image cap">
                            <div class="card-header">
                                <h5 class="card-title">{{ $mobil->merek }}</h5>
                            </div>
                            <div class="card-body">
                                <p class="card-text text-dark">Alamat : {{ $mobil->rentalMobil->alamat }}</p>
                                <p class="card-text text-dark">Kontak Owner : {{ $mobil->rentalMobil->no_hp }} /<a 
                                    href="{{route('rental.view', $mobil->rentalMobil->id)}}">{{$mobil->rentalMobil->nama_rental}}</a>
                                </p>
                                <a href="{{route('booking.mobil', $mobil->id)}}" 
                                    class="btn btn-primary float-right">Check</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection