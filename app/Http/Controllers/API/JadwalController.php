<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\JadwalService;
use Illuminate\Support\Facades\Gate;

class JadwalController extends Controller
{
    protected $jadwalService;
    public function __construct(JadwalService $jadwalService)
    {
        $this->jadwalService = $jadwalService;
    }

    public function getJadwals(Request $request)
    {
        $kereta = $this->jadwalService->getJadwals($request->search ?? null, $request->date ?? null);
        return response()->json($kereta, 200);
    }

    public function findJadwal($id)
    {
        $kereta = $this->jadwalService->findJadwalById($id);
        return response()->json($kereta, 200);
    }

    public function createJadwal(Request $request)
    {
        Gate::authorize('admin', $request->user());
        $result = $this->jadwalService->createJadwal($request);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Jadwal created.',
                'data' => $result
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal creation failed.'
            ], 500);
        }
    }

    public function updateJadwal(Request $request, $id)
    {
        Gate::authorize('admin', $request->user());
        $result = $this->jadwalService->updateJadwal($request, $id);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Jadwal updated.',
                'data' => $result
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal update failed.'
            ], 500);
        }
    }

    public function deleteJadwal(Request $request, $id)
    {
        Gate::authorize('admin', $request->user());
        $result = $this->jadwalService->deleteJadwal($id);
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Jadwal deleted.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Jadwal deletion failed.'
            ], 500);
        }
    }
}
