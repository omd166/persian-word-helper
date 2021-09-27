<?php

use Illuminate\Support\Arr;

if (! function_exists('english_to_persian')) {
    /**
     * Convert english digits to farsi.
     *
     * @param string $text
     * @return string
     */
    function english_to_persian($text)
    {
        $en_num = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $fa_num = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];

        return str_replace($en_num, $fa_num, $text);
    }
}

if (! function_exists('persian_to_english')) {
    /**
     * Convert farsi/arabic digits to english.
     *
     * @param string $text
     * @return string
     */
    function persian_to_english($text)
    {
        $fa_num = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
        $en_num = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        return str_replace($fa_num, $en_num, $text);
    }
}

if (! function_exists('replace_slug_to_persian')) {
    /**
     * Returns slug for string.
     *
     * @param string $string
     * @param string $separator
     * زمانی که از پکیج slugاستفاده کنید,فارسی رو پشتیبانی نمیکنه و به صورت فینگلیش مینویسه
     * این فاکنشن کار تبدیل به تکست فارسی را انجام میدهد
     * @return string
     */
    function replace_slug_to_persian(string $string, string $separator = '-')
    {
        $string = persian_to_english(trim(mb_strtolower($string)));
        $string = preg_replace('!['.preg_quote($separator === '-' ? '_' : '-').']+!u', $separator, $string);

        return preg_replace(
            '/\\'.$separator.'{2,}/',
            $separator,
            preg_replace('/[^A-Za-z0-9\x{0620}-\x{064A}\x{0698}\x{067E}\x{0686}\x{06AF}\x{06CC}\x{06A9}]/ui', $separator, $string)
        );
    }
}
