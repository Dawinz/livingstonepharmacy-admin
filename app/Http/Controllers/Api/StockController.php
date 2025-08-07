<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StockController extends Controller
{
    public function index()
    {
        $business_id = auth()->user()->business_id;

        $products_count = Product::where('business_id', $business_id)->count();
        $low_stock_count = DB::table('products')
                            ->where('products.business_id', $business_id)
                            ->join('stocks', 'products.id', '=', 'stocks.product_id')
                            ->select('products.id', 'products.alert_qty', DB::raw('SUM(stocks.productStock) as totalStock'))
                            ->groupBy('products.id', 'products.alert_qty')
                            ->havingRaw('totalStock < alert_qty')
                            ->count();

        $total_stock_value = DB::table('products')
                                ->where('products.business_id', $business_id)
                                ->join('stocks', 'products.id', '=', 'stocks.product_id')
                                ->select(DB::raw('SUM(stocks.productStock * products.purchase_with_tax) as totalStockValue'))
                                ->value('totalStockValue');

        $stocks = Product::select('id', 'productName', 'purchase_with_tax', 'sales_price')
                    ->when(request('search'), function ($query) {
                        $query->where(function ($subQuery) {
                            $subQuery->where('productName', 'like', '%' . request('search') . '%')
                                ->orWhere('productCode', 'like', '%' . request('search') . '%')
                                    ->orWhereHas('stocks', function ($query) {
                                        $query->where('batch_no', 'like', '%' . request('search') . '%');
                                    });
                        });
                    })
                    ->withSum('stocks', 'productStock')
                    ->where('business_id', $business_id)
                    ->with('stocks:id,batch_no,expire_date,product_id,productStock')
                    ->latest()
                    ->paginate(10);

        return response()->json([
            'message' => __('Data fetched successfully.'),
            'total_products' => $products_count,
            'low_stock_count' => $low_stock_count,
            'total_stock_value' => $total_stock_value,
            'stocks' => $stocks,
        ]);
    }
}
