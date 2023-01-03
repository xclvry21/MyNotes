<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'tags', 'body'
    ];

    public function note_store($data)
    {
        return DB::table('notes')
            ->insert([
                'user_id' => $data['user_id'],
                'title' => $data['title'],
                'tags' => $data['tags'],
                'body' => $data['body'],
                'created_at' => date('Y-m-d H:i:s')
            ]);
    }
}
