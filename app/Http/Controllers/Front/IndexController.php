<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FuncController;
use App\Presenters\Front\ScenesPresenter;
use App\Repositories\Front\ScenesRepository;
use App\Setting;
use function Aws\filter;
use Illuminate\Http\Request;

class IndexController extends Controller
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
        //紀錄登入log
        FuncController::addLog('Front for Visitor', 0);

        $data = [];
        $data['parameters'] = $this->getParameters();
        $collect = array_get($data['parameters'], 'external_link');
        $data['parameters']['external_link'] = $collect->map(function ($item, $key){
            $item->content = json_decode($item->content);
            return $item;
        });
        //
        $data['navbar'] = $this->repository->getOrmByType('navbar.home');
        //
        $data['slider'] = $this->repository->getOrmByType('slider.home');
        $data['slider'] = $this->presenter->eachOne_aaData($data['slider']);
        //
        $data['introduce']['t01'] = $this->repository->getOrmByType('introduce.home.t01');
        $data['introduce']['t01'] = $this->presenter->eachOne_aaData($data['introduce']['t01']);
        //
        $data['image']['section1'] = $this->repository->getOrmByType('image.home.section1');
        $data['image']['section1'] = $this->presenter->eachOne_aaData($data['image']['section1']);
        //
        $data['image']['section3'] = $this->repository->getOrmByType('image.home.section3');
        $data['image']['section3'] = $this->presenter->eachOne_aaData($data['image']['section3']);
        //
        $data['footer'] = $this->repository->getOrmByType('footer.home');
        $data['footer'] = $this->presenter->eachOne_aaData($data['footer']);

        return view('front.index', compact('data'));
    }

    public function getParameters()
    {
        return [
            'meta_title' => json_decode( Setting::query()->where('name', 'meta_title')->first()->content ),
            'meta_keyword' => json_decode( Setting::query()->where('name', 'meta_keyword')->first()->content ),
            'meta_description' => json_decode( Setting::query()->where('name', 'meta_description')->first()->content ),
            'external_link' => Setting::query()->where('type', 'external_link')
                ->orderBy('rank', 'asc')
                ->get(['type','name','content','value']),
        ];
    }





    /*
     * play play play 1/3
     */
    public function playGame1(Request $request)
    {
        $x = $request->exists('x')? $request->input('x') : 20;
        $y = $request->exists('y')? $request->input('y') : 20;
        $n = $request->exists('n')? $request->input('n') : 50;
        $this->view = View()->make( 'playgame1' );
        $this->view->with( 'vTitle', 'Minesweeper' );
        $this->view->with( 'icon', '' );
        $this->view->with( 'X', $x );
        $this->view->with( 'Y', $y );
        $this->view->with( 'N', $n );
        return $this->view;
    }

    /*
     * play play play 2/3
     */
    public function init(Request $request)
    {
        $x = $request->input('x')? $request->input('x') : 20;
        $y = $request->input('y')? $request->input('y') : 20;
        $n = $request->input('n')? $request->input('n') : 50;
        $a = $request->input('aaData')? $request->input('aaData') : 0;
        $b = $request->input('bbData')? $request->input('bbData') : 0;
        $i = $request->input('i')? $request->input('i') : 0;
        $j = $request->input('j')? $request->input('j') : 0;

        if ( $a && $b && $i && $j ){    //button onClick
            $a = json_decode($a);
            $b = json_decode($b);
            if ($a[$i][$j] == 'X') {    //game over
                $b[$i][$j] = 1;
                $a[$i][$j] = 'X';
//                foreach ($a as $aa) {
//                    $aa = array_replace(
//                        $aa,
//                        array_fill_keys(
//                            array_keys(
//                                preg_grep('/^O/', $aa)
//                            ),
//                            ' '
//                        )
//                    );
//                }
//                        $v = str_replace('O','',$v);
                $this->rtndata['status'] = 0;
            } else {
                $this->trace($a, $b, $i, $j);
                //************ You Win ************
                $win = true;
                foreach ($a as $val) {
                    if (in_array(' ', $val)) {
                        $win = false;
                        break;
                    }
                }
                if ($win)
                    $this->rtndata['status'] = 2;       //you win
                else
                    $this->rtndata['status'] = 1;
            }
        } else {    //init
            $a = array();   //Result
            $b = array();   //beClick
            //button initial
            for ($i = 0; $i < $y+2; $i++ ) {
                for ($j = 0; $j < $x+2; $j++ ) {
                    if ($i == 0 || $i == $y+1 || $j == 0 || $j == $x+1) {   //fence
                        $a[$i][$j] = -1;
                        $b[$i][$j] = 1;
                    } else {    // no yet click
                        $a[$i][$j] = ' ';
                        $b[$i][$j] = 0;
                    }
                }
            }
            //mine initial
            while ($n) {
                $r = rand(1, $x);
                $rr = rand(1, $y);
                if ($a[$r][$rr] != 'X') {
                    $a[$r][$rr] = 'X';
                    $n--;
                }
            }
        }
        $this->rtndata['aaData'] = $a ;
        $this->rtndata['bbData'] = $b ;
        return response()->json( $this->rtndata );
    }

    // play play play 3/3
    public function trace( &$a, &$b, $i, $j )
    {
        if ($a[$i][$j]==-1) return null;
        if ($a[$i][$j]=='X') return null;
        if ($b[$i][$j]==1) return null;

        $b[$i][$j] = 1;

        $amount = 0;
        $minesweep = 'X';
        if ( $a[$i-1][$j-1]==$minesweep ){
            $amount++;
        }
        if ( $a[$i-1][$j-0]==$minesweep ){
            $amount++;
        }
        if ( $a[$i-1][$j+1]==$minesweep ){
            $amount++;
        }
        if ( $a[$i+0][$j-1]==$minesweep ){
            $amount++;
        }
        if ( $a[$i+0][$j+1]==$minesweep ){
            $amount++;
        }
        if ( $a[$i+1][$j-1]==$minesweep ){
            $amount++;
        }
        if ( $a[$i+1][$j+0]==$minesweep ){
            $amount++;
        }
        if ( $a[$i+1][$j+1]==$minesweep ){
            $amount++;
        }
        $a[$i][$j] = $amount ? $amount : '';

        if($amount==0) {
            $this->trace($a, $b, $i - 1, $j - 0);
            $this->trace($a, $b, $i - 0, $j - 1);
            $this->trace($a, $b, $i + 0, $j + 1);
            $this->trace($a, $b, $i + 1, $j + 0);
            $this->trace($a, $b, $i - 1, $j - 1);
            $this->trace($a, $b, $i - 1, $j + 1);
            $this->trace($a, $b, $i + 1, $j - 1);
            $this->trace($a, $b, $i + 1, $j + 1);
        }

        return null;
    }
}
