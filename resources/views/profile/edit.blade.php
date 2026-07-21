@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-16">
    <div class="max-w-2xl mx-auto">
        <h1 class="text-lg font-bold text-primary mb-8">Profile</h1>

        <div class="space-y-6">
            <div class="bg-card border border-subtle rounded-xl p-6">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-card border border-subtle rounded-xl p-6">
                @include('profile.partials.update-password-form')
            </div>

            <div class="bg-card border border-subtle rounded-xl p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection






