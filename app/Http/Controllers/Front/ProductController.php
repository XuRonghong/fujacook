<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use PDF;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        //
        $products = Product::all()->toArray();
        return view('front.product.index', compact('products', 'data'));
    }


    public function search()
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [];
        //
        return view('front.product.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required'
        ]);
        $product = new Product([
            'name' => $request->get('name'),
            'price' => $request->get('price'),
        ]);
        $product->save();
        return redirect()->route('product.index')->with('success', 'Data Added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [];
        //
        $product = Product::find($id);
        return view('front.product.edit', compact('product', 'id', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'price' => 'required'
        ]);
        $product = Product::find($id);
        $product->name = $request->get('name', '');
        $product->price = $request->get('price', '');
        $product->save();
        return redirect()->route('product.index')->with('success', 'Data Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Data Deleted.');
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
}
