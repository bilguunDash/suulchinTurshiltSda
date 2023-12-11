<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
// use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'register',
        'phone',
        'dans',
        'type',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Boot method to run code on model events.
     */
    protected static function boot()
    {
        parent::boot();

        // This event is triggered when the model is saving
        static::saving(function ($user) {
            // If the email is verified, set initial dans to 50000
            if ($user->email_verified_at) {
                $user->dans = 50000;
            }
        });
    }

    /**
     * Custom casting for the 'type' attribute.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) => ["user", "admin", "manager"][$value],
        );
    }

    /**
     * Simulate the rentBook operation (Note: This logic should be in a controller or service, not in the model).
     *
     * @param int $amount
     * @throws \Exception
     */
    public function rentBook($amount = 3500)
    {
        try {
            // Check if the user has enough balance
            if ($this->dans < $amount) {
                throw new \Exception('Insufficient balance');
            }

            // Deduct the specified amount from the user's balance
            $this->dans -= $amount;

            // Save the user model to persist changes
            $this->save();
        } catch (\Exception $e) {
            // If an exception occurs, you might want to handle it or propagate it
            throw $e;
        }
    }
}
