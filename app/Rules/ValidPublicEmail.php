<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Validator;

class ValidPublicEmail implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $email = is_string($value) ? trim($value) : '';

        if ($email === '') {
            $fail('Please enter a valid email address.');

            return;
        }

        // Reject obviously malformed / disposable-looking local tricks.
        if (
            ! filter_var($email, FILTER_VALIDATE_EMAIL)
            || preg_match('/\s/', $email)
            || substr_count($email, '@') !== 1
        ) {
            $fail('Please enter a valid email address.');

            return;
        }

        [, $domain] = explode('@', $email, 2);
        $domain = strtolower($domain);

        if (
            $domain === ''
            || ! str_contains($domain, '.')
            || str_starts_with($domain, '.')
            || str_ends_with($domain, '.')
            || str_contains($domain, '..')
        ) {
            $fail('Please enter a valid email address with a real domain.');

            return;
        }

        // RFC format + DNS (MX/A) so invented domains like test@notareal.xyz fail.
        $validator = Validator::make(
            ['email' => $email],
            ['email' => 'email:rfc,dns']
        );

        if ($validator->fails()) {
            $fail('This email address is not valid or its domain cannot receive mail.');
        }
    }
}
