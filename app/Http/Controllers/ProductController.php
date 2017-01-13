<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\SalesTracker\Entities\Inventory\Warehouse_Product;
use App\SalesTracker\Entities\Product\Product;
use App\SalesTracker\Services\productService;
use App\SalesTracker\Services\StockService;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\String_;


class ProductController extends Controller
{
    /**
     * @var productService
     */
    public $productService;
    /**
     * @var stockService
     */
    private $stockService;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(productService $productService,stockService $stockService)
    {
        $this->middleware(['auth']);
        $this->productService = $productService;
        $this->stockService = $stockService;
    }

    public function index()
    {
        $data = Product::all();
        return view('product.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $ware = $this->stockService->get_allwarehouse();
        return view('product.create',compact('ware'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //dd($request->all());
        if ($product=$this->productService->storeproduct($request))
        {
           $productwarehouse = [
                'product_id' => $product->id,
                'warehouse_id' => $request->get('warehouse_id')

            ];
        $this->assignwarehouse($productwarehouse);

            return redirect('/product')->withSuccess('Product Added');
        }
        return back()->withErrors('something went wrong');
    }

    protected function assignwarehouse(array $data)
    {
        return Warehouse_Product::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $product = Product::find($id);
        return view('product.edit', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {

        if ($this->productService->editproduct($request, $id)) {
            return redirect('/product')->withSuccess('Product Edited');
        }
        return back()->withErrors('something went wrong');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if ($this->productService->deleteproduct($id)) {
            return redirect('/product')->withSuccess('Product Deleted');
        }
        return back()->withErrors('something went wrong');

//        $data = Product::find($id);
//        $data->delete();
//        session()->flash('alert-danger', 'Product was deleted successfully!');
//        return redirect('product');

    }

    public function updateprice(Request $request, $id)
    {

        if ($this->productService->changeprice($request, $id)) {
            return redirect('product')->withSuccess('Price Changed');
        }
        return back()->withErrors('something went  wrong');
    }
}


















