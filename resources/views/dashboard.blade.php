@extends('layouts.app')
@section('title','Beranda')
@section('content')
<div class="mx-auto min-h-screen max-w-3xl bg-slate-50 nav-safe">
 <header class="flex items-center justify-between px-5 pb-4 pt-7"><div><p class="text-xs text-slate-400">Selamat datang,</p><h1 class="text-xl font-bold">{{ auth()->user()->name }} 👋</h1></div><a href="{{ route('profile.show') }}" class="flex h-11 w-11 items-center justify-center rounded-full bg-ajara-100 font-bold text-ajara-800">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</a></header>
 <main class="px-5">
  <form action="{{ route('competitions.index') }}" class="flex items-center rounded-2xl border border-slate-200 bg-white px-4 py-3 shadow-sm"><i class="bi bi-search text-slate-400"></i><input name="q" placeholder="Cari lomba..." class="ml-3 w-full bg-transparent text-sm outline-none"></form>
  <section class="mt-5 flex items-center justify-between overflow-hidden rounded-2xl bg-ajara-800 p-5 text-white"><div class="max-w-[70%]"><p class="text-xs font-medium text-ajara-100">Peluang baru menantimu</p><h2 class="mt-1 text-xl font-bold leading-tight">Jangan lewatkan lomba terbaru!</h2><a href="{{ route('competitions.index') }}" class="mt-4 inline-flex rounded-lg bg-white px-3 py-2 text-xs font-bold text-ajara-800">Jelajahi lomba <i class="bi bi-arrow-right ml-2"></i></a></div><i class="bi bi-megaphone-fill text-5xl text-amber-300"></i></section>
  <section class="mt-7"><div class="mb-4 flex items-center justify-between"><h2 class="font-bold">Jelajahi kategori</h2></div><div class="grid grid-cols-4 gap-2">
  @foreach([['Semua','grid','bg-ajara-50'],['Kampus','mortarboard','bg-blue-50'],['Nasional','flag','bg-amber-50'],['Internasional','globe2','bg-violet-50']] as [$cat,$icon,$bg])
   <a href="{{ route('competitions.index',['category'=>$cat]) }}" class="flex flex-col items-center gap-2 text-center"><span class="flex h-14 w-14 items-center justify-center rounded-full {{ $bg }} text-xl text-ajara-800"><i class="bi bi-{{ $icon }}"></i></span><span class="text-[11px] font-medium text-slate-600">{{ $cat }}</span></a>
  @endforeach
  </div></section>
  <section class="mt-8"><div class="mb-4 flex items-center justify-between"><h2 class="font-bold">Lomba Terbaru</h2><a href="{{ route('competitions.index') }}" class="text-xs font-semibold text-ajara-700">Lihat Semua <i class="bi bi-arrow-right"></i></a></div>
   <div class="space-y-3">@forelse($competitions as $competition)
    <a href="{{ route('competitions.show',$competition) }}" class="block rounded-2xl border border-slate-100 bg-white p-4 soft-shadow"><div class="flex items-start justify-between gap-3"><div><span class="rounded-full bg-ajara-50 px-2.5 py-1 text-[10px] font-semibold text-ajara-800">{{ $competition->category }}</span><h3 class="mt-2 font-bold">{{ $competition->title }}</h3><p class="mt-1 text-xs text-slate-500">{{ $competition->organizer }}</p></div><span class="shrink-0 rounded-full {{ $competition->mode==='Online'?'bg-blue-50 text-blue-700':'bg-orange-50 text-orange-700' }} px-2.5 py-1 text-[10px] font-semibold">{{ $competition->mode }}</span></div><div class="mt-4 flex items-center gap-2 text-xs text-slate-400"><i class="bi bi-calendar-event"></i> Tutup {{ optional($competition->registration_end)->format('d M Y') ?? 'Belum ditentukan' }}</div></a>
   @empty<div class="rounded-2xl bg-white p-7 text-center text-sm text-slate-500">Belum ada lomba. Silakan cek kembali nanti.</div>@endforelse</div>
  </section>
 </main>
</div>
@include('partials.bottom-nav')
@endsection
