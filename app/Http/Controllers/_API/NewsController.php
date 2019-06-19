<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_API;

use App\ModNews;
use Illuminate\Http\Request;

class NewsController extends _APIController
{
    /*
     *
     */
    public function getList ( Request $request )
    {
        $date_time = time();
        if ($request->exists( 'cate' )) {
            $map['mod_news.iCategoryType'] = $request->input( 'cate' );
        }
        $map['mod_news.iStatus'] = 1;
        $map['mod_news.bDel'] = 0;
        $data_arr = ModNews::join( 'sys_category', function( $join ) {
            $join->on( 'sys_category.iId', '=', 'mod_news.iCategoryType' );
        } )->where( $map )->where( function( $query ) use ( $date_time ) {
            $query->where( 'iStartTime', '<', $date_time );
            $query->where( 'iEndTime', '>', $date_time );
        } )->orderBy( 'mod_news.iRank', 'ASC' )->select(
            'mod_news.iId',
            'mod_news.vTitle',
            'mod_news.vSummary',
            'mod_news.vImages',
            'mod_news.vUrl',
            'mod_news.iStartTime',
            'mod_news.iEndTime',
            'sys_category.vCategoryName'
        )->get();
        foreach ($data_arr as $item) {
            $item->iStartTime = ( $item->iStartTime ) ? date( 'Y-m-d', $item->iStartTime ) : "";
            $item->iEndTime = ( $item->iEndTime ) ? date( 'Y-m-d', $item->iEndTime ) : "";
            $item->url = url( 'news/detail/' . $item->iId );
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }
}
