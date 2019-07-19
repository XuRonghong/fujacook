<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ArticleController extends Controller
{
    //
    function index()
    {
        return view('front.load_more');
    }

    function load_data(Request $request)
    {
        if($request->ajax())
        {
            if($request->id > 0)
            {
                $data = DB::table('country_state_city')
                    ->where('id', '<', $request->id)
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();
            }
            else
            {
                $data = DB::table('country_state_city')
                    ->orderBy('id', 'DESC')
                    ->limit(5)
                    ->get();
            }
            $output = '';
            $last_id = '';

            if(!$data->isEmpty())
            {
                foreach($data as $row)
                {
                    $output .= '
        <div class="row">
         <div class="col-md-12">
          <h3 class="text-info"><b>'.$row->country.'</b></h3>
          <p>'.$row->state.'</p>
          <br />
          <div class="col-md-6">
           <p><b>Publish Date - '.$row->city.'</b></p>
          </div>
          <div class="col-md-6" align="right">
           <p><b><i>By - '.$row->id.'</i></b></p>
          </div>
          <br />
          <hr />
         </div>         
        </div>
        ';
                    $last_id = $row->id;
                }
                $output .= '
       <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-success form-control" data-id="'.$last_id.'" id="load_more_button">Load More</button>
       </div>
       ';
            }
            else
            {
                $output .= '
       <div id="load_more">
        <button type="button" name="load_more_button" class="btn btn-info form-control">No Data Found</button>
       </div>
       ';
            }
            echo $output;
        }
    }
}
