<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Resources\BlogResource;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource for logged user
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Article::where('user_id', auth()->id())->paginate(6);
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
          $article = Article::create($request->validated());

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
     * @param  ArticleRequest  $request
     * @param  int  $id
     * @return BlogResource
     */
    public function update(ArticleRequest $request, $id): JsonResponse
    {
        try{
            Article::find($id)->update($request->validated());

            return response()->json('Data successfully updated!');
        } catch (\Exception $err) {
             return response()->json($err);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        try{
            Article::find($id)->delete();
            return response()->json('Data successfully deleted!');
        } catch (\Exception $err) {
            return response()->json(['error' => $err]);
        }
    }

    /**
     * Vote article
     * @param Request $request
     * @return JsonResponse
     */
    public function vote(Request $request): JsonResponse
    {
        if ($request->type == "up") {

            Article::find($request->id)->increment('up', 1);

            return response()->json('Vote has been successful submitted!');
        } elseif ($request->type == "down")
        {
            Article::find($request->id)->increment('up', 1);

            return response()->json('Vote has been successful submitted!');
        }
        return response()->json('Ups, error!');
    }

    /** Show top 5 categories with articles
     *
     */
    public function topCategories(): BlogResource
    {
        $data = Category::select('*')
        //, DB::raw('(sum(up,down)) mod 2  rating'))
            ->withCount('articles')
            ->having('articles_count', '>=', 2)
            //->orderBy('rating', 'desc')
            ->take(5)
            ->get();

        return new BlogResource($data);;

    }

    /**
     * Return All articles for not logged users
     *
     * @return BlogResource
     */
    public function allArticles(): BlogResource
    {
        return BlogResource::collection(Article::with('category')
            ->orderBy('created_at', 'desc')
            ->paginate(3));
    }
}
