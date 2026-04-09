<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();
        if ($request->filled('type')) $query->where('type', $request->type);
        if ($request->filled('status')) $query->where('status', $request->status);
        $news = $query->latest()->paginate(20);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:news,notice,press_release,newsletter',
            'body'        => 'required|string',
            'cover_image' => 'nullable|image|max:4096',
        ]);

        $data = $request->except(['cover_image', 'attachment', '_token']);
        $data['published_at'] = $request->status === 'published' ? now() : null;

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('news/covers', 'public');
        }
        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment')->store('news/attachments', 'public');
        }

        News::create($data);
        return redirect()->route('admin.news.index')->with('success', 'Article created successfully.');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->except(['cover_image', 'attachment', '_token', '_method']);

        if ($request->hasFile('cover_image')) {
            if ($news->cover_image) Storage::disk('public')->delete($news->cover_image);
            $data['cover_image'] = $request->file('cover_image')->store('news/covers', 'public');
        }

        if ($request->status === 'published' && !$news->published_at) {
            $data['published_at'] = now();
        }

        $news->update($data);
        return redirect()->route('admin.news.index')->with('success', 'Article updated.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Article deleted.');
    }
}
