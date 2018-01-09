<?php

namespace App\Http\Controllers;

use App\order;
use App\Product;
use App\Warehouse;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = new Product();
        $warehouseProducts = $products->orderByDesc('viewAmount')->paginate(3);

        $warehouse = new Warehouse();
        $productsLow = $warehouse->where('supply','<',4)->orderBy('supply')->paginate(3);

        return view('admin/index')
            ->with('warehouseProducts', $warehouseProducts)
            ->with('products',$products)
            ->with('productsLow', $productsLow);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $showProduct = Warehouse::where('product_id','=',$id)->get();

        $thisMonth = [];
        //$thisMonth = array();
        $test = 0;
        $test2 = 0;
        foreach($showProduct as $key => $product )
        {
            if($key == 0)
            $test = $product->id;

            elseif ($key == 1)
                $test2   = $product->id;

        }
//        $thisMonth = order::where([
//            ['bought_at', '>', Carbon::now()->subMonth()],
//            ['warehouse_id','=',$showProduct[0]->id],
//            ['warehouse_id','=',$showProduct[1]->id],
//            ['warehouse_id','=',$showProduct[2]->id],
//            ['warehouse_id','=',$showProduct[3]->id],
//        ])->sum('amount');


        $order = \App\order::where([
            ['warehouse_id','=',$showProduct[0]->id],
            ['warehouse_id','=',$showProduct[1]->id],
            ['warehouse_id','=',$showProduct[2]->id],
            ['warehouse_id','=',$showProduct[3]->id],
        ])->sum('amount');


        if($request->isJson()){
            return response()->json(['showProduct'  => $showProduct,
                                     'thisMonth'    => $thisMonth,
                                     'order'        => $order,
                                     'test'         => $test,
                                     'test2'        => $test2]);

        }
        return view('admin/products/show')->with('showProduct',$showProduct)->with('thisMonth',$thisMonth)->with('urlId',$id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function lowStockList()
    {
        $lowOnStock = \App\Warehouse::where('supply','<',4)->orderBy('supply')->paginate(6);
        return view('admin/products/lowStockList', ['lowOnStock' => $lowOnStock]);
    }
}
