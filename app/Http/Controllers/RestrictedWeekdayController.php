<?php

namespace App\Http\Controllers;
use App\Models\BlockedDate;
use App\Models\RestrictedWeekday;

use Illuminate\Http\Request;

class RestrictedWeekdayController extends Controller
{

 public function show()
{
    $restrictedDays = RestrictedWeekday::pluck('weekday')->toArray();
    return view('admin.show', compact('restrictedDays'));
}

public function store(Request $request)
{
    RestrictedWeekday::truncate(); // clear old data

    foreach ($request->weekdays as $day) {
        RestrictedWeekday::create(['weekday' => $day]);
    }

    return back()->with('success', 'Weekdays updated successfully!');
}
}
