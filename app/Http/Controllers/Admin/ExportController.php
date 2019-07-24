<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Excel;
use PDF;

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




    function pdf()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->convert_customer_data_to_html());
        return $pdf->stream();
    }


    function convert_customer_data_to_html()
    {
//        $customer_data = $this->get_customer_data();
        $products = Product::all();
//        dd($products);
        $output = '
             <h3 align="center">Customer Data</h3>
             <table width="100%" style="border-collapse: collapse; border: 0px;">
              <tr>
            <th style="border: 1px solid; padding:12px;" width="20%">Name</th>
            <th style="border: 1px solid; padding:12px;" width="30%">Address</th>
            <th style="border: 1px solid; padding:12px;" width="15%">City</th>
            <th style="border: 1px solid; padding:12px;" width="15%">Postal Code</th>
            <th style="border: 1px solid; padding:12px;" width="20%">Country</th>
           </tr>
             ';
        foreach($products as $product)
        {
            $output .= '
              <tr>
               <td style="border: 1px solid; padding:12px;">'.$product->name.'</td>
               <td style="border: 1px solid; padding:12px;">'.$product->price.'</td>
               <td style="border: 1px solid; padding:12px;">'.$product->total.'</td>
               <td style="border: 1px solid; padding:12px;">'.$product->image.'</td>
               <td style="border: 1px solid; padding:12px;">'.$product->created_at.'</td>
              </tr>
              ';
        }
        $output .= '</table>';
        return $output;
    }


    /*
     * Scene 2016 function
     */
    public function import2016 (Request $request)
    {
        $chooseType = $request->get('importTable') ? $request->get('importTable') : '';

        //validate the xls file
        $this->validate($request, array(
            'file'      => 'required'
        ));

        if($request->hasFile('file'))
        {
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv")
            {
                $path = $request->file->getRealPath();
                $data = Excel::load($path, function($reader){})->get();
                if(!empty($data) && $data->count())
                {
                    switch ($chooseType)
                    {
                        case 'reservoir':
                            // Excel Sheet 1
                            try {
                                foreach ($data[0] as $key => $value) {
                                    $insert[] = [
                                        'vRegion' => $value->region,
                                        'vName' => $value->name,
                                        'vLocation' => $value->location,
                                        'vCounty' => $value->county,
                                        'iCreateTime' => time(),
                                        'iUpdateTime' => time(),
                                    ];
                                }
                            }
                            catch (\Exception $e) {
                                Session::flash('error', $e->getMessage());
                            }
                            try {
                                if (!empty($insert)) {
                                    DB::table('mod_reservoir')->delete();
                                    $insertData = DB::table('mod_reservoir')->insert($insert);
                                    if ($insertData) {
                                        Session::flash('success', 'Your Data has successfully imported');
                                    } else {
                                        Session::flash('error', 'Error inserting the data..');
                                        return back();
                                    }
                                }
                            }
                            catch (\Exception $e){
                                Session::flash('error', $e->getMessage());
                            }

                            // Excel Sheet 2
                            try {
                                foreach ($data[1] as $key => $value) {
                                    $insert2[] = [
                                        'iRank' => $value->rank,
                                        'vStructure' => $value->structure,
                                        'vLevel' => $value->level,
                                        'iHeight' => $value->height == '- ' ? 0 : $value->height,
                                        'iStoreTotal' => $value->store_total == '- ' ? 0 : $value->store_total,
                                        'vGrade' => $value->grade,
                                        'vTrustRegion' => $value->trust_region,
                                        'vNumber' => $value->number,
                                        'vNet' => $value->net,
                                        'vAreaCode' => $value->area_code,
                                        'iCreateTime' => time(),
                                        'iUpdateTime' => time(),
                                    ];
                                }
                            }
                            catch (\Exception $e){
                                Session::flash('error', $e->getMessage());
                            }
                            try {
                                if(!empty($insert)){
                                    DB::table('mod_reservoir_meta')->delete();
                                    $insertData = DB::table('mod_reservoir_meta')->insert($insert2);
                                    if ($insertData) {
                                        Session::flash('success', 'Your Data has successfully imported');
                                    }else {
                                        Session::flash('error', 'Error inserting the data..');
                                        return back();
                                    }
                                }
                            }
                            catch (\Exception $e){
                                Session::flash('error', $e->getMessage());
                            }
                            break;
                        case 'member':
                            Session::flash('error', 'SORRY~會員匯入功能還沒開放');
                            break;
                    }
                }
                return back();
            }
            else
            {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid xls/csv file..!!');
                return back();
            }
        }
        return null;
    }

}
