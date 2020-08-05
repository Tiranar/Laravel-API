<?php

namespace App\Http\Controllers\API;

use App\Models\Coins;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;

class CoinsAPIController extends AppBaseController
{
//    /**
//     * Display a listing of the resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function index()
//    {
//        //
//    }
//
//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }
//
//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function store(Request $request)
//    {
//        //
//    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Models\Coins  $coins
//     * @return \Illuminate\Http\Response
//     */
//    public function show(Coins $coins)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  \App\Models\Coins  $coins
//     * @return \Illuminate\Http\Response
//     */
//    public function edit(Coins $coins)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  \App\Models\Coins  $coins
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, Coins $coins)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Models\Coins  $coins
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy(Coins $coins)
//    {
//        //
//    }


    public function getCoins($userId)
    {
        $user = User::find($userId);

        if (empty($user)) {
            return $this->sendError('User not found', 500);
        }

        $getCoins = DB::table('coins')
            ->select(DB::raw('sum(addCoins) - sum(removeCoins) as totalCoins'))
            ->where('userId', '=', $userId)
            ->first();

        return response()->success($getCoins, 'Coins amount check');
    }

    public function addCoins($userId, $amount)
    {
        $user = User::find($userId);

        if (empty($user)) {
            return $this->sendError('User not found', 500);
        }
        $input['userId'] = $userId;
        $input['addCoins'] = $amount;
        $input['removeCoins'] = 0;
        Coins::create($input);

        $totalCoins = DB::table('coins')
            ->select(DB::raw('sum(addCoins) - sum(removeCoins) as totalCoins'))
            ->where('userId', '=', $userId)
            ->first();

        return response()->success($totalCoins, 'Coins added');
    }

    public function removeCoins($userId, $amount)
    {
        $user = User::find($userId);
        if (empty($user)) {
            return $this->sendError('User not found', 500);
        }

        $getCoins = DB::table('coins')
            ->select(DB::raw('sum(addCoins) - sum(removeCoins) as totalCoins'))
            ->where('userId', '=', $userId)->first();

        if (!empty($getCoins) && $getCoins->totalCoins < $amount){
            return $this->sendError('Not enough coins');
        };

        $input['userId'] = $userId;
        $input['removeCoins'] = $amount;
        $input['addCoins'] = 0;
        Coins::create($input);

        $totalCoins = DB::table('coins')
            ->select(DB::raw('sum(addCoins) - sum(removeCoins) as totalCoins'))
            ->where('userId', '=', $userId)
            ->first();

        return response()->success($totalCoins, 'Coins spent');
    }

}
