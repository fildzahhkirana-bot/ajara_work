@extends('layouts.app')
@section('title','Daftar')
@section('content')
<main class="flex min-h-screen items-center justify-center px-4 py-10">
 <div class="w-full max-w-md rounded-3xl bg-white p-7 soft-shadow sm:p-9">
  <a href="{{ route('welcome') }}" class="text-sm text-slate-400"><i class="bi bi-arrow-left"></i> Kembali</a>
  <h1 class="mt-7 text-2xl font-bold">Buat akun AJARA</h1><p class="mt-1 mb-7 text-sm text-slate-500">Mulai temukan kesempatan berprestasi.</p>
  <form method="POST" action="{{ route('register.store') }}" class="space-y-4">@csrf
   @foreach([['name','Nama Lengkap','text','Nama sesuai identitas'],['nim','NIM','text','Nomor Induk Mahasiswa'],['email','Email','email','nama@email.com']] as [$name,$label,$type,$placeholder])
   <label class="block text-sm font-medium">{{ $label }}<input name="{{ $name }}" type="{{ $type }}" value="{{ old($name) }}" required placeholder="{{ $placeholder }}" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-ajara-600 focus:ring-2 focus:ring-ajara-100">@error($name)<span class="text-xs text-red-600">{{ $message }}</span>@enderror</label>
   @endforeach
   <label class="block text-sm font-medium">Password<input name="password" type="password" required placeholder="Minimal 8 karakter" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-ajara-600">@error('password')<span class="text-xs text-red-600">{{ $message }}</span>@enderror</label>
   <label class="block text-sm font-medium">Konfirmasi Password<input name="password_confirmation" type="password" required placeholder="Ulangi password" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 text-sm outline-none focus:border-ajara-600"></label>
   <button class="mt-2 w-full rounded-xl bg-ajara-700 py-3.5 text-sm font-semibold text-white hover:bg-ajara-800">Daftar</button>
  </form>
  <p class="mt-6 text-center text-sm text-slate-500">Sudah punya akun? <a href="{{ route('login') }}" class="font-semibold text-ajara-700">Login</a></p>
 </div>
</main>
@endsection
