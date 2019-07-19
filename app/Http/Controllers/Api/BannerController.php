<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\Admin\MainBannerController as ExtendsMainBannerController;

class BannerController extends ExtendsMainBannerController
{
    
    public function getBanners(Request $request)
    {
        $banners;

        if($request->has('type')){
            switch ($request->get('type')) {
                case 3:
                    # code...
                    break;
                default:
                    $banners = $this->bannerRepository->getBannerByType($request->get('type'));
                    break;
            }
        }

        return response()->json([
            'result' => '200',
            'data' => $banners,
        ], 200);
    }
}
