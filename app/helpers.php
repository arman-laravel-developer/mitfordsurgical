<?php
use App\Models\Translation;


if (!function_exists('convert_number')) {
    function convert_number($number)
    {
        if (($number < 0) || ($number > 999999999))
        {
            throw new Exception("Number is out of range");
        }
        $giga = floor($number / 1000000);
        // Millions (giga)
        $number -= $giga * 1000000;
        $kilo = floor($number / 1000);
        // Thousands (kilo)
        $number -= $kilo * 1000;
        $hecto = floor($number / 100);
        // Hundreds (hecto)
        $number -= $hecto * 100;
        $deca = floor($number / 10);
        // Tens (deca)
        $n = $number % 10;
        // Ones
        $result = "";
        if ($giga)
        {
            $result .= convert_number($giga) .  "Million";
        }
        if ($kilo)
        {
            $result .= (empty($result) ? "" : " ") .convert_number($kilo) . " Thousand";
        }
        if ($hecto)
        {
            $result .= (empty($result) ? "" : " ") .convert_number($hecto) . " Hundred";
        }
        $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
        $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eigthy", "Ninety");
        if ($deca || $n) {
            if (!empty($result))
            {
                $result .= " and ";
            }
            if ($deca < 2)
            {
                $result .= $ones[$deca * 10 + $n];
            } else {
                $result .= $tens[$deca];
                if ($n)
                {
                    $result .= "-" . $ones[$n];
                }
            }
        }
        if (empty($result))
        {
            $result = "zero";
        }
        return $result;
    }
}

if (!function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return app('url')->asset('public/' . $path, $secure);
    }
}

if (!function_exists('discounted_price')) {
    function discounted_price($product)
    {
        $newPrice = $product->sell_price;
        $currentDate = date('Y-m-d'); // Get the current date
        $discountStartDate = $product->start_date; // Assuming this field exists in the product model
        $discountEndDate = $product->end_date; // Assuming this field exists in the product model

        // Check if the current date is within the discount period
        if ($product->discount > 0 && $currentDate >= $discountStartDate && $currentDate <= $discountEndDate) {
            if ($product->discount_type == 2) {
                $newPrice = $product->sell_price - ($product->sell_price * ($product->discount / 100));
            } else {
                $newPrice = $product->sell_price - $product->discount;
            }
        }

        return $newPrice;
    }
}
if (!function_exists('discounted_active')) {
    function discounted_active($product)
    {
        $currentDate = \Carbon\Carbon::now();
        $startDate = \Carbon\Carbon::parse($product->start_date);
        $endDate = \Carbon\Carbon::parse($product->end_date);

        return $product->discount > 0 && $currentDate->between($startDate, $endDate);
    }
}


if (!function_exists('mask_email')) {
    function mask_email($email) {
        $parts = explode("@", $email);
        $name = $parts[0];
        $domain = $parts[1];

        $name_length = strlen($name);
        $masked_name = substr($name, 0, 2) . str_repeat('*', $name_length - 4) . substr($name, -2);

        return $masked_name . '@' . $domain;
    }
}

if (!function_exists('mask_mobile_number')) {
    function mask_mobile_number($mobile_number) {
        // Remove any non-digit characters
        $clean_number = preg_replace('/\D/', '', $mobile_number);

        // Check if the cleaned number has at least 4 digits
        $length = strlen($clean_number);
        if ($length >= 4) {
            // Mask all but the last 4 digits
            $masked_number = str_repeat('*', $length - 4) . substr($clean_number, -4);
            return $masked_number;
        } else {
            // Return the original input if it has less than 4 digits
            return $mobile_number;
        }
    }
}


if (!function_exists('updateEnv'))
{
    function updateEnv(array $data)
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            $env = file_get_contents($path);

            foreach ($data as $key => $value) {
                $key = strtoupper($key);
                $value = '"' . $value . '"';

                if (preg_match("/^{$key}=/m", $env)) {
                    $env = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $env);
                } else {
                    $env .= "\n{$key}={$value}";
                }
            }

            file_put_contents($path, $env);
        }
    }
}

function translate($key, $params = [], $lang = null)
{
    if ($lang == null) {
        $lang = Session::get('locale');
    }

    $lang_key = preg_replace('/[^A-Za-z0-9\_]/', '', str_replace(' ', '_', strtolower($key)));

    $translations_default = Cache::rememberForever('translations-' . env('DEFAULT_LANGUAGE', 'en'), function () {
        return Translation::where('lang', env('DEFAULT_LANGUAGE', 'en'))->pluck('lang_value', 'lang_key')->toArray();
    });

    if (!isset($translations_default[$lang_key])) {
        $translation_def = new Translation;
        $translation_def->lang = env('DEFAULT_LANGUAGE', 'en');
        $translation_def->lang_key = $lang_key;
        $translation_def->lang_value = $key;
        $translation_def->save();
        Cache::forget('translations-' . env('DEFAULT_LANGUAGE', 'en'));
    }

    $translation_locale = Cache::rememberForever('translations-' . $lang, function () use ($lang) {
        return Translation::where('lang', $lang)->pluck('lang_value', 'lang_key')->toArray();
    });

    $translation = $translation_locale[$lang_key] ?? $translations_default[$lang_key] ?? $key;

    // Replace placeholders if $params is provided
    foreach ($params as $placeholder => $value) {
        $translation = str_replace(':' . $placeholder, $value, $translation);
    }

    return $translation;
}

if (!function_exists('banglaToBanglish')) {
    function banglaToBanglish($text) {
        $map = [
            'অ' => 'o', 'আ' => 'a', 'ই' => 'i', 'ঈ' => 'ee',
            'উ' => 'u', 'ঊ' => 'oo', 'ঋ' => 'ri', 'এ' => 'e',
            'ঐ' => 'oi', 'ও' => 'o', 'ঔ' => 'ou', 'ক' => 'k',
            'খ' => 'kh', 'গ' => 'g', 'ঘ' => 'gh', 'ঙ' => 'ng',
            'চ' => 'ch', 'ছ' => 'chh', 'জ' => 'j', 'ঝ' => 'jh',
            'ঞ' => 'n', 'ট' => 't', 'ঠ' => 'th', 'ড' => 'd',
            'ঢ' => 'dh', 'ণ' => 'n', 'ত' => 't', 'থ' => 'th',
            'দ' => 'd', 'ধ' => 'dh', 'ন' => 'n', 'প' => 'p',
            'ফ' => 'ph', 'ব' => 'b', 'ভ' => 'bh', 'ম' => 'm',
            'য' => 'y', 'র' => 'r', 'ল' => 'l', 'শ' => 'sh',
            'ষ' => 'sh', 'স' => 's', 'হ' => 'h', 'ড়' => 'r',
            'ঢ়' => 'rh', 'য়' => 'y', 'ৎ' => 't', 'ং' => 'ng',
            'ঃ' => 'h', 'ঁ' => 'n', 'া' => 'a', 'ি' => 'i',
            'ী' => 'ee', 'ু' => 'u', 'ূ' => 'oo', 'ে' => 'e',
            'ৈ' => 'oi', 'ো' => 'o', 'ৌ' => 'ou', '্' => '',
            ' ' => ' ',
        ];

        // Replace each Bangla character with its corresponding Banglish equivalent
        foreach ($map as $bangla => $banglish) {
            $text = str_replace($bangla, $banglish, $text);
        }

        return $text;
    }
}

if (!function_exists('formatBanglish')) {
    function formatBanglish($text) {
        $transliterated = banglaToBanglish($text);

        // Capitalize each word
        $formatted = ucwords(strtolower($transliterated));

        // Replace multiple spaces with a single space
        return preg_replace('/\s+/', ' ', $formatted);
    }
}


