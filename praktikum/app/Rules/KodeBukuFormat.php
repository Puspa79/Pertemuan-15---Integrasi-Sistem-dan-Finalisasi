<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class KodeBukuFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }

    public function passes($attribute, $value)
    {
        return preg_match('/^BK-[A-Z]{2,4}-\d{3}$/', $value);
    }
    
    public function message()
    {
        return 'Format kode buku harus: BK-XXX-000 (contoh: BK-PROG-001)';
    }
}
