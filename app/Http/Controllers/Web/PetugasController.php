<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Petugas;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('admin', $request->user());
        $query = Petugas::query();
        if ($search = $request->input('search')) {
            $lowercaseSearch = strtolower($search);
            $query->whereHas('user', function ($q) use ($lowercaseSearch) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . $lowercaseSearch . '%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%' . $lowercaseSearch . '%'])
                    ->orWhereRaw('LOWER(username) LIKE ?', ['%' . $lowercaseSearch . '%']);
            });
        }

        $petugas = $query->with('user')->paginate(4);
        return view('admin.dashboard.petugas.petugas-index', compact('petugas', 'search'));
    }
}
