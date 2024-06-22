<?php

namespace App\Models;

use DateTime;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Crypt;

class SharedPassword extends Model
{
    use HasUuids;

    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';

     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'password',
        'mac',
        'expiration',
        'openings',
        'passphase',
        'link'
    ];

    /**
     * encrypt password before saving to database
     * 
     * @param string $value - password
     * 
     * @return void
     */
    public function setPasswordAttribute(string $value) {
        $encrypted_password = Crypt::encryptString($value);

        $this->attributes['password'] = $encrypted_password;
    }

    /**
     * decrypt password when retrieving from database
     * 
     * @param mixed $value - encrypted password
     * 
     * @return string password
     */
    public function getPasswordAttribute($value) {
        try {
            $decrypted_password = Crypt::decryptString($value);
        } catch (DecryptException $e) {
            throw new HttpResponseException(response()->json([
                'message' => 'Decryption error.'
            ], 500));
        }

        $mac = hash('sha256', $decrypted_password.$this->uuid);

        if($mac === $this->mac)
            return $decrypted_password;
        else
            throw new HttpResponseException(response()->json([
                'message' => 'Password was modified.',
            ], 500));
    }


    /**
     * set expiration datetime based on input
     * 
     * @param mixed $value - identificator od expiration
     * 
     * @return void
     */
    public function setExpirationAttribute($value) {
        $this->attributes['expiration'] = $this->getDateTimeExpiration($value)->format('Y-m-d H:i:s');
    }

    /**
     * map datetime to identifier
     * 
     * @param mixed $value - identifier of expiration
     * 
     * @return datetime expiration
     */
    private function getDateTimeExpiration($value) {
        $now = new DateTime();

        switch ($value) {
            case '0':
                return $now->modify('+30 minutes');
                break;
            case '1':
                return $now->modify('+1 hour');
                break;
            case '2':
                return $now->modify('+3 hours');
                break;
            case '3':
                return $now->modify('+8 hours');
                break;
            case '4':
                return $now->modify('+1 day');
                break;
            case '5':
                return $now->modify('+2 days');
                break;
            case '6':
                return $now->modify('+3 days');
                break;
            case '7':
                return $now->modify('+4 days');
                break;
            case '8':
                return $now->modify('+5 days');
                break;
            case '9':
                return $now->modify('+6 days');
                break;
            case '10':
                return $now->modify('+7 days');
                break;
            case '11':
                return $now->modify('+8 days');
                break;
            case '12':
                return $now->modify('+9 days');
                break;
            case '13':
                return $now->modify('+10 days');
                break;
            default:
                return $now->modify('+1 day');
                break;
        }
    }
}
