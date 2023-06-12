<?php

namespace App\Http\Controllers;

use App\Mail\CareerRequestMail;
use App\Models\Article;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class RevisorController extends Controller
{
    //
    public function dashboard() {
        $unrevisionedArticles = Article::where('is_accepted', NULL)->get();
        $acceptedArticles = Article::where('is_accepted', true)->get();
        $rejectedArticles = Article::where('is_accepted', false)->get();

        return view('revisor.dashboard', compact('unrevisionedArticles', 'acceptedArticles', 'rejectedArticles'));
    }

    public function acceptArticle(Article $article) {
        $article->update([
            'is_accepted' => true,
        ]);

        return redirect(route('revisor.dashboard'))->with('message', 'Ha aceptado el artículo elegido');
    }

    public function rejectArticle(Article $article) {
        $article->update([
            'is_accepted' => false,
        ]);

        return redirect(route('revisor.dashboard'))->with('message', 'Ha rechazado el artículo elegido');
    }

    public function undoArticle(Article $article) {
        $article->update([
            'is_accepted' => NULL,
        ]);

        return redirect(route('revisor.dashboard'))->with('message', 'Artículo para su revisión');
    }

    public function becomeRevisor() {
        Mail::to('admin@theaulabpost.es')->send(new CareerRequestMail(Auth::user()));
        return redirect()->route('welcome')->with('message', 'Solicitud enviada con éxito, pronto sabrás algo, gracias!');
    }

    public function makeRevisor(User $user) {
        Artisan::call('nombre_database:make-user-revisor',['email'=>$user->email]);
        return redirect()->route('welcome')->with('message','Ya tenemos un colaborador más');
    }
}
