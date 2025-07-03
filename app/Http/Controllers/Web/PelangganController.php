<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\Gate;
use App\Services\UserService;

class PelangganController extends Controller
{

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        Gate::authorize('admin', $request->user());
        $query = Pelanggan::query();
        if ($search = $request->input('search')) {
            $lowercaseSearch = strtolower($search);
            $query->whereHas('user', function ($q) use ($lowercaseSearch) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . $lowercaseSearch . '%'])
                    ->orWhereRaw('LOWER(email) LIKE ?', ['%' . $lowercaseSearch . '%'])
                    ->orWhereRaw('LOWER(username) LIKE ?', ['%' . $lowercaseSearch . '%']);
            });
        }

        $pelanggan = $query->with('user')->paginate(4);
        return view('admin.dashboard.pelanggan.pelanggan-index', compact('pelanggan', 'search'));
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::with('user')->findOrFail($id);
        return view('admin.dashboard.pelanggan.pelanggan-edit', compact('pelanggan'));
    }

    public function store(Request $request)
    {
        Gate::authorize('admin', $request->user());
        $user = $this->userService->createPelanggan($request);
        if (!$user) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }
        return redirect()->back()->with('success', 'Data saved successfully!');
    }

    public function update(Request $request, $id)
    {
        $pelanggan = $this->userService->updatePelanggan($request, $id);

        if (!$pelanggan) {
            return redirect()->back()->with('error', 'Something went wrong!');
        }

        return redirect()->route('admin.dashboard.pelanggan.index')->with('success', 'Pelanggan updated.');
    }
}
