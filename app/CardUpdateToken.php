<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardUpdateToken extends Model
{
    /**
     * Generate a new token with a random hash
     * @return self
     */
    public static function generate()
    {
        $token = new self;
        $token->hash = uniqid();

        return $token;
    }

    public function toString()
    {
        return $this->hash;
    }

    public function __toString()
    {
        return $this->toString();
    }
}
