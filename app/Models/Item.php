<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;

    class Item extends Model
    {

        /**
         * The attributes that are mass assignable.
         *
         * @var string[]
         */
        protected $fillable = [
            'user_id',
            'name',
            'completed_at'
        ];

        protected static function booted()
        {
            static::creating(function ($item) {
                $item->user_id = auth()->id();
            });
        }

        public function user(): BelongsTo
        {
            return $this->belongsTo(User::class);
        }
    }
