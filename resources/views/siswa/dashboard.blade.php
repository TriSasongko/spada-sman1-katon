@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Siswa</h1>
    <p>Selamat datang, {{ auth()->user()->name }}</p>
</div>
@endsection
