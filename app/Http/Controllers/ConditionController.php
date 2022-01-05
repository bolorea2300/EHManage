<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Condition;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class ConditionController extends Controller
{
    function list()
    {
        $id = Auth::id();

        $data = Condition::where("user_id", $id)->orderBy('time', 'DESC')->paginate(30);
        $count = Condition::where("user_id", $id)->count();
        return response()->json(["data" => $data, "count" => $count]);
    }

    function create(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'temperature' => 'required|numeric',
            'rating' => 'required|integer'
        ]);

        $id = Auth::id();
        $date = $request->date;
        $temperature = $request->temperature;
        $rating = $request->rating;

        Condition::create([
            'user_id' => $id,
            'temperature' => $temperature,
            'rating' => $rating,
            'time' => $date,
        ]);


        $data = Condition::where("user_id", $id)->orderBy('time', 'DESC')->paginate(30);
        $count = Condition::where("user_id", $id)->count();
        return response()->json(["data" => $data, "count" => $count]);
    }

    function delete(Request $request)
    {
        $id = $request->id;
        $user_id = Auth::id();

        Condition::where("user_id", $user_id)->where("id", $id)->delete();

        $data = Condition::where("user_id", $user_id)->orderBy('time', 'DESC')->paginate(30);
        $count = Condition::where("user_id", $user_id)->count();
        return response()->json(["data" => $data, "count" => $count]);
    }

    function month(Request $request)
    {
        $requestdate = $request->date;
        $date = explode("-", $requestdate);
        $user_id = Auth::id();

        $data = Condition::where("user_id", $user_id)->whereYear('created_at', '=', $date[0])->whereMonth('created_at', '=', $date[1])->orderBy('time', 'ASC')->get();

        return response()->json($data);
    }

    function year(Request $request)
    {
        $date = $request->date;
        $user_id = Auth::id();

        $data = Condition::where("user_id", $user_id)->whereYear('created_at', '=', $date)->orderBy('time', 'ASC')->get();

        return response()->json($data);
    }
}
