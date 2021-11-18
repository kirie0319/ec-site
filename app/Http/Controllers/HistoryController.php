<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\User;
use App\Models\History;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $histories = History::all();
        foreach($histories as $history) {
            $history->item = Image::where('id', $history->image_id)->first();
        }
        return response()->json([
            'items' => $histories
        ], 200);
    }

    public function cart(Request $request)
    {
        History::create([
            'order_id' => $request->random_txt,
            'user_id' => $request->user_id,
            'image_id' => $request->image_id,
            'quantity' => $request->quantity
        ]);
    }
}
