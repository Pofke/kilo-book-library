<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/setup', function() {


    $admin = [
        'email' => 'info@libraryapi.com',
        'password' => 'password'
    ];

    $librarian = [
        'email' => 'library@libraryapi.com',
        'password' => 'password'
    ];



    $users = [
        'john' => [
            'email' => 'john@libraryapi.com',
            'password' => 'password'
        ],
        'peter' => [
            'email' => 'peter@libraryapi.com',
            'password' => 'password'
        ],
        'paul' => [
            'email' => 'paul@libraryapi.com',
            'password' => 'password'
        ],
        'jim' => [
            'email' => 'jim@libraryapi.com',
            'password' => 'password'
        ],
        'amanda' => [
            'email' => 'amanda@libraryapi.com',
            'password' => 'password'
        ],

    ];

    $tokens = [];


    if(Auth::attempt($admin))
    {
        $user = Auth::user();
        $tokens[] = ['admin' => $user->createToken('admin-token',
            [
                'get',
                'create',
                'update',
                'delete'
            ])->plainTextToken];
    }

    if(Auth::attempt($librarian))
    {
        $user = Auth::user();
        $tokens[] = ['librarian' => $user->createToken('librarian-token',
            [
                'get',
                'create',
                'update',
                'delete'
            ])->plainTextToken];
    }

    foreach ($users as $key => $value)
    {
        if(Auth::attempt($value))
        {
            $user = Auth::user();
            $tokens[] = [$key => $user->createToken($key . '-token',
                [
                    'getSelf',
                    'createSelf',
                    'updateSelf'
                ])->plainTextToken];
        }
    }


    return $tokens;





});
