<?php

namespace App\Http\Controllers\API;

use App\Models\Items;
use App\Repositories\ItemsRepository;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class GroupController
 * @package App\Http\Controllers\API
 */

class ItemsAPIController extends AppBaseController
{
    /** @var  GroupRepository */
    private $itemRepository;

    public function __construct(ItemsRepository $itemRepo)
    {
        $this->itemRepository = $itemRepo;
    }

    /**
     * Display the specified Group.
     * GET|HEAD /items/{itemId}
     *
     * @param Items $item_id
     *
     * @return mixed
     */
    public function getById(Items $item_id)
    {
        if (empty($item_id)) {
            return $this->sendError('Item not found');
        }

        return response()->success($item_id->toArray(), 'Item retrieved successfully');
    }

    /**
     * Display the specified Group.
     * GET|HEAD /items/{type}
     *
     * @param string $type
     *
     * @return mixed
     */
    public function getByType(string $type)
    {
        /** @var Items $type */
        $items = Items::where('type', $type)->get();

        if (empty($items)) {
            return $this->sendError('Items not found');
        }

        return response()->success($items->toArray(), 'Items retrieved successfully');
    }
}
