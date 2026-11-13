@extends('layouts.app')
@section('title','Lupa Password')
@section('content')
<main class="flex min-h-screen items-center justify-center px-4"><div class="w-full max-w-md rounded-3xl bg-white p-8 soft-shadow">
<a href="{{ route('login') }}" class="text-sm text-slate-400">← Kembali ke login</a><h1 class="mt-7 text-2xl font-bold">Lupa password?</h1><p class="mt-2 text-sm leading-6 text-slate-500">Masukkan email akunmu. Form ini merupakan tampilan awal; aktifkan Laravel password broker dan konfigurasi email untuk mengirim tautan reset sungguhan.</p>
<form class="mt-6 space-y-4" method="POST" action="#"><input type="email" required placeholder="nama@email.com" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm"><button class="w-full rounded-xl bg-ajara-700 py-3 font-semibold text-white">Kirim tautan reset</button></form>
</div></main>
@endsection
