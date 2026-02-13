<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Batch extends Model
{
    protected $fillable = ['item_id', 'expiry_date', 'qty'];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
