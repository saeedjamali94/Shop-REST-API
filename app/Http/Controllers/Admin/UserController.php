<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request )
    {
        $results = User::query();

        if( $request->has('email') ){
            $results = $results->whereEmail($request->get('email'));
        }

        return response()->json(
            [
                "status" => "success",
                "data" => $results->paginate(10)
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // start validations
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name' => ['required', 'string', 'min:2', 'max:255'],
            'phone' => ['required', 'string', 'unique:users,phone', 'min:11', 'max:11'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'max:255'],
        ]);
        if( $validator->fails() ){
            return response()->json(
                [
                    "status" => "failed",
                    "errors" => $validator->errors(),
                ] ,
                422
            );
        }

        return response()->json(
            [
                "status" => "success",
            ]
        );

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(
            [
                "status" => "success",
                "data" => $user
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
