<nav class="fixed bottom-0 left-0 right-0 z-40 border-t border-slate-200 bg-white/95 backdrop-blur">
  <div class="mx-auto grid max-w-3xl grid-cols-4 px-3 pb-[env(safe-area-inset-bottom)] pt-2">
    @php($items = [['dashboard','house-door','Beranda'],['competitions.index','trophy','Lomba'],['notifications.index','bell','Notifikasi'],['profile.show','person','Profil']])
    @foreach($items as [$route,$icon,$label])
      <a href="{{ route($route) }}" class="flex flex-col items-center gap-1 py-1 text-xs {{ request()->routeIs($route) ? 'font-semibold text-ajara-700' : 'text-slate-400' }}">
        <i class="bi bi-{{ $icon }} text-xl"></i><span>{{ $label }}</span>
      </a>
    @endforeach
  </div>
</nav>
