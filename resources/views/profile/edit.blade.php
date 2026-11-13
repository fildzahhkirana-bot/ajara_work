@extends('layouts.app')
@section('title','Data Akun')
@section('content')
<div class="mx-auto min-h-screen max-w-xl px-5 pb-28 pt-7"><a href="{{ route('profile.show') }}" class="text-sm text-ajara-700">← Kembali ke profil</a><h1 class="mt-5 text-2xl font-bold">Data Akun</h1>
<form method="POST" action="{{ route('profile.update') }}" class="mt-6 space-y-4 rounded-2xl bg-white p-5 soft-shadow">@csrf @method('PUT')
@foreach(['name'=>'Nama Lengkap','nim'=>'NIM','email'=>'Email'] as $field=>$label)<label class="block text-sm font-medium">{{ $label }}<input name="{{ $field }}" value="{{ old($field,auth()->user()->$field) }}" required class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm">@error($field)<span class="text-xs text-red-600">{{ $message }}</span>@enderror</label>@endforeach
<button class="w-full rounded-xl bg-ajara-700 py-3 font-semibold text-white">Simpan Perubahan</button></form></div>
@include('partials.bottom-nav')
@endsection
