<?php

namespace App\Traits\User;

trait VerifiesEmail
{
    /**
     * The user verifies their email address.
     *
     * @return void
     */
    public function verifyEmail()
    {
        $this->verified = true;

        $this->save();

        $this->activationToken->delete();
    }

    /**
     * Indicate if the user has verified their email address.
     *
     * @return bool
     */
    public function isVerified()
    {
        return $this->verified;
    }
}