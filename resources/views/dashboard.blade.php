@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="font-heading text-heading text-gray-100">Dashboard</h2>
    <p class="text-gray-400 mt-2">Selamat datang, {{ Auth::user()->name }}!</p>
</div>
@endsection



