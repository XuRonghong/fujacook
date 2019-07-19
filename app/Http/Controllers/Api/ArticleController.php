<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;

class ArticleController extends Controller
{   
    /**
     * @var \App\Repositories\ArticleRepository
     */
    
    public function __construct(
        ArticleRepository $articleRepository, 
        CategoryRepository $categoryRepository
    ) {
        
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
    }
    
    public function parentIndex(Request $request, $parent_category)
    {
        $category = $this->categoryRepository->getCategoryByPathName($parent_category);

        if (empty($category)) {
            throw new HttpResponseException(response()->json([
                'result'        => '404',
                'error_message' => '找不到文章大分類',
            ]));
        }

        $request->merge(['parent_name' => $parent_category, 'status' => true]);

        $articles = $this->articleRepository->getArticles(null, $request, 6, ['categories.parentCategory', 'hashtags', 'cover']);

        foreach ($articles as $article) {
            $article['published_at'] = $article->present()->dateTime('published_at', 'Y-m-d');
        }
       
        return response()->json([
            'result' => '200',
            'data' => $articles->toArray(),
        ], 200); 
    }

    public function childIndex(Request $request, $parent_category, $category)
    {
        $category_path_name = $this->categoryRepository->getCategoryByPathName($category);

        if (empty($category_path_name)) {
            throw new HttpResponseException(response()->json([
                'result'        => '404',
                'error_message' => '找不到文章大分類',
            ]));
        }

        $parent_path_name = array_get($category_path_name, 'parentCategory.path_name');

        if ($parent_path_name != $parent_category) {
            throw new HttpResponseException(response()->json([
                'result'        => '404',
                'error_message' => '找不到文章小分類',
            ]));
        }

        $request->merge(['path_name' => $category, 'status' => true]);

        $articles = $this->articleRepository->getArticles(null, $request, 6, ['categories', 'hashtags', 'cover']);

        foreach ($articles as $article) {
            $article['published_at'] = $article->present()->dateTime('published_at', 'Y-m-d');
        }
       
        

        return response()->json([
            'result' => '200',
            'data' => $articles->toArray(),
        ], 200); 
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($parent_category, $category, $id)
    {
        $article = $this->articleRepository->find($id)->loadMissing(['categories.parentCategory', 'hashtags']);

        if (empty($article)) {
            throw new HttpResponseException(response()->json([
                'result'        => '400',
                'error_message' => '一般來說，你不會看到這個訊息',
            ]));
        }
        
        return response()->json([
            'result' => '200',
            'data' => $article,
        ], 200);
    }

}
