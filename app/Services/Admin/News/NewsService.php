<?php

namespace App\Services\Admin\News;

use Illuminate\Http\Request;
use App\Repositories\Admin\News\NewsRepository;

class NewsService
{
    protected $repository;

    public function __construct(NewsRepository $repository)
    {
        $this->repository = $repository;
    }


    public function NewRepository()
    {
        return $this->repository;
    }

    public function validate(Request $request)
    {
        //
        $rules = [
            'title' => 'required',
            'summary' => 'required',
//            'hashtag_name' => 'required|array',
            'startTime' => 'nullable',
            'endTime' => 'nullable',
            'open' => 'nullable'
        ];
        $messages = [
            'title.required' => '標題為必填項目',
            'summary.required' => '內文為必填項目',
//            'category_id.required' => '商品分類為必填項目',
//            'hashtag_name.required' => '標籤為必填項目',
        ];
        return $request->validate($rules, $messages);
    }

    public function DB_create(Request $request)
    {
        return $this->repository->create($request->all());
    }
}
