<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordRequest;
use App\Models\SharedPassword;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PasswordShareController extends Controller
{

    /**
     * show page for creating link for password
     * 
     * @return \Inertia\Response
     */
    public function index() {
        return Inertia::render('SharePassword');
    }

    /**
     * store password in database and returns link for collecting
     * 
     * @param StorePasswordRequest $request - contains password, expiration?, openings?, passphase?
     * 
     * @return json response with link
     */
    public function store(StorePasswordRequest $request) {
        $validated = $request->validated();

        // TODO - generate link
        $link = "link";

        $validated['link'] = $link;

        $new_password = SharedPassword::create($validated);

        // create MAC
        $new_password->mac = hash('sha256', $validated['password'].$new_password->uuid);
        $new_password->save();

        return response()->json([
            "data" => $new_password
        ], 201);
    }

    /**
     * show page for collecting a password with informations about it
     * 
     * @param string $hash - identification of password
     * 
     * @return \Inertia\Response
     */
    public function collecting(string $hash) {
        return Inertia::render('CollectPassword', [
            "expiration" => "30.6.2024",
            "id" => "123456"
        ]);
    }

    /**
     * get password from database and prepare it for sharing
     * 
     * @param string $hash - identification of password
     * 
     * @return json response with password
     */
    public function collect(string $uuid) {
        return response()->json([
            "password" => SharedPassword::find($uuid)
        ]);
    }
}