<?php

namespace App\Repositories\Api;

use App\Repositories\ParameterRepository as MainParameterRepository;

class ParameterRepository extends MainParameterRepository
{
    public function getFrontendMeta($data)
    {
        $query = $this->model
            ->whereIn('name', $data);

        return $query->get();
    }

    public function getParameterByName($name)
    {
        return $this->model
            ->select('name', 'content')
            ->where('name', $name)
            ->first();
    }

    public function getParameterByNameAndContentAndLock($name, $content)
    {
        return $this->model
            ->select('name', 'content')
            ->where('name', $name)
            ->Where('content', 'like', '%' . $content . '%')
            ->lockForUpdate()
            ->first();
    }
}
