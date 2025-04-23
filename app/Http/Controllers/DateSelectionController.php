<?php

namespace App\Http\Controllers;
use App\Models\RestrictedWeekday;
use App\Models\AddDate;

use Illuminate\Http\Request;

class DateSelectionController extends Controller
{
    //
    public function show()
    {
        $restrictedDays=RestrictedWeekday::pluck('weekday')->toArray();
        return view('user.show',compact('restrictedDays')); 
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
