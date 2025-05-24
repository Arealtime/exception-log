<?php

namespace Arealtime\ExceptionLog\App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ExceptionLog extends Model
{
    protected $fillable = [];

    public function scopeSearch(Builder $builder, $message, $url): Builder
    {
        $builder->when($message, fn(Builder $builder, $value) => $builder->where('message','like', "%$value%"));
        $builder->when($url, fn(Builder $builder, $value) => $builder->where('url', $value));
        return $builder;
    }
}
