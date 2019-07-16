<?php

namespace App\Services\Admin\News;

use Illuminate\Http\Request;
use App\Repositories\Admin\InformationRepository;

class NewsService
{
    protected $repository;

    public function __construct(InformationRepository $repository)
    {
        $this->repository = $repository;
    }
}
