<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::published()->ofType('news');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $news = $query->latest('published_at')->paginate(12);
        return view('news.index', compact('news'));
    }

    public function show(News $news)
    {
        abort_if($news->status !== 'published', 404);
        $related = News::published()->ofType($news->type)
            ->where('id', '!=', $news->id)
            ->latest('published_at')->take(3)->get();
        return view('news.show', compact('news', 'related'));
    }

    public function notices()
    {
        $notices = News::published()->ofType('notice')->latest('published_at')->paginate(10);
        return view('news.notices', compact('notices'));
    }
}
