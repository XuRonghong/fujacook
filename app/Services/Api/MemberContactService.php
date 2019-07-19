<?php

namespace App\Services\Api;

use Illuminate\Database\Eloquent\Collection;

class MemberContactService
{
    /*
     * 常用收件人資訊最大數量
     */
    private $memberContactLimit = 5;
    
    public function checkLimit(Collection $records)
    {
        if ($records->count() >= $this->memberContactLimit) {
            return $records->last();
        }
    }
}
