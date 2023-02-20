<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Occupation extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'occupations';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'name',
        'cbo',
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

    public function employee()
    {
        return $this->hasOne(Employee::class,'occupation_id','id');
    }
}
