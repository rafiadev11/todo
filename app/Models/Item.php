<?php

    namespace App\Models;

    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Item extends Model
    {
        use SoftDeletes, HasFactory;
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

        /**
         * Update completed_at date to mark item as complete
         *
         * @param $id
         *
         * @return Item
         */
        public function complete($id):Item
        {
            $item = $this->findOrFail($id);
            $item->update(['completed_at' => Carbon::now()->format('Y-m-d H:i:s')]);
            $item->refresh();
            return $item;
        }
    }
