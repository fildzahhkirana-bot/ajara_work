@php
 $deadline=$competition->registration_end;
 $isOpen=$deadline && ($deadline->isToday() || $deadline->isFuture());
 $fee=(int)($competition->fee_amount ?? 0);
@endphp
<article class="competition-card overflow-hidden rounded-[22px] border border-slate-100 bg-white shadow-[0_5px_25px_rgba(32,60,67,.05)]">
 <a href="{{ route('competitions.show',$competition) }}" class="relative block overflow-hidden bg-slate-100">
  <img class="poster-img transition duration-500 hover:scale-[1.04]" src="{{ $competition->banner ?: 'https://images.unsplash.com/photo-1523580494863-6f3031224c94?auto=format&fit=crop&w=900&q=85' }}" alt="Poster {{ $competition->title }}" loading="lazy">
  <span class="absolute left-3 top-3 rounded-full bg-white/95 px-3 py-1 text-[10px] font-extrabold uppercase tracking-wide text-ajara-teal shadow-sm">{{ $competition->competition_level ?? $competition->category }}</span>
  @if($competition->is_recommended)<span class="absolute right-3 top-3 rounded-full bg-ajara-gold px-3 py-1 text-[10px] font-extrabold text-ajara-ink"><i class="bi bi-stars mr-1"></i>Pilihan</span>@endif
 </a>
 <div class="p-5">
  <div class="mb-2 flex items-center justify-between gap-2"><span class="text-[11px] font-bold uppercase tracking-[.12em] text-ajara-red">{{ $competition->competition_category ?? 'Lainnya' }}</span><span class="text-xs font-semibold text-slate-400"><i class="bi bi-{{ $competition->delivery_mode==='Offline'?'geo-alt':'wifi' }} mr-1"></i>{{ $competition->delivery_mode }}</span></div>
  <a href="{{ route('competitions.show',$competition) }}" class="line-clamp-2 block min-h-[48px] text-[16px] font-extrabold leading-6 text-ajara-ink hover:text-ajara-red">{{ $competition->title }}</a>
  <p class="mt-1 truncate text-xs text-slate-500">Diselenggarakan oleh {{ $competition->organizer }}</p>
  <div class="mt-4 flex items-center justify-between border-b border-slate-100 pb-3"><div class="flex items-center gap-1 text-xs"><span class="text-ajara-gold">★★★★★</span><b class="text-slate-700">{{ number_format((float)$competition->rating,1) }}</b><span class="text-slate-400">({{ $competition->review_count }} ulasan)</span></div><span class="text-xs font-extrabold {{ $fee===0?'text-emerald-600':'text-ajara-teal' }}">{{ $fee===0?'Gratis':'Rp'.number_format($fee,0,',','.') }}</span></div>
  <div class="mt-3 flex items-center justify-between gap-3"><div><p class="text-[10px] font-semibold uppercase tracking-wide text-slate-400">Deadline</p><p class="mt-0.5 text-xs font-bold text-slate-700">{{ $deadline ? $deadline->translatedFormat('d M Y') : 'Informasi menyusul' }}</p></div><span class="rounded-full px-2.5 py-1 text-[10px] font-bold {{ $isOpen?'bg-emerald-50 text-emerald-700':'bg-slate-100 text-slate-500' }}">{{ $isOpen?'Pendaftaran dibuka':'Cek informasi' }}</span></div>
  <a href="{{ route('competitions.show',$competition) }}" class="mt-4 flex w-full items-center justify-center gap-2 rounded-xl border border-ajara-teal/20 py-2.5 text-xs font-extrabold text-ajara-teal transition hover:border-ajara-teal hover:bg-ajara-teal hover:text-white">Lihat Detail <i class="bi bi-arrow-up-right"></i></a>
 </div>
</article>
