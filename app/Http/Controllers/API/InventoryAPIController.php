<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use App\Models\User;
use App\Models\Inventory;


class InventoryAPIController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Inventory $inventory
     * @return \Illuminate\Http\Response
     */
//    public function destroy(Inventory $inventory)
//    {
//        //
//    }

    public function getUserItems($userId, $type = null)
    {
        $user = User::find($userId);

        if (empty($user)) {
            return $this->sendError('User not found', 500);
        }

        if (empty($type)) {
            $getUserItems = DB::table('inventories')
                ->join('items', 'items.id', '=', 'inventories.itemId')
                ->where('userId', '=', $userId)
                ->get();
            return response()->success($getUserItems, 'Items received successfully');
        } else {
            $getUserItemsByType = DB::table('inventories')
                ->join('items', 'items.id', '=', 'inventories.itemId')
                ->where('userId', '=', $userId)
                ->where('items.type', '=', $type)
                ->get();
        }

        return response()->success($getUserItemsByType, 'Items by type received successfully');
    }

    public function addItem($userId, $itemId)
    {
        $user = User::find($userId);

        if (empty($user)) {
            return $this->sendError('User not found', 500);
        }
        $input['userId'] = $userId;
        $input['itemId'] = $itemId;
        Inventory::create($input);

        $getUserItems = DB::table('inventories')
            ->join('items', 'items.id', '=', 'inventories.itemId')
            ->where('userId', '=', $userId)
            ->where('inventories.deleted_at', null)
            ->get();

        return response()->success($getUserItems, 'Items added');
    }

    public function removeItem($userId, $itemId)
    {
        $user = User::find($userId);

        if (empty($user)) {
            return $this->sendError('User not found', 500);
        }

        $item = Inventory::where('userId', '=', $userId)
            ->where('itemId', '=', $itemId);

        $item->delete();

        if (empty($item)) {
            return $this->sendError('Item not found', 500);
        }

        $getUserItems = DB::table('inventories')
            ->where('userId', '=', $userId)
            ->where('deleted_at', null)
            ->get();

        return response()->success($getUserItems, 'Items remove');
    }

}
