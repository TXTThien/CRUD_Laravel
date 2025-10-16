<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlayerRequest;
use App\Services\ProductService;
class CRUDController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getAllPlayers()
    {
        return response()->json($this->productService->getAll());
    }
    public function getPlayerById($id)
    {
        return response()->json($this->productService->getById($id));
    }
    public function newPlayer(PlayerRequest $request)
    {
        return response()->json($this->productService->create($request->validated()));
    }
    public function updatePlayer(PlayerRequest $request, $id)
    {
        return response()->json($this->productService->update($request->validated(),$id));
    }
    public function deletePlayer($id)
    {
        return response()->json($this->productService->delete($id));
    }
}
