<?php

namespace App\Http\Controllers;
use App\Models\RestrictedWeekday;
use App\Models\OrderRecord;
use App\Models\UserOrder;
use App\Models\AddDate;

use Illuminate\Http\Request;

class DateSelectionController extends Controller
{
    //
    public function show()
    {
        //get the count of the orders set by Admin
        $orderRecord=RestrictedWeekday::first();
        $orderCountLimit=$orderRecord->order_count;
        //calculate the count if number of placed orders for a particular day is greater than or equal to the limit set by the Admin
        $blockedDates = UserOrder::select('order_date')
        ->groupBy('order_date')
        ->havingRaw('COUNT(*) >= ?', [$orderCountLimit])
        ->pluck('order_date')
        ->toArray();

        $restrictedDays=RestrictedWeekday::pluck('weekday')->toArray();
        return view('user.show',compact('restrictedDays','blockedDates')); 
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
