<?php

namespace App\Models;

use App\DTO\LoginDTO;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\DTO\UserDTO;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Throwable;

class User extends Authenticatable
{
    use HasApiTokens ,HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function register(UserDTO $dto)
    {
        try {
            $user = self::create([
                'name' => $dto->name,
                'email' => $dto->email,
                'password' => $dto->password
            ]);

            return [
                'status' => true,
                'user' => $user,
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ];
        } catch (Throwable $th) {
            return [
                'status' => false,
                'message' => $th->getMessage(),
            ];
        }
    }

    public static function login(LoginDTO $dto)
    {

        try
        {
            if(!Auth::attempt(['email' => $dto->email, 'password' => $dto->password])){
                return [
                    'status' => false,
                    'message' => 'Correo or Contraseña incorrecto.'
                ];
            }
            $user = self::where('email', $dto->email)->first();
            return 
            [
                'status' => true,
                'user' => $user,
                'token' => $user->createToken('API TOKEN')->plainTextToken
            ];
        } catch (Throwable $th) {
            return [
                'status' => false,
                'message' => $th->getMessage(),
            ];
        }

    }
}
