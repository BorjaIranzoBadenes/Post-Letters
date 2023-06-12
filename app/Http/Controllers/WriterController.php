<?php

namespace App\Http\Controllers;

use App\Mail\CareerRequestMail;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class WriterController extends Controller
{
    //
    public function becomeWriter() {
        Mail::to('admin@theaulabpost.es')->send(new CareerRequestMail(Auth::user()));
        return redirect()->route('welcome')->with('message','Solicitud enviada con éxito, pronto sabrás algo, gracias!');
    }

    public function makeWriter(User $user) {
        Artisan::call('nombre_database:make-user-writer',['email'=>$user->email]);
        return redirect()->route('welcome')->with('message','Ya tenemos un colaborador más');
    }

    public function dashboard() {
        $acceptedArticles = Article::where('user_id', Auth::user()->id)->where('is_accepted',true)->orderBy('created_at', 'desc')->get();
        $rejectedArticles = Article::where('user_id', Auth::user()->id)->where('is_accepted',false)->orderBy('created_at', 'desc')->get();
        $unrevisionedArticles = Article::where('user_id', Auth::user()->id)->where('is_accepted', NULL)->orderBy('created_at', 'desc')->get();

        return view('writer.dashboard', compact('acceptedArticles', 'rejectedArticles', 'unrevisionedArticles'));
    }
}
