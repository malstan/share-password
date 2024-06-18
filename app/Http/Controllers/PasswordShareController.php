<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class PasswordShareController extends Controller
{
    public function index() {
        return Inertia::render('SharePassword');
    }

    public function store(Request $request) {
        return response()->json([
            "link" => "dajheslo.sk/heslo/123456"
        ]);
    }

    public function collecting(string $id) {
       return Inertia::render('CollectPassword', [
        "expiration" => "30.6.2024",
        "id" => "123456"
       ]);
    }

    public function collect(string $id) {
        return response()->json([
            "password" => "pass123"
        ]);
    }
}
