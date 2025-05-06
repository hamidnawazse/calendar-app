<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\RestrictedWeekday;
use App\Models\OrderRecord;
use App\Models\UserOrder;
use App\Models\AddDate;
use App\Models\OrderItem;
use App\Models\Product;

use Illuminate\Http\Request;

class DateSelectionController extends Controller
{
    //
    public function show()
    {
        //get the count of the orders set by Admin
        $orderRecord=RestrictedWeekday::first();
        $orderCountLimit=$orderRecord->order_count;
        // get the count of the product type
        $productCount=$orderRecord->product_count;
        $orderProductLimit=$orderRecord->product_count;
       // return $orderProductLimit;

       $restrictions = RestrictedWeekday::all();
       $blockedDates_type = [];
       
       foreach ($restrictions as $record) {
           $exceededDates = DB::table('order_items')
               ->join('user_orders', 'order_items.user_orders_id', '=', 'user_orders.id')
               ->join('products', 'order_items.product_id', '=', 'products.id')
               ->where('products.product_type', $record->product_type)
               ->select('user_orders.order_date', DB::raw('COUNT(*) as total'))
               ->groupBy('user_orders.order_date')
               ->having('total', '>=', $record->product_count)
               ->pluck('user_orders.order_date')
               ->toArray();
       
           $blockedDates_type = array_merge($blockedDates_type, $exceededDates);
       }
       
       // Remove duplicate dates (in case same date exceeded for multiple products)
       $blockedDates_type = array_unique($blockedDates_type);

      // return $blockedDates_type;
    
       


        // $orderCounts = DB::table('order_items')
        // ->join('products', 'order_items.product_id', '=', 'products.id')
        // ->select('products.product_type', DB::raw('COUNT(*) as total_orders'))
        // ->groupBy('products.product_type')
        // ->get();
        //calculate the count if number of placed orders for a particular day is greater than or equal to the limit set by the Admin
        $blockedDates = UserOrder::select('order_date')
        ->groupBy('order_date')
        ->havingRaw('COUNT(*) >= ?', [$orderCountLimit])
        ->pluck('order_date')
        ->toArray();
        // Calculate the count if number of product type 


        $restrictedDays=RestrictedWeekday::pluck('weekday')->toArray();
        return view('user.show',compact('restrictedDays','blockedDates','blockedDates_type')); 
    } 

    public function store(Request $request)
    {
        $request->validate([
            'selected_date' => 'required|date',
        ]);
    
        AddDate::firstOrCreate([
            'selected_date' => $request->selected_date
        ]);
    
        return back()->with('success', 'Data saved successfully!');
    }
}
