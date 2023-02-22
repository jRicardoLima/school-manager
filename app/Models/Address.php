<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Address extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'addresses';
    protected $primaryKey = 'id';

    protected $fillable = [
        'uuid',
        'zipcode',
        'country',
        'state',
        'city',
        'street',
        'neighborhood',
        'number',
        'telphone',
        'celphone',
        'addressable_id',
        'addressable_type',
    ];

    protected static function booted(): void
    {
        static::creating(function(Address $address){
            $address->uuid = Str::uuid();
        });
    }
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }

    //Relation
    public function addressable(): MorphTo
    {
        return $this->morphTo(__FUNCTION__,'addressable_type','addressable_id');
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class,'school_id','id');
    }

}
