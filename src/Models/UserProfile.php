<?php

namespace JoseVasquezRamos\PackTest\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    protected $guarded = [];

    public function user(): BelongsTo
    {
        return $this->belongsTo(config('pack-test.user_model'));
    }
}