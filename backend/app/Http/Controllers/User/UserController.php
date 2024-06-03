<?php

namespace App\Http\Controllers\User;

use App\DTO\LoginDTO;
use App\DTO\UserDTO;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // Validación de la solicitud
        $validateUser = Validator::make($request->all(), [
            'nombre' => 'required',
            'correo' => 'required|email|unique:users,email',
            'contrasena' => 'required'
        ]);

        if ($validateUser->fails()) {
            Log::error('Error de validación durante la creación del usuario', [
                'errors' => $validateUser->errors()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Error de validación durante la creación del usuario',
                'errors' => $validateUser->errors()
            ], 422);
        }

        // Creación del DTO
        $dto = new UserDTO(
            $request->nombre,
            $request->correo,
            $request->contrasena
        );

        // Registro del usuario a través del modelo
        $result = User::register($dto);

        if (!$result['status']) {
            Log::error('Error durante la creación del usuario', [
                'message' => $result['message']
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Error durante la creación del usuario',
                'errors' => $result['message']
            ], 500);
        }

        return response()->json([
            'status' => true,
            'message' => 'Usuario creado exitosamente',
            'user' => $result['user'],
            'token' => $result['token']
        ], 201);
    }

    public function login(Request $request)
    {
        $validateUser = Validator::make($request->all(),[
            
            'correo' => 'required|email',
            'contrasena' => 'required'
        ]);
        
        if($validateUser->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateUser->errors()
            ],401);
        }

        $dto = new LoginDTO(
            $request->correo,
            $request->contrasena
        );


        $result = User::login($dto);
        

        if (!$result['status']) {
            Log::error('Error durante el ingreso del usuario', [
                'message' => $result['message']
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Error durante el ingreso del usuario',
                'errors' => $result['message']
            ], 401);
        }

        return response()->json([
            'status' => true,
            'message' => 'Usuario logeado exitosamente',
            'user' => $result['user'],
            'token' => $result['token']
        ], 201);
    }

    public function profile(){
        $userData = auth()->user();
        return response()->json([
            'status' => true,
            'message' => 'Profile information',
            'data' => $userData,
            'id' => $userData->id
        ]);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'User logged succesfully',
            'data' => []
        ]);
    }
}
