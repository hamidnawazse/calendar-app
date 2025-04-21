<?php

namespace App\Http\Controllers;
use App\Models\BlockedDate;
use App\Models\RestrictedWeekday;

use Illuminate\Http\Request;

class AdminController extends Controller
{

 public function showWeekdayForm()
{
    $restrictedDays = RestrictedWeekday::pluck('weekday')->toArray();
    return view('admin.restrict_days', compact('restrictedDays'));
}

public function saveWeekdays(Request $request)
{
    RestrictedWeekday::truncate(); // clear old data

    foreach ($request->weekdays as $day) {
        RestrictedWeekday::create(['weekday' => $day]);
    }

    return back()->with('success', 'Weekdays updated successfully!');
}
}
