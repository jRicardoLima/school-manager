<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

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

    protected static function booted(): void
    {
        static::creating(function (Occupation $occupation){
            $occupation->uuid = Str::uuid();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    //Relation
    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class,'school_id','id');
    }

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class,'occupation_id','id');
    }
}
