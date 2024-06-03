<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\BecomeRevisor;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Artisan;

class RevisorController extends Controller
{
    public function index(){
        $announcement_to_check = Announcement::where('is_accepted', null)->first();
        return view('revisor.index', compact('announcement_to_check'));
    }

    public function accept(Announcement $announcement){
        $announcement->setAccepted(true);
        $announcement->setUpdated();
        return redirect()->back()->with('message', "$announcement->title ".__('ui.Annuncio accettato'));
    }

    public function reject(Announcement $announcement){
        $announcement->setAccepted(false);
        $announcement->setUpdated();
        return redirect()->back()->with('error', "$announcement->title ".__('ui.Annuncio rifiutato'));
    }

    public function reset(){
        $announcement = Announcement::where('is_accepted', true)->orWhere('is_accepted', false)->orderBy('updated_at', 'desc')->first();        
        $announcement->setAccepted(null);
        return redirect()->back()->with('message', "$announcement->title ".__('ui.Annuncio resettato'));
    }
    public function becomeRevisor(){
        Mail::to('prosciutti-crud@presto.it')->send(new BecomeRevisor(Auth::user(),Auth::user()->email));
        Auth::user()->is_revisor = false;
        Auth::user()->save();
        return redirect()->route('home')->with('message', __('ui.Richiesta revisore'));
    }

    public function makeRevisor(User $user){
        Artisan::call('app:make-user-revisor', ['email' => $user->email]);
        return redirect()->route('home')->with('message', "$user->name ".__('ui.Revisore approvato'));
    }
}
