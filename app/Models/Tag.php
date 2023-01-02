<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
    ];

    public function tag_store($data)
    {
        return DB::table('tags')
            ->insert([
                'user_id' => $data['user_id'],
                'title' => $data['title'],
                'created_at' => date('Y-m-d H:i:s')
            ]);
    }
}
