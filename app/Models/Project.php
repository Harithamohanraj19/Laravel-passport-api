<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','link','user_id','is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function user(){
        return $this->belongTo(User::class);
    }
}
