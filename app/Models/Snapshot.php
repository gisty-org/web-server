<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snapshot extends Model
{
    use HasFactory;

    protected $table = 'snapshots';
    protected $fillable = ['url','summary_id'];

    public function summary(){
        return $this->belongsTo('App\Models\Summary');
    }
}
