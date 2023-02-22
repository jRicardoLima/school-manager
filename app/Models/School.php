<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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

    protected static function booted(): void
    {
        static::creating(function (School $school){
            $school->uuid = Str::uuid();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    //Relations
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function rooms(): HasMany
    {
        return $this->hasMany(Room::class,'school_id','id');
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subjects::class,'school_id','id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class,'school_id','id');
    }

    public function occupations(): HasMany
    {
        return $this->hasMany(Occupation::class,'school_id','id');
    }

    public function students(): HasMany
    {
        return $this->hasMany(Address::class,'school_id','id');
    }

    public function address(): MorphOne
    {
        return $this->morphOne(Address::class,'addressable');
    }
}
