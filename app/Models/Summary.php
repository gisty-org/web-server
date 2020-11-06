<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    use HasFactory;
    protected $table = 'summaries';
    protected $fillable = ['folder','title','content','user_id'];

    public function user(){
        $this->belongsTo('App\Models\User');
    }

    public function snapshots(){
        return $this->hasMany('App\Models\Snapshot');
    }
}
