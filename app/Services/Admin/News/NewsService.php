<?php

namespace App\Services\Admin\News;

use Illuminate\Http\Request;
use App\Repositories\Admin\NewsRepository;

class NewsService
{
    protected $repository;

    public function __construct(NewsRepository $repository)
    {
        $this->repository = $repository;
    }
}
