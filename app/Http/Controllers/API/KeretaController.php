<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\KeretaService;

class KeretaController extends Controller
{
    protected $keretaService;
    public function __construct(KeretaService $keretaService)
    {
        $this->keretaService = $keretaService;
    }

    public function getKereta($id = null)
    {
        if ($id) {
            $kereta = $this->keretaService->getKereta($id);
            return response()->json($kereta, 200);
        }
        $kereta = $this->keretaService->getKereta();
        return response()->json($kereta, 200);
    }

    public function createKereta(Request $request)
    {
        $result = $this->keretaService->createKereta($request);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Kereta created.',
                'data' => $result
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kereta creation failed.'
            ], 500);
        }
    }

    public function updateKereta(Request $request, $id)
    {
        $result = $this->keretaService->updateKereta($request, $id);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Kereta updated.',
                'data' => $result
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kereta update failed.'
            ], 500);
        }
    }

    public function deleteKereta($id)
    {
        $result = $this->keretaService->deleteKereta($id);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Kereta deleted.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kereta deletion failed.'
            ], 500);
        }
    }
}
