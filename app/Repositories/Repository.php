<?php

namespace App\Repositories\Admin;

//use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class Repository
{
    /**
     * Create a new instance of the given model.
     *
     * @param  array $attributes
     *
     * @return static
     */
    public function newInstance($attributes = [])
    {
        return $this->model->newInstance($attributes);
    }

    /**
     * Create record.
     *
     * @param array $attributes
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    /**
     * Find a model by its primary key.
     *
     * @param  mixed $id
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     *
     */
    public function find($id)
    {
        return $this->model->find($id);
    }
    
    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }
    
    /**
     * Update the model in the database.
     *
     * @param  array $attributes
     * @param  mixed $id
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function update($attributes, $id)
    {
        $model = $this->model->find($id);
        if (filled($model)) {
            $model->update($attributes);

            return $model;
        }
        return null;
    }

    /**
     * Delete the model from the database.
     *
     * @param  mixed $id
     *
     * @return bool|null
     *
     */
    public function delete($id)
    {
        return $this->findOrFail($id)->delete();
    }

    /**
     * If record exist update this record else create it.
     *
     * @param array $attributes This is the attributes using which you want to check in database if the record is
     *                          present
     * @param array $values     This is the new attribute values that you want to create or update
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    public function getModelsByQuery($query, $columns = ['*'], $paginate = null, $with = null)
    {
        if ($with) {
            $query = $query->with($with);
        }

        if ($paginate) {
            return $query->paginate($paginate, $columns);
        }

        return $query->get($columns);
    }

    /**
     * @param                                     $filters
     * @param \Illuminate\Database\Eloquent\Model $query
     * @param                                     $nameSpace
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function filter($filters, $query, $nameSpace) : Builder
    {
        $query = static::filterDecoratorsFromRequest($query->newQuery(), $nameSpace, $filters);

        return $query;
    }

    private static function filterDecoratorsFromRequest(Builder $query, $nameSpace, array $request = []) : Builder
    {
        foreach ($request as $filterName => $value) {
            if (isset($value)) {
                $decorator = static::createFilterDecorator($filterName, $nameSpace);
                if (static::isValidDecorator($decorator)) {
                    $query = $decorator::applyFilter($query, $value);
                }
            }
        }

        return $query;
    }

    private static function createFilterDecorator($name, $nameSpace)
    {
        return $nameSpace . studly_case($name);
    }

    private static function isValidDecorator($decorator)
    {
        return class_exists($decorator);
    }

    public function imageQualityAdd($data)
    {
        $return_data = [];
        foreach ($data as $key => $value) {
            if($value['type'] == 'image'){

                $large = [
                    "path" => $this->pathUrl($value['path'], 'large'),
                    "type" => "image",
                    "usage" => $value['usage'],
                    "quality" => "large"
                ];

                $small = [
                    "path" => $this->pathUrl($value['path'], 'small'),
                    "type" => "image",
                    "usage" => $value['usage'],
                    "quality" => "small"
                ];

                $original = [
                    "path" => $this->pathUrl($value['path'], 'original'),
                    "type" => "image",
                    "usage" => $value['usage'],
                    "quality" => "original"
                ];

                array_push($return_data, $large, $small, $original);
            } else {
                array_push($return_data, $value);
            }
        }

        return $return_data;
    }

    public function pathUrl($path, $quality)
    {
        $url = '';

        if (strpos($path, "/images/large/")) {
            $url = str_replace('/images/large/', '/images/'. $quality .'/', $path);
        }

        if (strpos($path, "/images/small/")) {
            $url = str_replace('/images/small/', '/images/'. $quality .'/', $path);
        }

        if (strpos($path, "/images/original/")) {
            $url = str_replace('/images/original/', '/images/'. $quality .'/', $path);
        }
        
        return $url;
    }



    /*
     *
     */
    public function searchQuery($search_arr=[], $search_word='' )
    {
        return $this->model->where(function( $query ) use ( $search_arr, $search_word ) {
            foreach ($search_arr as $item) {
                $query->orWhere( $item, 'like', '%' . $search_word . '%' );
            }
        });
    }

    public function getDataTable2($request = null)
    {
        return datatables()->of($this->model::latest()->get())
            ->addColumn('action', function($data){
                $button = '';
                $button .= '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Edit</button>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="show" id="'.$data->id.'" class="show btn btn-default btn-sm">Show</button>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Delete</button>';
                return $button;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function getDataTable($request)
    {
        //
        $sort_arr = [];
        $search_arr = [];   //要搜尋的目標欄位名稱
        $search_word = $request->input('sSearch', '');
        $iDisplayLength = $request->input('iDisplayLength', 10);
        $iDisplayStart = $request->input('iDisplayStart', 0);
        $sEcho = $request->input('sEcho', '');
        $column_arr = explode(',', $request->input('sColumns', ''));
        foreach ($column_arr as $key => $item)
        {
            if ($item == "") {
                unset( $column_arr[$key] );
                continue;
            }
            if ($request->input( 'bSearchable_' . $key ) == "true") {
                $search_arr[$key] = $item;
            }
            if ($request->input( 'bSortable_' . $key ) == "true") {
                $sort_arr[$key] = $item;
            }
        }
        $sort_name = $sort_arr[ $request->input( 'iSortCol_0' ) ];
        $sort_dir = $request->input( 'sSortDir_0' );

        $total_count = $this->searchQuery($search_arr, $search_word )->count();

        $data_arr = $this->searchQuery($search_arr, $search_word )
            ->orderBy( $sort_name, $sort_dir )
            ->offset($iDisplayStart)->limit($iDisplayLength)
            ->get();
        if ( !$data_arr)
        {
            return response()->json([
                'status'=> 0,
                'message'=> ['Oops! 沒有資料!']
            ],204);
        }
        return response()->json([
            'status'=> 1,
            'message'=> sprintf("已得到 %s", $total_count."筆資料"),
            'sEcho'=>$sEcho,
            'iTotalDisplayRecords'=>$total_count,
            'iTotalRecords'=>$total_count,
            'aaData'=> $data_arr
        ],200);
    }
}
