<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getUsers (): array
    {
        $data = User::all();
        if ($data->isEmpty()) {
            return [
                "status" => false,
                "message" => "No Users found",
                "data" => []
            ];
        } else {

            return [
                "status" => true,
                "message" => $data->count()." users found",
                "data" => [
                    "users" => $data
                ]
            ];
        }
    }

    public function addUser(Request $request): array
    {
        $data = $request->all();
        if (!User::where('email', '=', $data['email'])->exists()) {
            $user = User::create([
                "name" => $data['name'],
                "email"=> $data['email'],
                "password" => Hash::make($data['password'])
            ]);
            if (empty($user->id)) {
                return [
                    "status" => false,
                    "message" => "An unexpected error has occurred",
                    "data" => []
                ];
            } else {
                return [
                    "status" => true,
                    "message" => "User " . $data['name'] . " added",
                    "data" => [
                        "user" => $user
                    ]
                ];
            }
        } else {
            return [
                "status" => false,
                "message" => "The user already exist",
                "data" => []
            ];
        }
    }
}
