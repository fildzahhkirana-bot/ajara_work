@extends('layouts.app')
@section('title','Profil')
@section('content')
<div class="mx-auto min-h-screen max-w-3xl px-5 pb-28 pt-7"><h1 class="text-2xl font-bold">Profil</h1>
<div class="mt-6 flex flex-col items-center rounded-2xl bg-white p-7 soft-shadow"><div class="flex h-20 w-20 items-center justify-center rounded-full bg-ajara-100 text-3xl font-bold text-ajara-800">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div><h2 class="mt-3 text-lg font-bold">{{ auth()->user()->name }}</h2><p class="text-sm text-slate-500">Mahasiswa · {{ auth()->user()->nim }}</p></div>
<div class="mt-5 overflow-hidden rounded-2xl bg-white soft-shadow">@foreach([['profile.edit','person-vcard','Data Akun'],['#','clipboard-check','Riwayat Pendaftaran'],['#','heart','Favorit'],['#','gear','Pengaturan'],['#','question-circle','Bantuan']] as [$url,$icon,$label])<a href="{{ $url==='#'?'javascript:void(0)':route($url) }}" class="flex items-center justify-between border-b border-slate-100 px-4 py-4 last:border-0"><span class="flex items-center gap-3 text-sm font-medium"><i class="bi bi-{{ $icon }} text-lg text-ajara-700"></i>{{ $label }}</span><i class="bi bi-chevron-right text-xs text-slate-400"></i></a>@endforeach</div>
<form method="POST" action="{{ route('logout') }}" class="mt-6">@csrf<button class="w-full rounded-xl bg-ajara-800 py-3.5 text-sm font-semibold text-white hover:bg-ajara-900"><i class="bi bi-box-arrow-right mr-2"></i>Logout</button></form></div>
@include('partials.bottom-nav')
@endsection
