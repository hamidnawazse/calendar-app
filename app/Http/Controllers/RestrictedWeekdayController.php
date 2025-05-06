<?php

namespace App\Http\Controllers;
use App\Models\BlockedDate;
use App\Models\RestrictedWeekday;
use App\Models\Product;

use Illuminate\Http\Request;

class RestrictedWeekdayController extends Controller
{

 public function show()
{
    $productTypes=Product::pluck('product_type')->toArray();
    $restrictedDays = RestrictedWeekday::pluck('weekday')->toArray();
    return view('admin.show', compact('restrictedDays','productTypes'));
}

public function store(Request $request)
{
    RestrictedWeekday::truncate(); // clear old data

    foreach ($request->weekdays as $day) {
        RestrictedWeekday::create([
            'weekday' => $day,
            'order_count' => $request->order_count,
            'product_type' => $request->product_type,
            'product_count' => $request->product_count
    ]);
    }
    //RestrictedWeekday::create(['order_count' => $order_Count]);

    return back()->with('success', 'Weekdays updated successfully!');
}
}
