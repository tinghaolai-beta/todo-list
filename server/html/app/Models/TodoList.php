<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodoList extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'content',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function creator()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function updater()
    {
        return $this->belongsTo('App\Models\User', 'updated_by', 'id');
    }
}
