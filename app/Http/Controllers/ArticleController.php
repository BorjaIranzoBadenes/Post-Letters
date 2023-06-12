<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function __construct() {
        $this->middleware('auth')->except('index', 'show','articleSearch','byCategory');
    }
    
    public function index()
    {
        //
        $articles  = Article::where('is_accepted', true)->orderBy('created_at', 'desc')->get();
        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Article $article)
    {
        //
        $request->validate([
            'title' => 'required|unique:articles|min:5',
            'subtitle' => 'required|unique:articles|min:5',
            'body' => 'required|min:10',
            'image' => 'image|required',
            'category' => 'required',
            'tags' => 'required',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'body' => $request->body,
            'image' => $request->file('image')->store('public/image'),
            'category_id' => $request->category,
            'user_id' => Auth::user()->id,
            'slug' => Str::slug($request->title),
        ]);

        $tags = explode(', ', $request->tags);

        foreach ($tags as $tag) {
            $newTag = Tag::updateOrCreate([
                'name' => $tag,
            ]);
            $article->tags()->attach($newTag);
        }

        return redirect(route('welcome'))->with('message', 'Artículo creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
{
    $tags = $article->tags()->pluck('tags.id')->toArray();
    $categoryId = $article->category_id;

    // Obtener artículos relacionados por tag
    $relatedByTag = Article::where('articles.id', '!=', $article->id)
                            ->where('articles.is_accepted', true)
                            ->whereHas('tags', function ($query) use ($tags) {
                                $query->whereIn('tags.id', $tags);
                            })
                            ->orderBy('articles.created_at', 'desc')
                            ->take(3)
                            ->get();

    // Obtener artículos relacionados por categoría
    $relatedByCategory = Article::where('articles.id', '!=', $article->id)
                                ->where('articles.is_accepted', true)
                                ->where('articles.category_id', $categoryId)
                                ->orderBy('articles.created_at', 'desc')
                                ->take(3)
                                ->get();

    // Combinar los resultados en una única colección, excluir el artículo principal y eliminar duplicados
    $relatedArticles = $relatedByTag->concat($relatedByCategory)->except([$article->id])->unique();

    return view('article.show', compact('article', 'relatedArticles'));
}

    
    
    



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
        return view('article.edit', compact('article'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {
        //
        $request->validate([
            'title' => 'required|min:5|unique:articles,title,' . $article->id,
            'subtitle' => 'required|min:5|unique:articles,subtitle,' . $article->id,
            'body' => 'required|min:10',
            'image' => 'image',
            'category' => 'required',
            'tags' => 'required',
        ]);

        $article->update([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'body' => $request->body,
            'category_id' => $request->category,
            'slug' => Str::slug($request->title),
        ]);

        if ($request->image) {
            Storage::delete($article->image);
            $article->update([
                'image' => $request->file('image')->store('public/images')
            ]);
        }

        $tags = explode(', ', $request->tags);
        $newTags = [];

        foreach ($tags as $tag) {
            $newTag = Tag::updateOrCreate([
                'name' => $tag,
            ]);
            $newTags[] = $newTag->id;
        }

        $article->tags()->sync($newTags);

        return redirect(route('writer.dashboard'))->with('message', 'Ha actualizado correctamente el artículo elegido');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article) {
    foreach ($article->tags as $tag) {
        $article->tags()->detach($tag);
    }
    $article->delete();

    return redirect(route('writer.dashboard'))->with('message', 'Ha eliminado correctamente el artículo elegido');
}

public function byCategory(Request $request, Category $category)
{
    $query = $request->input('query');

    $articles = Article::where('category_id', $category->id)
                        ->where('is_accepted', true)
                        ->where(function ($queryBuilder) use ($query) {
                            $queryBuilder->where('title', 'like', "%$query%")
                                            ->orWhere('subtitle', 'like', "%$query%");
                        })
                        ->orderBy('created_at', 'desc')
                        ->get();

    return view('article.by-category', compact('category', 'articles'));
}



    public function byWriter(User $user) {
        $articles = $user->articles->sortByDesc('created_at')->filter(function($article){
            return $article->is_accepted === true;
        });
        return view('article.by-user', compact('user', 'articles'));
    }

    public function byUser(User $user) {
        $articles = $user->articles->sortByDesc('created_at')->filter(function($article){
            return $article->is_accepted === true;
        });
        return view('article.by-user', compact('user', 'articles'));
    }

    public function articleSearch(Request $request)
{
    $query = $request->input('query');

    $articles = Article::where('is_accepted', true)
        ->where(function ($queryBuilder) use ($query) {
            $queryBuilder->where('title', 'like', "%$query%")
                ->orWhere('subtitle', 'like', "%$query%");
        })
        ->orderBy('created_at', 'desc')
        ->get();

    return view('article.search-index', compact('articles', 'query'));
}
}
