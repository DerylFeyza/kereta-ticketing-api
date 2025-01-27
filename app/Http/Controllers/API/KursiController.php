<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\KursiService;
use Illuminate\Http\Request;

class KursiController extends Controller
{
    protected $kursiService;
    public function __construct(KursiService $kursiService)
    {
        $this->kursiService = $kursiService;
    }

    public function getKursi($id = null)
    {
        if ($id) {
            $kursi = $this->kursiService->getKursi($id);
            return response()->json($kursi, 200);
        }
        $kursi = $this->kursiService->getKursi();
        return response()->json($kursi, 200);
    }

    public function createKursi(Request $request)
    {
        $result = $this->kursiService->createKursi($request);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Kursi created.',
                'data' => $result
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kursi creation failed.'
            ], 500);
        }
    }

    public function updateKursi(Request $request, $id)
    {
        $result = $this->kursiService->updateKursi($request, $id);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Kursi updated.',
                'data' => $result
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kursi update failed.'
            ], 500);
        }
    }

    public function deleteKursi($id)
    {
        $result = $this->kursiService->deleteKursi($id);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Kursi deleted.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Kursi deletion failed.'
            ], 500);
        }
    }
}
