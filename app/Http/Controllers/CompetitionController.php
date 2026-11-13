<?php
namespace App\Http\Controllers;
use App\Models\Competition;
use Illuminate\Http\Request;
class CompetitionController extends Controller {
 public function index(Request $request) {
  $query=Competition::query()->where('status','published');
  if($request->filled('q')) { $term=$request->string('q')->toString(); $query->where(fn($q)=>$q->where('title','like',"%{$term}%")->orWhere('organizer','like',"%{$term}%")->orWhere('competition_category','like',"%{$term}%")); }
  foreach(['competition_category','competition_level','delivery_mode'] as $filter) if($request->filled($filter)&&$request->input($filter)!=='Semua') $query->where($filter,$request->input($filter));
  if($request->filled('fee')) $request->input('fee')==='Gratis' ? $query->where('fee_amount',0) : $query->where('fee_amount','>',0);
  if($request->filled('status_filter')) { $today=now()->toDateString(); match($request->status_filter) {
   'Sedang Dibuka'=>$query->whereDate('registration_start','<=',$today)->whereDate('registration_end','>=',$today),
   'Segera Dibuka'=>$query->whereDate('registration_start','>',$today),
   'Segera Ditutup'=>$query->whereDate('registration_end','>=',$today)->whereDate('registration_end','<=',now()->addDays(7)->toDateString()),
   'Ditutup'=>$query->whereDate('registration_end','<',$today), default=>null }; }
  match($request->input('sort','Terbaru')) { 'Terpopuler'=>$query->orderByDesc('views'),'Rating Tertinggi'=>$query->orderByDesc('rating'),default=>$query->latest() };
  $competitions=$query->paginate(9)->withQueryString();
  $categories=Competition::where('status','published')->select('competition_category')->distinct()->pluck('competition_category')->filter()->values();
  return view('competitions.index',compact('competitions','categories'));
 }
 public function show(Competition $competition) { abort_unless($competition->status==='published',404); $competition->increment('views'); return view('competitions.show',compact('competition')); }
 public function register(Competition $competition) { if(!auth()->check()) return redirect()->route('login')->with('status','Silakan login untuk melanjutkan pendaftaran.'); auth()->user()->registrations()->firstOrCreate(['competition_id'=>$competition->id],['status'=>'pending']); return back()->with('success','Lomba berhasil ditambahkan ke riwayat pendaftaran.'); }
 public function toggleFavorite(Competition $competition) { if(!auth()->check()) return redirect()->route('login')->with('status','Silakan login untuk menyimpan lomba favorit.'); $key='ajara_favorites'; $favorites=collect(session($key,[])); if($favorites->contains($competition->id)){session([$key=>$favorites->reject(fn($id)=>$id===$competition->id)->values()->all()]);return back()->with('success','Lomba dihapus dari favorit.');} $favorites->push($competition->id);session([$key=>$favorites->all()]);return back()->with('success','Lomba ditambahkan ke favorit.'); }
}
