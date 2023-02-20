<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class School extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'schools';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'name',
        'ie',
        'register_mec',
        'company_id'
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    //Relations
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function rooms()
    {
        return $this->hasMany(Room::class,'school_id','id');
    }

    public function subjects()
    {
        return $this->hasMany(Subjects::class,'school_id','id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class,'school_id','id');
    }

    public function occupations()
    {
        return $this->hasMany(Occupation::class,'school_id','id');
    }
}
