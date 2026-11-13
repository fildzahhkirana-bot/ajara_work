<?php
namespace App\Http\Controllers;
use App\Models\Competition;
class HomeController extends Controller {
 public function index() {
  $base=Competition::query()->where('status','published');
  $latestCompetitions=(clone $base)->latest()->take(6)->get();
  $popularCompetitions=(clone $base)->orderByDesc('views')->orderByDesc('rating')->take(3)->get();
  $recommendedCompetitions=(clone $base)->where('is_recommended',true)->latest()->take(3)->get();
  if($recommendedCompetitions->isEmpty()) $recommendedCompetitions=(clone $base)->orderByDesc('rating')->take(3)->get();
  $competitionCount=(clone $base)->count();
  return view('welcome',compact('latestCompetitions','popularCompetitions','recommendedCompetitions','competitionCount'));
 }
}
