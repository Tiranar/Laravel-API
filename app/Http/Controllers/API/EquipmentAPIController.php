<?php

namespace App\Http\Controllers\API;

use App\Models\Equipment;
use App\Models\Slot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AppBaseController;

class EquipmentAPIController extends AppBaseController
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUserEquipment($userId)
    {
        $user = User::find($userId);

        if (empty($user)) {
            return $this->sendError('User not found', 500);
        }

        $getUserEquipment = DB::table('equipments')
            ->join('items', 'items.id', '=', 'equipments.itemId')
            ->where('userId', '=', $userId)
            ->where('equipments.deleted_at', null)
            ->get();

        return response()->success($getUserEquipment, 'Equipments received successfully');
    }

    public function addItem($userId, $itemId, $slotId)
    {
        $user = User::find($userId);

        if (empty($user)) {
            return $this->sendError('User not found', 500);
        }

        $slotType = DB::table('slots')
            ->where('id', '=', $slotId)->first();

        if (empty($slotType)) {
            return $this->sendError('Slot not found', 500);
        }

        $foundItem = DB::table('inventories')
            ->join('items', 'items.id', '=', 'inventories.itemId')
            ->where('userId', '=', $userId)
            ->where('itemId', '=', $itemId)
            ->where('inventories.deleted_at', null)
            ->first();

        if (empty($foundItem)) {
            return $this->sendError('Item not found', 500);
        }

        if ($slotType->itemType != $foundItem->type) {
            return $this->sendError('Item not found', 500);
        }

        $checkEquipment = DB::table('equipments')
            ->where('userId', '=', $userId)
            ->where('slotId', '=', $slotId)
            ->where('deleted_at', '=', null)->first();

        if (empty($checkEquipment)) {

            $input['userId'] = $userId;
            $input['itemId'] = $itemId;
            $input['slotId'] = $slotId;
            Equipment::create($input);

            $getUserEquipment = DB::table('equipments')
                ->join('items', 'items.id', '=', 'equipments.itemId')
                ->where('userId', '=', $userId)
                ->where('equipments.deleted_at', null)
                ->get();

            return response()->success($getUserEquipment, 'Item equipped ');

        } else {

            $removeCurrentEquipment = DB::table('equipments')
                ->where('userId', '=', $userId)
                ->where('itemId', '=', $itemId)
                ->where('slotId', '=', $slotId)
                ->where('deleted_at', null);

            $removeCurrentEquipment->delete();

            $input['userId'] = $userId;
            $input['itemId'] = $itemId;
            $input['slotId'] = $slotId;
            Equipment::create($input);

            $getUserEquipment = DB::table('equipments')
                ->join('items', 'items.id', '=', 'equipments.itemId')
                ->where('userId', '=', $userId)
                ->where('equipments.deleted_at', null)
                ->get();

            return response()->success($getUserEquipment, 'Item equipped ');
        }
    }

    public function removeItem($userId, $itemId)
    {
        $user = User::find($userId);

        if (empty($user)) {
            return $this->sendError('User not found', 500);
        }

        $removeItem = Equipment::where('userId', '=', $userId)
            ->where('itemId', '=', $itemId);

        if (empty($removeItem)) {
            return $this->sendError('Equipment not found', 500);
        }

        $removeItem->delete();

        $getUserEquipment = DB::table('equipments')
            ->join('items', 'items.id', '=', 'equipments.itemId')
            ->where('userId', '=', $userId)
            ->where('equipments.deleted_at', null)
            ->get();

        return response()->success($getUserEquipment, 'Items remove');
    }
}
