<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // delete a row
    public static function deleteRow($id): bool
    {
        try {
            $item = self::findOrFail($id);

            return $item->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // get row scope
    public function scopeGetRows($query, array $select = [], array $where = [], $search = '')
    {
        try {
            return $query->select($select)
                ->where($where)
                ->when($search, function($query, $search){
                    return $query->where('name', "%$search%");
                });
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    // update row
    public static function updateRow(array $data, int $id, bool $disableTimestamp = false) : bool {
        try {
            // find item
            $item = self::findOrFail($id);

            // disable timestamp
            if($disableTimestamp){
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
