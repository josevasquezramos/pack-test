<?php

namespace JoseVasquezRamos\PackTest\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $guarded = [];

    public function departments(): HasMany
    {
        return $this->hasMany(Department::class);
    }
}