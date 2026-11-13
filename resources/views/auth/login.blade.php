@extends('layouts.app')
@section('title','Login')
@section('content')
<main class="flex min-h-screen items-center justify-center px-4 py-10">
 <div class="w-full max-w-md rounded-3xl bg-white p-7 soft-shadow sm:p-9">
  <a href="{{ route('welcome') }}" class="text-sm text-slate-400"><i class="bi bi-arrow-left"></i> Kembali</a>
  <div class="mb-7 mt-7"><div class="mb-4 flex h-12 w-12 items-center justify-center rounded-2xl bg-ajara-50 text-ajara-700"><i class="bi bi-trophy-fill text-2xl"></i></div><h1 class="text-2xl font-bold text-slate-900">Selamat datang kembali!</h1><p class="mt-1 text-sm text-slate-500">Login untuk melanjutkan perjalanan prestasimu.</p></div>
  <form method="POST" action="{{ route('login.store') }}" class="space-y-4">@csrf
   <label class="block text-sm font-medium">Email<div class="mt-2 flex items-center rounded-xl border border-slate-200 px-3 focus-within:border-ajara-600"><i class="bi bi-envelope text-slate-400"></i><input name="email" type="email" value="{{ old('email') }}" required autofocus placeholder="nama@email.com" class="w-full border-0 bg-transparent px-3 py-3 text-sm outline-none focus:ring-0"></div>@error('email')<span class="text-xs text-red-600">{{ $message }}</span>@enderror</label>
   <label class="block text-sm font-medium">Password<div class="mt-2 flex items-center rounded-xl border border-slate-200 px-3 focus-within:border-ajara-600"><i class="bi bi-lock text-slate-400"></i><input name="password" type="password" required placeholder="Masukkan password" class="w-full border-0 bg-transparent px-3 py-3 text-sm outline-none focus:ring-0"></div>@error('password')<span class="text-xs text-red-600">{{ $message }}</span>@enderror</label>
   <div class="flex items-center justify-between text-xs"><label class="flex items-center gap-2 text-slate-500"><input type="checkbox" name="remember" class="rounded border-slate-300 text-ajara-700"> Ingat saya</label><a href="{{ route('password.request') }}" class="font-semibold text-ajara-700">Lupa Password?</a></div>
   <button class="w-full rounded-xl bg-ajara-700 py-3.5 text-sm font-semibold text-white hover:bg-ajara-800">Login</button>
  </form>
  <p class="mt-6 text-center text-sm text-slate-500">Belum punya akun? <a href="{{ route('register') }}" class="font-semibold text-ajara-700">Daftar</a></p>
 </div>
</main>
@endsection
