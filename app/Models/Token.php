<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kavenegar ;
Use RealRashid\SweetAlert\Facades\Alert;

class Token extends Model
{
    const EXPIRATION_TIME = 15; // minutes

    protected $fillable = [
        'code',
        'user_id',
        'phone',
        'used',
        'type'
    ];

    public function __construct(array $attributes = [])
    {
        if (!isset($attributes['code'])) {
            $attributes['code'] = $this->generateCode();
        }
        parent::__construct($attributes);
    }

    /**
     * Generate a six digits code
     *
     * @param int $codeLength
     * @return string
     */
    public function generateCode($codeLength = 4)
    {
        $max = pow(10, $codeLength);
        $min = $max / 10 - 1;
        $code = mt_rand($min, $max);
        return $code;
    }

    /**
     * User tokens relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * True if the token is not used nor expired
     *
     * @return bool
     */
    public function isValidUsed()
    {
        return !$this->isUsed() ;
    }

    public function isValidExpired()
    {
        return !$this->isExpired();
    }

    /**
     * Is the current token used
     *
     * @return bool
     */
    public function isUsed()
    {
        return $this->used;
    }

    /**
     * Is the current token expired
     *
     * @return bool
     */
    public function isExpired()
    {
        return $this->created_at->diffInMinutes(Carbon::now()) > static::EXPIRATION_TIME;
    }


    public function send()
    {

        $sessionType = 'login' ;


        if (!$this->code) {
            $this->code = $this->generateCode();
        }

        if (!$this->user)
        {
            \alert()->success( 'کُد ثبت نام برای شما ارسال شد') ;
            $sessionType = 'register' ;
        }


        try{
            $receptor = $this->phone;
            $token = $this->code;
            $token2 = null;
            $token3 = null;
            $template= $sessionType;
            $type = 'sms';
            $result = Kavenegar::VerifyLookup($receptor, $token, $token2, $token3, $template, $type = null);
        }
        catch(\Kavenegar\Exceptions\ApiException $e){
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            \alert()->error( $e->errorMessage() ."مشکلی در ارسال کُد به وجود آمده است. دوباره تلاش کنید.") ;
            return  redirect('login');
        }
        catch(\Kavenegar\Exceptions\HttpException $e){
            \alert()->error( $e->errorMessage() ."مشکلی در ارسال کُد به وجود آمده است. دوباره تلاش کنید.") ;
            return redirect('login');

        }

        return true;
    }


    public function sendWelcome($phone)
    {
        try{
            $receptor = $phone;
            $token = 'profile';
            $token2 = null;
            $token3 = null;
            $template= 'completeRegister';
            $type = 'sms';
            //Send null for tokens not defined in the template
            //Pass token10 and token20 as parameter 6th and 7th
            $result = Kavenegar::VerifyLookup($receptor, $token, $token2, $token3, $template, $type = null);
        }
        catch(\Kavenegar\Exceptions\ApiException $e){
            // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
            \alert()->error( $e->errorMessage() ."مشکلی در ارسال کُد به وجود آمده است. دوباره تلاش کنید.") ;
            return redirect('login');
        }
        catch(\Kavenegar\Exceptions\HttpException $e){
            \alert()->error( $e->errorMessage() ."مشکلی در ارسال کُد به وجود آمده است. دوباره تلاش کنید.") ;
            return redirect('login');

        }
    }


}
