<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facdes\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response() ->json([
            'error' => false,
            'items' => Item::all(),
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make(

            $request->all(),
            [
                'name'=>'required',
                'quantity'=>'required',
                'price'=>'required',
            ]
        );

        if($validation->fails()){

            return reponse() ->json([
                'error' => true,
                'message' => $validation->errors(),
            ],200);

        } else {

            $item = new Item;
            $item->name = $request->input('name');
            $item->quantity = $request->input('quantity');
            $item->price = $request->input('price');
            $item->save();

            return reponse() ->json([
                'error' => false,
                'message' => 'Item added successfully',
                'item' => $item,
            ],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);

        if(is_null($item)){
            return reponse() ->json([
                'error' => false,
                'message' => 'Item with given id $id not found',
                'item' => $item,
            ],404); 
        }

        return reponse()->json([
            'error' => false,
            'item' => $item,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make(

            $request->all(),
            [
                'name'=>'required',
                'quantity'=>'required',
                'price'=>'required',
            ]
        );

        if($validation->fails()){

            return reponse() ->json([
                'error' => true,
                'message' => $validation->errors(),
            ],200);

        } else {

            $item = Item::find($id);
            $item->name = $request->input('name');
            $item->quantity = $request->input('quantity');
            $item->price = $request->input('price');
            $item->save();

            return reponse() ->json([
                'error' => false,
                'message' => 'Item updated successfully',
                'item' => $item,
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);

        if(is_null($item)){
            return reponse() ->json([
                'error' => false,
                'message' => 'Item with given id $id not found',
                'item' => $item,
            ],404); 
        }

        $item->delete();

        return reponse()->json([
            'error' => false,
            'message' => "Item with given id $id deleted successfully",
        ]);
    }
}
