@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('content')

<div class="grid grid-cols-2 gap-6">

    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-yellow-500">Menunggu</p>
        <h2 class="text-3xl font-bold mt-2 text-yellow-600">
            {{ $menunggu }}
        </h2>
    </div>

    <div class="bg-white p-6 rounded-xl shadow">
        <p class="text-green-500">Disetujui</p>
        <h2 class="text-3xl font-bold mt-2 text-green-600">
            {{ $disetujui }}
        </h2>
    </div>

</div>

@endsection