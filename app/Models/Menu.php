<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Menu extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'menus';
    protected $primaryKey = 'id';

    protected $fillable = [
      'uuid',
      'name',
      'module'
    ];

    protected static function booted(): void
    {
        static::creating(function (Menu $menu){
            $menu->uuid = Str::uuid();
        });
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('d-m-Y');
    }
}
