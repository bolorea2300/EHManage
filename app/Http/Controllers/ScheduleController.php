<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\schedule;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    function create(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i|after:start',
            'text' => 'required|string'
        ]);


        $id = Auth::id();
        $date = $request->date;
        $start = $request->start;
        $end = $request->end;
        $name = $request->text;

        schedule::create([
            'user_id' => $id,
            'start' => $date . " " . $start,
            'end' => $date . " " . $end,
            'name' => $name,
        ]);
    }

    function delete(Request $request)
    {
        $id = $request->id;
        $user_id = Auth::id();

        schedule::where("user_id", $user_id)->where("id", $id)->delete();

        $data = schedule::select("id", "start", "end", "name")->where("user_id", $id)->get();
        return response()->json($data);
    }

    function get()
    {
        $id = Auth::id();
        $data = schedule::select("id", "start", "end", "name")->where("user_id", $id)->get();
        return response()->json($data);
    }

    function year()
    {
        $id = Auth::id();
        $data = schedule::select("id", "start", "end", "name")->where("user_id", $id)->get();
        return response()->json($data);
    }
}
