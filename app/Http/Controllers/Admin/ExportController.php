<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;

class ExportController extends Controller
{
    //
    function index()
    {
        $customer_data = DB::table('users')->get();
        return view('users')->with('customer_data', $customer_data);
    }

    function excel()
    {
        $customer_data = DB::table('users')->get()->toArray();
        $customer_array[] = array('Customer Name', 'Address', 'City', 'Postal Code', 'Country');
        foreach($customer_data as $customer)
        {
            $customer_array[] = array(
                'Customer Name'  => $customer->name,
                'Address'   => $customer->email,
                'City'    => $customer->password,
                'Postal Code'  => $customer->created_at,
                'Country'   => $customer->updated_at
            );
        }
        Excel::create('Customer Data', function($excel) use ($customer_array){
            $excel->setTitle('Customer Data');
            $excel->sheet('Customer Data', function($sheet) use ($customer_array){
                $sheet->fromArray($customer_array, null, 'A1', false, false);
            });
        })->download('xlsx');
    }


    /*
     * import-execl
     */
    function importView()
    {
        $data = DB::table('users')->orderBy('id', 'DESC')->get();
        return view('import_excel', compact('data'));
    }


    /*
     * import-execl 匯入資料庫，欄位名稱要與這一致
     */
    function import(Request $request)
    {
        $this->validate($request, [
            'select_file'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('select_file')->getRealPath();

        $data = Excel::load($path)->get();

        if($data->count() > 0)
        {
            foreach($data->toArray() as $key => $value)
            {
                foreach($value as $row)
                {
                    $insert_data[] = array(
                        'CustomerName'  => $row['customer_name'],
                        'Gender'   => $row['gender'],
                        'Address'   => $row['address'],
                        'City'    => $row['city'],
                        'PostalCode'  => $row['postal_code'],
                        'Country'   => $row['country']
                    );
                }
            }

            if(!empty($insert_data))
            {
                DB::table('users')->insert($insert_data);
            }
        }
        return back()->with('success', 'Excel Data Imported successfully.');
    }
}
