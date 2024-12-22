<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingList;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function show()
    {
        $data = ShoppingList::where(["user_id" => Auth::id()])->get();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        try {

            $request->validate([
                "name" => "required",
                "quantity" => "required",
                "price" => "required"
            ]);

            $list = new ShoppingList();
            $list->user_id = Auth::id();
            $list->name = $request->name;
            $list->quantity = $request->quantity;
            $list->price = $request->price;

            $list->save();

            return response()->json(["message" => "Shopping item added", "status" => true]);
        } catch (\Exception $e) {

            return response()->json(["message" => $e->getMessage(), "status" => true], 500);
        }
    }
}
