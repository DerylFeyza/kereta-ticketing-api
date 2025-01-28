<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\TiketService;

class OrderController extends Controller
{
    protected $tiketService;
    public function __construct(TiketService $tiketService)
    {
        $this->tiketService = $tiketService;
    }

    public function getUserTikets(Request $request)
    {
        $kereta = $this->tiketService->getUserTikets($request);
        return response()->json($kereta, 200);
    }

    public function findTiket($id)
    {
        $kereta = $this->tiketService->findTiketById($id);
        return response()->json($kereta, 200);
    }

    public function createTiket(Request $request)
    {
        $result = $this->tiketService->createTiket($request);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Tiket created.',
                'data' => $result
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tiket creation failed.'
            ], 500);
        }
    }

    public function deleteTiket($id)
    {
        $result = $this->tiketService->deleteTiket($id);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Tiket deleted.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Tiket deletion failed.'
            ], 500);
        }
    }
}
