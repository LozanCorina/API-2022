<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\BlogResource;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Article::where('userId', auth()->id())->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
          $article = Article::store($request->validated());

          return new BlogResource($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $article->update($request->validated());

        return new BlogResource($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        try{
            $article->delete();
            return response()->json('Data successfully deleted!');
        } catch (\Exception $err) {
            return response()->json(['error' => $err]);
        }
    }

    /**
     * Vote article
     * @param Article $article
     * @param string $type
     */
    public function vote(Article $article, $type)
    {
        if ( $type == 'up') {
            $article->increment('up', 1);
           // $article->update(['up' => DB::raw('up + 1')]);
        } elseif ($type == 'down')
        {
            $article->update(['down' => DB::raw('down + 1')]);
        }

        return response()->json('Vote has been successful submitted!');
    }

    /** Show top 5 categories with articles
     *
     */
    public function topCategories()
    {
        $data = Category::select('*')
        //, DB::raw('(sum(up,down)) mod 2  rating'))
            ->withCount('articles')
            ->having('articles_count', '>=', 2)
            //->orderBy('rating', 'desc')
            ->take(5)
            ->get();

        return response()->json($data);

    }

    public function allArticles()
    {
        return BlogResource::collection(Article::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(3));
    }
}
