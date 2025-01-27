<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\GerbongService;

class GerbongController extends Controller
{
    protected $gerbongService;
    public function __construct(GerbongService $gerbongService)
    {
        $this->gerbongService = $gerbongService;
    }

    public function getGerbong($id = null)
    {
        if ($id) {
            $gerbong = $this->gerbongService->getGerbong($id);
            return response()->json($gerbong, 200);
        }
        $gerbong = $this->gerbongService->getGerbong();
        return response()->json($gerbong, 200);
    }

    public function createGerbong(Request $request)
    {
        $result = $this->gerbongService->createGerbong($request);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Gerbong created.',
                'data' => $result
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gerbong creation failed.'
            ], 500);
        }
    }

    public function updateGerbong(Request $request, $id)
    {
        $result = $this->gerbongService->updateGerbong($request, $id);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Gerbong updated.',
                'data' => $result
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gerbong update failed.'
            ], 500);
        }
    }

    public function deleteGerbong($id)
    {
        $result = $this->gerbongService->deleteGerbong($id);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Gerbong deleted.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gerbong deletion failed.'
            ], 500);
        }
    }
}
