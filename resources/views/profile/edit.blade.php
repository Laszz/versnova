@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="font-heading text-heading text-gray-100 mb-8">Profile</h1>

    <div class="space-y-6 max-w-2xl">
        <div class="bg-surface border border-outline rounded-card p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-surface border border-outline rounded-card p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-surface border border-outline rounded-card p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>
@endsection
