<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function index()
    {
        $reaction = Reaction::all();

        return response()->json(['status' => false, 'data' => $reaction]);
    }

    public function show($id)
    {
        $reaction = Reaction::findOrFail($id);

        return response()->json(['status' => false, 'data' => $reaction]);
    }

    public function store(Request $request)
    {
        $store = validator([
            'post_id',
            'type'
        ]);
        $store = Reaction::create(
            [
                'user_id' => $request->user()->id,
                'post_id' => $request->id,
                'type' => $request->type
            ]
        );

        return response()->json(['data' => $store, 'status' => 200]);
    }

    public function update($id, Request $request)
    {
        $reaction = Reaction::findOrFail($id);
        if ($request->user()->id == $reaction->user_id) {
            $reaction->update([
                'user_id' => $request->user()->id,
                'post_id' => $request->id,
                'type' => $request->type
            ]);
            return response()->json(['data' => $reaction, 'status' => 200]);
        }
        return response()->json(['data' => 'not found', 'status' => 404]);

    }
}