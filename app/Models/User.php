<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Foundation\Auth\User as Authenticatable;
    use Illuminate\Notifications\Notifiable;
    use Illuminate\Support\Facades\Hash;
    use Laravel\Sanctum\HasApiTokens;

    class User extends Authenticatable
    {
        use HasApiTokens, HasFactory, Notifiable;

        /**
         * The attributes that are mass assignable.
         *
         * @var string[]
         */
        protected $fillable = [
            'name',
            'email',
            'password',
        ];

        /**
         * The attributes that should be hidden for serialization.
         *
         * @var array
         */
        protected $hidden = [
            'password',
            'remember_token',
        ];

        /**
         * The attributes that should be cast.
         *
         * @var array
         */
        protected $casts = [
            'email_verified_at' => 'datetime',
        ];

        public function roles(): BelongsToMany
        {
            return $this->belongsToMany(Role::class);
        }

        public function items(): HasMany
        {
            return $this->hasMany(Item::class);
        }


        /**
         * Hash password before saving to database
         *
         * @param $value
         */
        public function setPasswordAttribute($value): void
        {
            $this->attributes['password'] = Hash::make($value);
        }


        /**
         * Create a new user
         * Set the user's role to user
         *
         * @param $userData
         *
         * @return User
         */
        public function createUser($userData): User
        {
            $role = Role::where('slug', 'user')->first();
            $user = $this->create($userData);
            $user->roles()->attach($role);
            return $user;
        }

        public function hasRole(string $slug):bool
        {
            foreach ($this->roles as $role) {
                if ($role->slug === $slug) {
                    return true;
                }
            }
            return false;
        }

        public function isAdmin()
        {
            return auth()->user()->hasRole('admin');
        }

        public function getUserItems($userId, bool $deleted)
        {
            return $this->with(['items' => function($query) use($deleted){
                $query->when($deleted, function ($q){
                    $q->onlyTrashed();
                });
            }])->findOrFail($userId);
        }
    }
