<?php

namespace App\Http\Controllers;

use App\Models\Insight;
use App\Models\InsightCategory;
use Illuminate\Http\Request;

class InsightController extends Controller
{
    public function index(Request $request)
    {
        $articles = Insight::with('category')
            ->published()
            ->ordered()
            ->paginate(6);

        return view('pages.insights', [
            'articles' => $articles,
            'categories' => InsightCategory::active()->ordered()->get(),
            'recentArticles' => Insight::with('category')->published()->ordered()->limit(4)->get(),
        ]);
    }

    public function show(string $slug)
    {
        $article = Insight::with('category')
            ->published()
            ->where('slug', $slug)
            ->firstOrFail();

        return view('pages.insight-detail', [
            'article' => $article,
            'categories' => InsightCategory::active()->ordered()->get(),
            'recentArticles' => Insight::with('category')
                ->published()
                ->whereKeyNot($article->id)
                ->ordered()
                ->limit(4)
                ->get(),
        ]);
    }
}
