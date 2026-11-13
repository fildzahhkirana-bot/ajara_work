<!doctype html>
<html lang="id">
<head>
 <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
 <title><?php echo $__env->yieldContent('title','AJARA'); ?> · Ajang dan Jejaring Prestasi Mahasiswa</title>
 <script src="https://cdn.tailwindcss.com"></script>
 <script>tailwind.config={theme:{extend:{colors:{ajara:{gold:'#E09F3E',red:'#9E2A2B',teal:'#335C67',cream:'#FFF3B0',ink:'#203C43'}},fontFamily:{sans:['Inter','ui-sans-serif','system-ui']},boxShadow:{soft:'0 16px 45px rgba(32,60,67,.09)'}}}}</script>
 <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
 <style>
  :root{--gold:#E09F3E;--red:#9E2A2B;--teal:#335C67;--cream:#FFF3B0}*{scroll-behavior:smooth}body{font-family:'DM Sans',sans-serif;color:#243b40;background:#fff}h1,h2,h3,.brand{font-family:'Plus Jakarta Sans',sans-serif}.container-page{width:min(1180px,calc(100% - 40px));margin-inline:auto}.nav-link{color:#53666a;font-weight:600;font-size:14px;transition:.2s}.nav-link:hover,.nav-link.active{color:var(--red)}.btn-primary{background:var(--red);color:#fff;transition:.2s}.btn-primary:hover{background:#812122;transform:translateY(-1px)}.btn-gold{background:var(--gold);color:#2f3b3b;transition:.2s}.btn-gold:hover{filter:brightness(.96);transform:translateY(-1px)}.soft-shadow{box-shadow:0 16px 45px rgba(32,60,67,.09)}.competition-card{transition:transform .25s,box-shadow .25s}.competition-card:hover{transform:translateY(-5px);box-shadow:0 20px 45px rgba(32,60,67,.13)}.poster-img{width:100%;height:190px;object-fit:cover}.line-clamp-2{display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}.mobile-menu{display:none}@media(max-width:800px){.desktop-nav{display:none}.mobile-menu{display:block}.hero-grid{grid-template-columns:1fr}.hero-art{display:none}}
 </style>
 <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="min-h-screen">
 <?php if(session('success')): ?><div class="fixed top-4 left-1/2 z-[80] -translate-x-1/2 rounded-xl bg-ajara-teal px-5 py-3 text-sm font-semibold text-white shadow-lg"><?php echo e(session('success')); ?></div><?php endif; ?>
 <?php if(session('status')): ?><div class="fixed top-4 left-1/2 z-[80] -translate-x-1/2 rounded-xl bg-ajara-teal px-5 py-3 text-sm font-semibold text-white shadow-lg"><?php echo e(session('status')); ?></div><?php endif; ?>
 <header class="sticky top-0 z-50 border-b border-slate-100 bg-white/95 backdrop-blur-xl">
  <div class="container-page flex h-[78px] items-center justify-between gap-6">
   <a href="<?php echo e(route('welcome')); ?>" class="flex shrink-0 items-center gap-2.5">
    <img src="<?php echo e(asset('images/ajara-logo.jpeg')); ?>" alt="Logo AJARA" class="h-12 w-12 rounded-xl object-contain">
    <span class="brand text-[25px] font-extrabold tracking-[.11em] text-ajara-teal">AJARA<span class="ml-1 inline-block h-2 w-2 rounded-full bg-ajara-gold"></span><small class="mt-[-2px] block text-[9px] font-bold tracking-[.13em] text-slate-400">AJANG & JEJARING PRESTASI</small></span>
   </a>
   <nav class="desktop-nav flex items-center gap-8">
    <a class="nav-link <?php echo e(request()->routeIs('welcome')?'active':''); ?>" href="<?php echo e(route('welcome')); ?>">Beranda</a>
    <a class="nav-link <?php echo e(request()->routeIs('competitions.*')?'active':''); ?>" href="<?php echo e(route('competitions.index')); ?>">Jelajahi Lomba</a>
    <a class="nav-link" href="<?php echo e(route('welcome')); ?>#kategori">Kategori</a>
    <a class="nav-link" href="<?php echo e(route('welcome')); ?>#tentang">Tentang AJARA</a>
   </nav>
   <div class="desktop-nav flex items-center gap-3">
    <?php if(auth()->guard()->check()): ?>
     <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-2 rounded-full border border-slate-200 px-3 py-2 text-sm font-bold text-ajara-teal"><span class="flex h-7 w-7 items-center justify-center rounded-full bg-ajara-cream text-ajara-teal"><?php echo e(strtoupper(substr(auth()->user()->name,0,1))); ?></span><?php echo e(Str::limit(auth()->user()->name,14)); ?></a>
    <?php else: ?>
     <a href="<?php echo e(route('login')); ?>" class="rounded-full px-4 py-2.5 text-sm font-bold text-ajara-teal hover:bg-slate-50">Masuk</a>
     <a href="<?php echo e(route('register')); ?>" class="btn-primary rounded-full px-5 py-2.5 text-sm font-bold shadow-md shadow-red-900/10">Daftar Sekarang <i class="bi bi-arrow-up-right ml-1"></i></a>
    <?php endif; ?>
   </div>
   <button class="mobile-menu rounded-xl border border-slate-200 p-2 text-xl text-ajara-teal" onclick="document.getElementById('mobileNav').classList.toggle('hidden')" aria-label="Buka menu"><i class="bi bi-list"></i></button>
  </div>
  <div id="mobileNav" class="hidden border-t border-slate-100 bg-white px-5 py-4 md:hidden"><div class="container-page flex flex-col gap-4"><a class="nav-link" href="<?php echo e(route('welcome')); ?>">Beranda</a><a class="nav-link" href="<?php echo e(route('competitions.index')); ?>">Jelajahi Lomba</a><a class="nav-link" href="<?php echo e(route('welcome')); ?>#kategori">Kategori</a><a class="nav-link" href="<?php echo e(route('welcome')); ?>#tentang">Tentang AJARA</a><div class="flex gap-3"><a href="<?php echo e(route('login')); ?>" class="flex-1 rounded-xl border p-3 text-center text-sm font-bold">Masuk</a><a href="<?php echo e(route('register')); ?>" class="btn-primary flex-1 rounded-xl p-3 text-center text-sm font-bold">Daftar</a></div></div></div>
 </header>
 <?php echo $__env->yieldContent('content'); ?>
 <footer id="tentang" class="mt-20 bg-ajara-teal text-white">
  <div class="container-page grid gap-10 py-14 md:grid-cols-[1.4fr_1fr_1fr_1fr]">
   <div><div class="mb-4 flex items-center gap-3"><img src="<?php echo e(asset('images/ajara-logo.jpeg')); ?>" class="h-14 w-14 rounded-xl object-contain" alt="Logo AJARA"><div class="brand text-2xl font-extrabold tracking-widest">AJARA</div></div><p class="max-w-xs text-sm leading-7 text-white/70">Ajang dan Jejaring Prestasi Mahasiswa. Satu tempat untuk menemukan peluang, berjejaring, dan bertumbuh melalui kompetisi.</p></div>
   <div><h3 class="mb-4 font-bold">Jelajahi</h3><div class="space-y-3 text-sm text-white/70"><a class="block hover:text-white" href="<?php echo e(route('competitions.index')); ?>">Semua Lomba</a><a class="block hover:text-white" href="<?php echo e(route('welcome')); ?>#kategori">Kategori Lomba</a><a class="block hover:text-white" href="<?php echo e(route('competitions.index',['category'=>'Nasional'])); ?>">Lomba Nasional</a></div></div>
   <div><h3 class="mb-4 font-bold">AJARA</h3><div class="space-y-3 text-sm text-white/70"><a class="block hover:text-white" href="<?php echo e(route('welcome')); ?>#tentang">Tentang Kami</a><a class="block hover:text-white" href="mailto:halo@ajara.id">Hubungi Kami</a><a class="block hover:text-white" href="<?php echo e(route('register')); ?>">Gabung AJARA</a></div></div>
   <div><h3 class="mb-4 font-bold">Ikuti Kami</h3><p class="mb-4 text-sm leading-6 text-white/70">Temukan kabar dan peluang prestasi terbaru.</p><div class="flex gap-3 text-xl"><a href="#" aria-label="Instagram" class="hover:text-ajara-gold"><i class="bi bi-instagram"></i></a><a href="#" aria-label="TikTok" class="hover:text-ajara-gold"><i class="bi bi-tiktok"></i></a><a href="mailto:halo@ajara.id" aria-label="Email" class="hover:text-ajara-gold"><i class="bi bi-envelope"></i></a></div></div>
  </div><div class="border-t border-white/15"><div class="container-page flex flex-col justify-between gap-2 py-5 text-xs text-white/55 sm:flex-row"><span>© <?php echo e(date('Y')); ?> AJARA. Seluruh hak cipta dilindungi.</span><span>Temukan Ajangnya, Wujudkan Prestasimu.</span></div></div>
 </footer>
 <?php echo $__env->yieldPushContent('scripts'); ?>
</body></html>
<?php /**PATH D:\KULIAH\KULIAH SEM 5\E BISNIS\TUGAS\ajara_work\resources\views/layouts/app.blade.php ENDPATH**/ ?>