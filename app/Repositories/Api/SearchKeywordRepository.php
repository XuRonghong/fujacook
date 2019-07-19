<?php

namespace App\Repositories\Api;

use App\Repositories\SearchKeywordRepository as MainSearchKeywordRepository;

class SearchKeywordRepository extends MainSearchKeywordRepository
{
	public function getKeywordsForApi($columns = ['*'], $request = null, $paginate = null, $with = null)
	{
	    $query = $this->model
	        ->orderBy('order', 'asc')
	        ->orderBy('id', 'desc')
	        ->take(5);

	    return $this->keywordsFilter($query, $columns, $request, $paginate, $with);
	}
}
