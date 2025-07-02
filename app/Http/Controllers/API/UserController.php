<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function destroy($id)
    {
        $user = User::find($id);
        $result = $user->delete();
        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'User deleted.'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User deletion failed.'
            ], 500);
        }
    }
}
