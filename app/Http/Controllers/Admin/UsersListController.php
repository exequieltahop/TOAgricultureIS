<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\StaffInfo;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UsersListController extends Controller
{
    // index
    public function index(Request $request)
    {
        try {
            // search user
            $search = $request->input('search');

            // staffs account
            $users = User::select('*')
                ->where('role', '2')
                ->when($search, function ($item, $search) {
                    return $item->where('name', 'LIKE', "%$search%");
                })
                ->orderBy('created_at')
                ->paginate(15)
                ->appends(['search' => $search]);

            // return view
            return view('pages.admin.users.index', [
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

    // view create blade
    public function create()
    {
        try {
            return view('pages.admin.users.create');
        } catch (\Throwable $th) {
            /**
             * log error
             * abort 500
             */
            dd($th->getMessage());
            Log::error($th->getMessage());
            abort(500);
        }
    }

    // delete user
    public function destroy($id)
    {
        try {
            // decrypt id
            $decrypted_id = Crypt::decrypt($id);

            // delete user
            $delete_status = User::deleteRow($decrypted_id);

            // throw exception if delete user fails
            throw_if(!$delete_status, Exception::class, 'Failed To Delete User');

            // return response 200 if there was no error and exceptions
            return response(null, 200);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }

    // view edit blade
    public function edit($id)
    {
        try {
            //decrypt id
            $decrypted_id = Crypt::decrypt($id);

            // get user
            $user = User::getRows([
                'users.id',
                'users.email',
                'si.f_name',
                'si.m_name',
                'si.l_name',
                'si.b_date',
                'si.b_place',
                'si.sex',
                'si.civil_status',
            ], [
                'users.id' => $decrypted_id
            ])
                ->join('staff_infos as si', 'users.id', '=', 'si.user_id')
                ->get();

            // return view with user
            return view('pages.admin.users.edit', ['user' => $user[0]]);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            dd($th->getMessage());
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }

    // store
    public function store(Request $request)
    {
        try {
            // validate
            $request->validate([
                'fname' => 'required',
                'mname' => 'nullable',
                'lname' => 'required',
                'bdate' => ['required', 'date'],
                'bplace' => 'required',
                'sex' => 'required',
                'civil_status' => 'required',
                'email' => ['required', 'unique:users'],
                'password' => ['required', 'min:8'],
            ]);

            // set fullname
            $fullname = $request->fname . ' ' . $request->mname . ' ' . $request->lname;

            if ($request->mname == '') {
                $fullname = $request->fname . ' ' . $request->lname;
            }

            // start transaction
            DB::beginTransaction();

            // create user
            $newStaffAccount = User::create([
                'name' => $fullname,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => '2'
            ]);

            // throw new Exception if failed to create user account
            throw_if(!$newStaffAccount, Exception::class, 'Failed to create staff account');

            // create staff info
            $newStaffInfo = StaffInfo::create([
                'user_id' => $newStaffAccount->id,
                'f_name' => $request->fname,
                'm_name' => $request->mname,
                'l_name' => $request->lname,
                'b_date' => $request->bdate,
                'b_place' => $request->bplace,
                'sex' => $request->sex,
                'civil_status' => $request->civil_status
            ]);

            // throw new Exception if failed to create staff info
            throw_if(!$newStaffInfo, Exception::class, 'Failed to create Staff Info');

            // commit changes
            DB::commit();

            // response 200
            return response(null, 200);
        } catch (\Throwable $th) {
            /**
             * rollback changes
             * log error
             * response 500
             */
            DB::rollBack();
            dd($th->getMessage());
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }

    // update
    public function update(Request $request, $id)
    {
        try {
            // decrypt id
            $decrypted_id = Crypt::decrypt($id);

            // start transaction
            DB::beginTransaction();

            // set fullname
            $fullname = $request->fname . ' ' . $request->mname . ' ' . $request->lname;

            if ($request->mname == '') {
                $fullname = $request->fname . ' ' . $request->lname;
            }



            if ($request->new_password == '') {
                // update data
                $user_update_data = [
                    'name' => $fullname,
                    'email' => $request->email
                ];
            } else {
                // update data
                $user_update_data = [
                    'name' => $fullname,
                    'email' => $request->email,
                    'password' => $request->new_password,
                ];
            }


            $update_status = User::updateRow($user_update_data, $decrypted_id);

            // throw new Exception if fails to update user
            throw_if(!$update_status, Exception::class, 'Failed to update a users row');

            // staff_infos update data
            $user_info_update_data = [
                'user_id' => $decrypted_id,
                'f_name' => $request->fname,
                'm_name' => $request->mname,
                'l_name' => $request->lname,
                'b_date' => $request->bdate,
                'b_place' => $request->bplace,
                'sex' => $request->sex,
                'civil_status' => $request->civil_status
            ];

            $staff = StaffInfo::where('user_id', $decrypted_id)->first();

            // update row
            $staff_info_update_status = StaffInfo::updateRow($user_info_update_data, $staff->id);

            // throw new Exception if update failed
            throw_if(!$staff_info_update_status, Exception::class, 'Failed to update data');

            // Commit
            DB::commit();

            // resposnse 200
            return response(null, 200);
        } catch (\Throwable $th) {
            /**
             * log error
             * response 500
             */
            DB::rollBack();
            dd($th->getMessage());
            Log::error($th->getMessage());
            return response(null, 500);
        }
    }
}
