<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Presenters\Front\ScenesPresenter;
use App\Repositories\Front\ScenesRepository;
use App\Setting;


class AboutController extends Controller
{
    protected $repository;
    protected $presenter;

    function __construct(ScenesRepository $repository, ScenesPresenter $presenter)
    {
        $this->repository = $repository;
        $this->presenter = $presenter;
    }

    function index ()
    {
        $data = [];
        $data['parameters'] = $this->getParameters();
        $collect = array_get($data['parameters'], 'external_link');
        $data['parameters']['external_link'] = $collect->map(function ($item, $key){
            $item->content = json_decode($item->content);
            return $item;
        });
        //
        $data['navbar'] = $this->repository->getOrmByType('navbar.home');
        $data['navbar2'] = $this->repository->getOrmByType('navbar.about');
        //
        $data['slider'] = $this->repository->getOrmByType('slider.about');
        $data['slider'] = $this->presenter->eachOne_aaData($data['slider']);
        //
        $data['introduce']['t01'] = $this->repository->getOrmByType('introduce.about.t01');
        $data['introduce']['t01'] = $this->presenter->eachOne_aaData($data['introduce']['t01']);
        $data['introduce']['t02'] = $this->repository->getOrmByType('introduce.about.t02');
        $data['introduce']['t02'] = $this->presenter->eachOne_aaData($data['introduce']['t02']);
        $data['introduce']['t03'] = $this->repository->getOrmByType('introduce.about.t03');
        $data['introduce']['t03'] = $this->presenter->eachOne_aaData($data['introduce']['t03']);
        $data['introduce']['t04'] = $this->repository->getOrmByType('introduce.about.t04');
        $data['introduce']['t04'] = $this->presenter->eachOne_aaData($data['introduce']['t04']);
        $data['introduce']['t05'] = $this->repository->getOrmByType('introduce.about.t05');
        $data['introduce']['t05'] = $this->presenter->eachOne_aaData($data['introduce']['t05']);
        //
        $data['image']['section3'] = $this->repository->getOrmByType('image.home.section3');
        $data['image']['section3'] = $this->presenter->eachOne_aaData($data['image']['section3']);
        //
        $data['image']['section3'] = $this->repository->getOrmByType('image.home.section3');
        $data['image']['section3'] = $this->presenter->eachOne_aaData($data['image']['section3']);
        //
        $data['footer'] = $this->repository->getOrmByType('footer.home');
        $data['footer'] = $this->presenter->eachOne_aaData($data['footer']);

        return view('front.about', compact('data'));
    }

    public function getParameters()
    {
        return [
            'meta_title' => trans('front.about.title'),
            'meta_keyword' => json_decode( Setting::query()->where('name', 'meta_keyword')->first()->content ),
            'meta_description' => json_decode( Setting::query()->where('name', 'meta_description')->first()->content ),
            'external_link' => Setting::query()->where('type', 'external_link')
                ->orderBy('rank', 'asc')
                ->get(['type','name','content','value']),
        ];
    }
}
