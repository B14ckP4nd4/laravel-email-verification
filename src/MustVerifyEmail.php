<?php

namespace BlackPanda\EmailVerification;

use BlackPanda\EmailVerification\Models\EmailVerification;
use App\Models\User;
use BlackPanda\EmailVerification\Notifications\VerifyEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

trait MustVerifyEmail
{
    /**
     * Determine if the user has verified their email address.
     *
     * @return bool
     */
    public function hasVerifiedEmail()
    {
        return ! is_null($this->email_verified_at);
    }

    /**
     * Mark the given user's email as verified.
     *
     * @return bool
     */
    public function markEmailAsVerified()
    {
        return $this->forceFill([
            'email_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $verificationCode = $this->createNewVerificationCode($this , 6 , 15);
        $this->notify(new VerifyEmail($verificationCode));
    }

    /**
     * Get the email address that should be used for verification.
     *
     * @return string
     */
    public function getEmailForVerification()
    {
        return $this->email;
    }

    /**
     * Create new VerificationCode
     * @param User $user;
     * @param int $codeLength
     * @param int $validFor
     * @return int
     */
    protected function createNewVerificationCode($user , $codeLength = 6,$validFor = 15){
        $geneateCode = $this->verificationCode($codeLength);

        EmailVerification::create([
           'user_id' => $user->id,
           'verification_code' => Hash::make($geneateCode),
            'expire_date' => Carbon::now()->addMinutes($validFor),
        ]);

        return $geneateCode;
    }

    /**
     * Generate Verification Code
     * @param int $length
     * @return int
     */
    protected function verificationCode($length = 6){
        $rand = '';
        for($i=0;$i<$length;$i++){
            $rand .= mt_rand(0,9);
        }
        return $rand;
    }
}
