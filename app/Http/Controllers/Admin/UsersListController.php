<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UsersListController extends Controller
{
    public function index(Request $request)
    {
        try {
            // search user
            $search = $request->input('search');

            // staffs account
            $users = User::select('*')
                ->where('role', '2')
                ->when($search, function($item, $search){
                    return $item->where('name', 'LIKE', "%$search%");
                })
                ->orderBy('created_at', 'desc')
                ->paginate(15)
                ->appends(['search' => $search]);

            // return view
            return view('pages.admin.users', [
                'users' => $users
            ]);
        } catch (\Throwable $th) {
            /**
             * log error
             * abort 500
             */
            Log::error($th->getMessage());
            abort(500);
        }
    }
}
