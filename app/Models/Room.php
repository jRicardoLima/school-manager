<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'rooms';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'name',
        'observation',
        'school_id'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    //Relation
    public function school()
    {
        return $this->belongsTo(School::class,'school_id','id');
    }


}
