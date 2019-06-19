<?php
// debugbar()->info($this->func);
// debugbar()->error('Error!');
// debugbar()->warning('Watch out…');
// debugbar()->addMessage('Another message', 'mylabel');
namespace App\Http\Controllers\_API;

use App\ModOrganization;
use App\ModProduct;
use App\ModProductInfo;
use App\SysGroup;
use App\SysGroupInfo;
use Illuminate\Http\Request;

class SearchController extends _APIController
{
    /*
     *
     */
    public function getList ( Request $request )
    {
        $keyword = $request->exists( 'keyword' ) ? $request->input( 'keyword' ) : "";
        $map['mod_product.bShow'] = 1;
        $map['mod_product.bOpen'] = 1;
        $map['mod_product.bDel'] = 0;
        $data_arr = ModProduct::query()->where( $map )
            ->join( 'mod_product_info', function( $join ) {
                $join->on( 'mod_product.iId', '=', 'mod_product_info.iProductId' );
            })
            ->join( 'mod_product_spec', function( $join ) {
                $join->on( 'mod_product.iId', '=', 'mod_product_spec.iProductId' );
            })
            ->where( function( $query ) use ( $keyword ) {
                $query->orWhere( 'vProductCompany', 'like', '%' . $keyword . '%' );
                $query->orWhere( 'vProductNum', 'like', '%' . $keyword . '%' );
                $query->orWhere( 'vProductName', 'like', '%' . $keyword . '%' );
                $query->orWhere( 'vProductSummary', 'like', '%' . $keyword . '%' );
                $query->orWhere( 'vProductDetail', 'like', '%' . $keyword . '%' );
                $query->orWhere( 'vProductDetailOriginal', 'like', '%' . $keyword . '%' );
            })
            ->select(
                'mod_product.iId',
                'mod_product_info.vImages',
                'mod_product.vProductCode',
                'vProductName',
                'vProductNum',
                'mod_product_spec.iSpecPrice'
//                'mod_product.price'
            )
//            ->groupBy('mod_product_spec.iProductId')
            ->get();
        foreach ($data_arr as $item) {
            $tmp_arr = explode( ';', $item->vImages );
            $tmp_arr = array_filter( $tmp_arr );
            if (isset( $tmp_arr[0] )) {
                $item->vImages = $tmp_arr[0];
            } else {
                $item->vImages = asset( '/images/empty.jpg' );
            }
            $item->url = url( 'product/detail/' . $item->vProductCode );
        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }


    /*
     *
     */
    public function getGroupList ( Request $request )
    {
        $keyword = $request->exists( 'keyword' ) ? $request->input( 'keyword' ) : "";
        $map['iStatus'] = 1;
        $map['bDel'] = 0;
        $data_arr = SysGroup::query()
//            ->leftJoin( 'sys_group_info', function( $join ) {
//            $join->on( 'sys_group.iId', '=', 'sys_group_info.iGroupId' );
//        } )
            ->where( function( $query ) use ( $keyword ) {
            $query->orWhere( 'iGroupType', 'like', '%' . $keyword . '%' );
            $query->orWhere( 'vGroupCode', 'like', '%' . $keyword . '%' );
            $query->orWhere( 'vGroupName', 'like', '%' . $keyword . '%' );
//            $query->orWhere( 'vProductSummary', 'like', '%' . $keyword . '%' );
//            $query->orWhere( 'vProductDetail', 'like', '%' . $keyword . '%' );
//            $query->orWhere( 'vProductDetailOriginal', 'like', '%' . $keyword . '%' );
        } )->where( $map )->select(
            'sys_group.iId',
//            'vImages',
            'vGroupCode',
            'vGroupName',
            'iLimitCount'
        )->get();
//        foreach ($data_arr as $item) {
//            $tmp_arr = explode( ';', $item->vImages );
//            $tmp_arr = array_filter( $tmp_arr );
//            if (isset( $tmp_arr[0] )) {
//                $item->vImages = $tmp_arr[0];
//            } else {
//                $item->vImages = asset( '/images/empty.jpg' );
//            }
//            $item->url = url( 'product/detail/' . $item->vProductCode );
//        }

        $this->rtndata ['status'] = 1;
        $this->rtndata ['aaData'] = $data_arr;

        return response()->json( $this->rtndata );
    }
}
