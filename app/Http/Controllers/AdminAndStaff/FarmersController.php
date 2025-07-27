<?php

namespace App\Http\Controllers\AdminAndStaff;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FarmersController extends Controller
{
    // index
    public function index(Request $request)
    {
        try {
            // search input
            $search = $request->input('search');

            // farmers
            $farmers = Farmer::paginate(15)->appends(['search' => $search]);

            // return view
            return view('pages.general.farmers.index', [
                'farmers' => $farmers
            ]);
        } catch (\Throwable $th) {
            /**
             * log error
             * abort with 500 response
             */
            dd($th->getMessage());
            Log::error($th->getMessage());
            abort(500);
        }
    }

    // create
    public function create()
    {
        try {
            return view('pages.general.farmers.create');
        } catch (\Throwable $th) {
            /**
             * log error
             * abort with 500 response
             */
            Log::error($th->getMessage());
            abort(500);
        }
    }

    // store
    public function store(Request $request)
    {
        try {
            // validate
            $validator = Validator::make($request->all(), [
                'fname' => ['required'],
                'mname' => ['nullable'],
                'lname' => ['required'],
                'bdate' => ['required'],
                'bplace' => ['required'],
                'sex' => ['required'],
                'address' => ['required'],
                'civil_status' => ['required'],
                'id_type' => ['required'],
                'id_file' => ['required', 'mimes:jpg,jpeg,png', 'max: 10240'],
            ]);

            // if validator fails then response 422
            if ($validator->fails()) {
                Log::error(json_encode($validator->errors(), JSON_PRETTY_PRINT));
                return response(null, 422);
            };

            // path
            $path = '/farmers/id';

            // filename
            $filename = Storage::disk('local')->putFile($path, $request->file('id_file'));

            // throw Exception if fails to upload farmer id pic
            throw_if(!$filename, Exception::class, 'Failed to upload farmer ID Picture');

            // create data
            $data = [
                'fname' => $request->fname,
                'mname' => $request->mname,
                'lname' => $request->lname,
                'bdate' => $request->bdate,
                'bplace' => $request->bplace,
                'address' => $request->fname,
                'sex' => $request->sex,
                'civil_status' => $request->civil_status,
                'id_type' => $request->id_type,
                'id_dir' => $filename,
            ];

            // insert new farmer
            $status = Farmer::create($data);

            // throw new Exception if fails to insert new row
            throw_if(!$status, Exception::class, 'Fails to insert data into farmers tbl');

            // return response 200
            return response(null, 200);
        } catch (\Throwable $th) {
            /**
             * log error
             * abort with 500 response
             */
            dd($th->getMessage());
            Log::error($th->getMessage());
            return response(500);
        }
    }
}
