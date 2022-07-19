<?php

use App\Client;
use App\Company;
use App\General;
use App\Social;
use App\User;

function get_general_value($key)
{
    $general = General::where('key', $key)->first();
    if ($general) {
        return $general->value;
    }

    return '';
}
function booking_status($status){
    if ($status == 1) {
        return trans('Done');
    } elseif ($status == 0) {
        return trans('Reject');
    } elseif ($status == 2) {
        return trans('in progress order');
    }
}
if ( ! function_exists('get_social'))
{
    function get_social($key)
    {
       $general = Social::where('type', $key)->first();
       if($general){
           return $general->value;
       }

       return '';
    }

}
if (!function_exists('generateNumber')) {
    function generateNumber()
    {
        $number = mt_rand(0000, 9999); // better than rand()

        // call the same function if the barcode exists already
        if (CodeNumberExists($number)) {
            return generateNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }
    function get_lang(){
        return app()->getLocale();
 
    }

    function CodeNumberExists($number)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Client::whereOtp($number)->exists();
    }
    function generate_password()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        // generate a pin based on 2 * 7 digits + a random character
        $pin = mt_rand(1000000, 9999999)

            . $characters[rand(0, strlen($characters))] . mt_rand(00, 11);

        // shuffle the result
        $string = str_shuffle($pin);
        return $string;
    }
    function worker_status($worker)
    {
        
        if ($worker->status == 0) {
            return trans('busy');
        }else{
            if($worker->is_quick == 1){
                return trans('available');
            }else{
                return trans('needs time') .' '. $worker->time . ' '.trans('months');
            }

        }
    }
    function color($status)
    {
        if ($status == 1) {
            return 'success';
        } elseif ($status == 0) {
            return 'danger';
        } elseif ($status == 2) {
            return 'warning';
        }
    }
     function get_color_new($status)
    {
        if ($status == 1) {
            return '#5fc69e';
        } elseif ($status == 0) {
            return '#FF4961';
        } elseif ($status == 2) {
            return '#FF9149';
        }
    }
    function get_language()
{
    $languages_list = array(
        'en' => 'English',
        'ar' => 'Arabic',
    );
    return $languages_list;
}
    function get_city_en()
    {
      $city = array(
                    'Abhā' => 'Abhā',
                    'Abqaiq' => 'Abqaiq',
                    'Al-Baḥah' => 'Al-Baḥah',
                    'Al-Dammām' => 'Al-Dammām',
                    'Al-Hufūf' => 'Al-Hufūf',
                    'Al-Jawf' => 'Al-Jawf',
                    'Al-Kharj' => 'Al-Kharj',
                    'Al-Khubar' => 'Al-Khubar',
                    'Al-Qaṭīf' => 'Al-Qaṭīf',
                    'Al-Ṭaʾif' => 'Al-Ṭaʾif',
                    'ʿArʿar' => 'ʿArʿar',
                    'Buraydah' => 'Buraydah',
                    'Dhahran' => 'Dhahran',
                    'Ḥāʾil' => 'Ḥāʾil',
                    'Jiddah' => 'Jiddah',
                    'Jīzān' => 'Jīzān',
                    'Khamīs Mushayt' => 'Khamīs Mushayt',
                    'King Khalīd Military City' => 'King Khalīd Military City',
                    'Mecca' => 'Mecca',
                    'Medina' => 'Medina',
                    'Najrān' => 'Najrān',
                    'Ras Tanura' => 'Ras Tanura',
                    'Riyadh' => 'Riyadh',
                    'Sakākā' => 'Sakākā',
                    'Tabūk' => 'Tabūk',
                    'Yanbuʿ' => 'Yanbuʿ',
                    'Other' => 'Other',
      );
      return $city;

    }
    function get_city_ar()
    {
      $city = array(
                    'Abhā' => 'أبها',
                    'Abqaiq' => 'بقيق',
                    'Al-Baḥah' => 'الباحة',
                    'Al-Dammām' => 'الدمام',
                    'Al-Hufūf' => 'الحفوف',
                    'Al-Jawf' => 'الجوف',
                    'Al-Kharj' => 'الخرج',
                    'Al-Khubar' => 'الخبر',
                    'Al-Qaṭīf' => 'القطيف',
                    'Al-Ṭaʾif' => 'الطائف',
                    'ʿArʿar' => 'عرعر',
                    'Buraydah' => 'بريدة',
                    'Dhahran' => 'الظهران',
                    'Ḥāʾil' => 'حائل',
                    'Jiddah' => 'جدة',
                    'Jīzān' => 'جازان',
                    'Khamīs Mushayt' => 'خميس مشيط',
                    'King Khalīd Military City' => 'مدينة الملك خالد العسكرية',
                    'Mecca' => 'مكة',
                    'Medina' => 'المدينة',
                    'Najrān' => 'نجران',
                    'Ras Tanura' => 'رأس تنورة',
                    'Riyadh' => 'الرياض',
                    'Sakākā' => 'سكاكة',
                    'Tabūk' => 'تبوك',
                    'Yanbuʿ' => 'ينبع',
                    'Other' => 'اخرى',
      );
      return $city;

    }
function openJSONFile($code){
    $jsonString = [];
    if(File::exists(base_path('resources/lang/'.$code.'.json'))){
        $jsonString = file_get_contents(base_path('resources/lang/'.$code.'.json'));
        $jsonString = json_decode($jsonString, true);
    }
    return $jsonString;
}

function saveJSONFile($code, $data){
    ksort($data);
    $jsonData = json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);
    file_put_contents(base_path('resources/lang/'.$code.'.json'), stripslashes($jsonData));
}

    //     function get_language()
    // {
    //     $languages_list = array(
    //         'af' => 'Afrikaans',
    //         'sq' => 'Albanian - shqip',
    //         'am' => 'Amharic - አማርኛ',
    //         'ar' => 'Arabic - العربية',
    //         'an' => 'Aragonese - aragonés',
    //         'hy' => 'Armenian - հայերեն',
    //         'ast' => 'Asturian - asturianu',
    //         'az' => 'Azerbaijani - azərbaycan dili',
    //         'eu' => 'Basque - euskara',
    //         'be' => 'Belarusian - беларуская',
    //         'bn' => 'Bengali - বাংলা',
    //         'bs' => 'Bosnian - bosanski',
    //         'br' => 'Breton - brezhoneg',
    //         'bg' => 'Bulgarian - български',
    //         'ca' => 'Catalan - català',
    //         'ckb' => 'Central Kurdish - کوردی (دەستنوسی عەرەبی)',
    //         'zh' => 'Chinese - 中文',
    //         'zh-HK' => 'Chinese (Hong Kong) - 中文（香港）',
    //         'zh-CN' => 'Chinese (Simplified) - 中文（简体）',
    //         'zh-TW' => 'Chinese (Traditional) - 中文（繁體）',
    //         'co' => 'Corsican',
    //         'hr' => 'Croatian - hrvatski',
    //         'cs' => 'Czech - čeština',
    //         'da' => 'Danish - dansk',
    //         'nl' => 'Dutch - Nederlands',
    //         'en' => 'English',
    //         'en-AU' => 'English (Australia)',
    //         'en-CA' => 'English (Canada)',
    //         'en-IN' => 'English (India)',
    //         'en-NZ' => 'English (New Zealand)',
    //         'en-ZA' => 'English (South Africa)',
    //         'en-GB' => 'English (United Kingdom)',
    //         'en-US' => 'English (United States)',
    //         'eo' => 'Esperanto - esperanto',
    //         'et' => 'Estonian - eesti',
    //         'fo' => 'Faroese - føroyskt',
    //         'fil' => 'Filipino',
    //         'fi' => 'Finnish - suomi',
    //         'fr' => 'French - français',
    //         'fr-CA' => 'French (Canada) - français (Canada)',
    //         'fr-FR' => 'French (France) - français (France)',
    //         'fr-CH' => 'French (Switzerland) - français (Suisse)',
    //         'gl' => 'Galician - galego',
    //         'ka' => 'Georgian - ქართული',
    //         'de' => 'German - Deutsch',
    //         'de-AT' => 'German (Austria) - Deutsch (Österreich)',
    //         'de-DE' => 'German (Germany) - Deutsch (Deutschland)',
    //         'de-LI' => 'German (Liechtenstein) - Deutsch (Liechtenstein)',
    //         'de-CH' => 'German (Switzerland) - Deutsch (Schweiz)',
    //         'el' => 'Greek - Ελληνικά',
    //         'gn' => 'Guarani',
    //         'gu' => 'Gujarati - ગુજરાતી',
    //         'ha' => 'Hausa',
    //         'haw' => 'Hawaiian - ʻŌlelo Hawaiʻi',
    //         'he' => 'Hebrew - עברית',
    //         'hi' => 'Hindi - हिन्दी',
    //         'hu' => 'Hungarian - magyar',
    //         'is' => 'Icelandic - íslenska',
    //         'id' => 'Indonesian - Indonesia',
    //         'ia' => 'Interlingua',
    //         'ga' => 'Irish - Gaeilge',
    //         'it' => 'Italian - italiano',
    //         'it-IT' => 'Italian (Italy) - italiano (Italia)',
    //         'it-CH' => 'Italian (Switzerland) - italiano (Svizzera)',
    //         'ja' => 'Japanese - 日本語',
    //         'kn' => 'Kannada - ಕನ್ನಡ',
    //         'kk' => 'Kazakh - қазақ тілі',
    //         'km' => 'Khmer - ខ្មែរ',
    //         'ko' => 'Korean - 한국어',
    //         'ku' => 'Kurdish - Kurdî',
    //         'ky' => 'Kyrgyz - кыргызча',
    //         'lo' => 'Lao - ລາວ',
    //         'la' => 'Latin',
    //         'lv' => 'Latvian - latviešu',
    //         'ln' => 'Lingala - lingála',
    //         'lt' => 'Lithuanian - lietuvių',
    //         'mk' => 'Macedonian - македонски',
    //         'ms' => 'Malay - Bahasa Melayu',
    //         'ml' => 'Malayalam - മലയാളം',
    //         'mt' => 'Maltese - Malti',
    //         'mr' => 'Marathi - मराठी',
    //         'mn' => 'Mongolian - монгол',
    //         'ne' => 'Nepali - नेपाली',
    //         'no' => 'Norwegian - norsk',
    //         'nb' => 'Norwegian Bokmål - norsk bokmål',
    //         'nn' => 'Norwegian Nynorsk - nynorsk',
    //         'oc' => 'Occitan',
    //         'or' => 'Oriya - ଓଡ଼ିଆ',
    //         'om' => 'Oromo - Oromoo',
    //         'ps' => 'Pashto - پښتو',
    //         'fa' => 'Persian - فارسی',
    //         'pl' => 'Polish - polski',
    //         'pt' => 'Portuguese - português',
    //         'pt-BR' => 'Portuguese (Brazil) - português (Brasil)',
    //         'pt-PT' => 'Portuguese (Portugal) - português (Portugal)',
    //         'pa' => 'Punjabi - ਪੰਜਾਬੀ',
    //         'qu' => 'Quechua',
    //         'ro' => 'Romanian - română',
    //         'mo' => 'Romanian (Moldova) - română (Moldova)',
    //         'rm' => 'Romansh - rumantsch',
    //         'ru' => 'Russian - русский',
    //         'gd' => 'Scottish Gaelic',
    //         'sr' => 'Serbian - српски',
    //         'sh' => 'Serbo-Croatian - Srpskohrvatski',
    //         'sn' => 'Shona - chiShona',
    //         'sd' => 'Sindhi',
    //         'si' => 'Sinhala - සිංහල',
    //         'sk' => 'Slovak - slovenčina',
    //         'sl' => 'Slovenian - slovenščina',
    //         'so' => 'Somali - Soomaali',
    //         'st' => 'Southern Sotho',
    //         'es' => 'Spanish - español',
    //         'es-AR' => 'Spanish (Argentina) - español (Argentina)',
    //         'es-419' => 'Spanish (Latin America) - español (Latinoamérica)',
    //         'es-MX' => 'Spanish (Mexico) - español (México)',
    //         'es-ES' => 'Spanish (Spain) - español (España)',
    //         'es-US' => 'Spanish (United States) - español (Estados Unidos)',
    //         'su' => 'Sundanese',
    //         'sw' => 'Swahili - Kiswahili',
    //         'sv' => 'Swedish - svenska',
    //         'tg' => 'Tajik - тоҷикӣ',
    //         'ta' => 'Tamil - தமிழ்',
    //         'tt' => 'Tatar',
    //         'te' => 'Telugu - తెలుగు',
    //         'th' => 'Thai - ไทย',
    //         'ti' => 'Tigrinya - ትግርኛ',
    //         'to' => 'Tongan - lea fakatonga',
    //         'tr' => 'Turkish - Türkçe',
    //         'tk' => 'Turkmen',
    //         'tw' => 'Twi',
    //         'uk' => 'Ukrainian - українська',
    //         'ur' => 'Urdu - اردو',
    //         'ug' => 'Uyghur',
    //         'uz' => 'Uzbek - o‘zbek',
    //         'vi' => 'Vietnamese - Tiếng Việt',
    //         'wa' => 'Walloon - wa',
    //         'cy' => 'Welsh - Cymraeg',
    //         'fy' => 'Western Frisian',
    //         'xh' => 'Xhosa',
    //         'yi' => 'Yiddish',
    //         'yo' => 'Yoruba - Èdè Yorùbá',
    //         'zu' => 'Zulu - isiZulu'
    //     );
    //     return $languages_list;
    // }


}
