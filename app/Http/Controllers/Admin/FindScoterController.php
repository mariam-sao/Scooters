<?php

namespace App\Http\Controllers\Admin;

use App\Models\Scoter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FindScoterController extends Controller
{
    public function index(Request $request){
        $time_from = $request->input('time_from');
        $time_to = $request->input('time_to');

        if ($request->isMethod('POST')) {
            $scoters = Scoter::with('booking')->whereHas('booking', function ($q) use ($time_from, $time_to) {
                $q->where(function ($q2) use ($time_from, $time_to) {
                    $q2->where('time_from', '>=', $time_to)
                       ->orWhere('time_to', '<=', $time_from)
                       ->orWhere('status', 'completed')
                       ->orWhere('status', 'cancelled');
                });
            })->orWhereDoesntHave('booking')->get();
        } else {
            $scoters = [];
        }
        
        return view('admin.find_scoters.index', compact('scoters', 'time_from', 'time_to'));
    }
}
