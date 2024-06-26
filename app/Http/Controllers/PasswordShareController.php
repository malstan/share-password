<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePasswordRequest;
use App\Models\SharedPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class PasswordShareController
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

        $new_password = SharedPassword::create($validated);

        // create MAC
        $new_password->mac = hash('sha256', $validated['password'].$new_password->uuid);
        // create link
        $new_password->link = strtoupper(substr(md5($new_password->uuid), 0, 10));

        $new_password->save();

        return response()->json([
            "link" => url('/') . "/heslo/" .$new_password->link
        ], 200);
    }

    /**
     * show page for collecting a password with informations about it
     * 
     * @param string $hash - identification of password
     * 
     * @return \Inertia\Response
     */
    public function collecting(string $hash) {
        $password = SharedPassword::where('link', $hash)->first();

        if(!$password)
            return Inertia::render('NoPassword');

        $data = [
            "expiration" => $password->expiration,
            "openings" => $password->openings,
            "isPassphase" => isset($password->passphase)
        ];

        if($password->canCollect())
            return Inertia::render('CollectPassword', $data);
        
        return Inertia::render('ExpiredPassword', $data);
    }

    /**
     * get password from database and prepare it for sharing
     * 
     * @param string $hash - identification of password
     * 
     * @return json response with password
     */
    public function collect(Request $request) {

        $validator = Validator::make($request->all(), [
            'hash' => 'required|string|max:10',
            'passphase' => 'nullable|string',
        ]);
        
        if($validator->fails())
            return Inertia::render('SharePassword');

        $validated = $validator->validated();
        
        // get password
        $password = SharedPassword::where('link', $validated['hash'])->first();

        // check passphase
        if(!Hash::check($validated['passphase'], $password->passphase)) 
            return response()->json([
                "error" => "passphase"
            ], 400);

        // check record
        if(!$password)
            return Inertia::render('NoPassword');

        // check collecting
        if(!$password->canCollect())
            return Inertia::render('CollectPassword', [
                "expiration" => $password->expiration,
                "openings" => $password->openings
            ]);

        $password_to_return = $password->password;
        $password->openings -= 1;
        
        if($password->openings <= 0) {
            $password->password = null;
            $password->passphase = null;
        }

        $password->save();

        return response()->json([
            "password" => $password_to_return
        ]);
    }
}