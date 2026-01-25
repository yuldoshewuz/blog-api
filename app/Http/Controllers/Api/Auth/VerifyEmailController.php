<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class VerifyEmailController extends BaseController
{
    public function sendNotification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->sendError('Already verified.', [], 400, 'Email already verified.');
        }

        $request->user()->sendEmailVerificationNotification();
        return $this->sendResponse(null, 'Verification link sent.');
    }

    public function verify(EmailVerificationRequest $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return $this->sendResponse(null, 'Email already verified.');
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        return $this->sendResponse(null, 'Email verified successfully.');
    }
}
