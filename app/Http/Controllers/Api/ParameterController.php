<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Repositories\Api\ParameterRepository;

class ParameterController extends Controller
{
    public function __construct(
        ParameterRepository $parameterRepository
    ) {
        $this->parameterRepository = $parameterRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getFrontendMetas()
    {
        $data = array('title',
            'app_id',
            'meta_title',
            'meta_description',
            'meta_url',
            'meta_image',
            'image_width',
            'image_height',
            'gtm_header',
            'gtm_body',
            'fb_pixel',
            'facebook_link',
            'instagram_link',
            'line_link',
        );

        $metas = $this->parameterRepository->getFrontendMeta($data);

        return response()->json([
            'result' => '200',
            'data' => $metas,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $parameter = $this->parameterRepository->getParameterByName($id);

        return response()->json([
            'result' => '200',
            'data' => $parameter,
        ]);
    }

}
