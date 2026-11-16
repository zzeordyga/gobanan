<?php

namespace App\Models;

use Database\Factories\TransactionDetailFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionDetail extends Model
{
    /** @use HasFactory<TransactionDetailFactory> */
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = ['header_id', 'service_id', 'notes', 'status'];

    /**
     * @return BelongsTo<TransactionHeader, $this>
     */
    public function header(): BelongsTo
    {
        return $this->belongsTo(TransactionHeader::class, 'header_id');
    }

    /**
     * @return BelongsTo<Service, $this>
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function markDone(): void
    {
        $this->status = 'Done';
        $this->save();
    }
}
