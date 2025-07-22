<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class StaffInfo extends Model
{
    // fillable
    protected $fillable = [
        'user_id',
        'f_name',
        'm_name',
        'l_name',
        'b_date',
        'b_place',
        'sex',
        'civil_status'
    ];

    // update row
    public static function updateRow(array $data, int $id, bool $disableTimestamp = false): bool
    {
        try {
            // find item
            $item = self::findOrFail($id);

            // disable timestamp
            if ($disableTimestamp) {
                $item->timestamps = false;
            }

            // force update
            $item->forceFill($data);

            // return
            return $item->save();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
