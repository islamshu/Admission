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
        $number = mt_rand(1111, 9999); // better than rand()

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
        $pin = mt_rand(1111111, 9999999)

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
    function worker_status_id($worker)
    {
        
        if ($worker->status == 0) {
            return trans('busy');
        }else{
            if($worker->is_quick == 1){
                return 1;
            }else{
                return trans('needs time') .' '. $worker->time . ' '.trans('months');
            }

        }
    }
    function worker_status_id_new($worker)
    {
        
        if ($worker->status == 0) {
            return 0;
        }else{
            if($worker->is_quick == 1){
                return 1;
            }else{
                return 2;
            }

        }
    }
    function get_lang_worker($data){
        $langs=  json_decode($data);
        $array = array();
        foreach($langs as $key =>$a){
            $lan[$key]=trans($a);
        //   array_push($array,trans($a));
        }
        $lann = json_encode( $lan, JSON_UNESCAPED_UNICODE );
        $res = preg_replace('/[[0-9\@\.\;\" "[]+/', '', $lann);
       $res= str_replace(']', '', $res);
        return $res;
        

        // return json_encode($lan);
  
      }

    function slug_worker($worker){
        if ($worker->status == 0) {
            return 'busy';
        }else{
            if($worker->is_quick == 1){
                return 'available';
            }else{
                return 'temporary-available';
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
                    'Abh??' => 'Abh??',
                    'Abqaiq' => 'Abqaiq',
                    'Al-Ba???ah' => 'Al-Ba???ah',
                    'Al-Damm??m' => 'Al-Damm??m',
                    'Al-Huf??f' => 'Al-Huf??f',
                    'Al-Jawf' => 'Al-Jawf',
                    'Al-Kharj' => 'Al-Kharj',
                    'Al-Khubar' => 'Al-Khubar',
                    'Al-Qa?????f' => 'Al-Qa?????f',
                    'Al-???a??if' => 'Al-???a??if',
                    '??Ar??ar' => '??Ar??ar',
                    'Buraydah' => 'Buraydah',
                    'Dhahran' => 'Dhahran',
                    '???????il' => '???????il',
                    'Jiddah' => 'Jiddah',
                    'J??z??n' => 'J??z??n',
                    'Kham??s Mushayt' => 'Kham??s Mushayt',
                    'King Khal??d Military City' => 'King Khal??d Military City',
                    'Mecca' => 'Mecca',
                    'Medina' => 'Medina',
                    'Najr??n' => 'Najr??n',
                    'Ras Tanura' => 'Ras Tanura',
                    'Riyadh' => 'Riyadh',
                    'Sak??k??' => 'Sak??k??',
                    'Tab??k' => 'Tab??k',
                    'Yanbu??' => 'Yanbu??',
                    'Other' => 'Other',
      );
      return $city;

    }
    function get_city_ar()
    {
      $city = array(
                    'Abh??' => '????????',
                    'Abqaiq' => '????????',
                    'Al-Ba???ah' => '????????????',
                    'Al-Damm??m' => '????????????',
                    'Al-Huf??f' => '????????????',
                    'Al-Jawf' => '??????????',
                    'Al-Kharj' => '??????????',
                    'Al-Khubar' => '??????????',
                    'Al-Qa?????f' => '????????????',
                    'Al-???a??if' => '????????????',
                    '??Ar??ar' => '????????',
                    'Buraydah' => '??????????',
                    'Dhahran' => '??????????????',
                    '???????il' => '????????',
                    'Jiddah' => '??????',
                    'J??z??n' => '??????????',
                    'Kham??s Mushayt' => '???????? ????????',
                    'King Khal??d Military City' => '?????????? ?????????? ???????? ????????????????',
                    'Mecca' => '??????',
                    'Medina' => '??????????????',
                    'Najr??n' => '??????????',
                    'Ras Tanura' => '?????? ??????????',
                    'Riyadh' => '????????????',
                    'Sak??k??' => '??????????',
                    'Tab??k' => '????????',
                    'Yanbu??' => '????????',
                    'Other' => '????????',
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
    //         'am' => 'Amharic - ????????????',
    //         'ar' => 'Arabic - ??????????????',
    //         'an' => 'Aragonese - aragon??s',
    //         'hy' => 'Armenian - ??????????????',
    //         'ast' => 'Asturian - asturianu',
    //         'az' => 'Azerbaijani - az??rbaycan dili',
    //         'eu' => 'Basque - euskara',
    //         'be' => 'Belarusian - ????????????????????',
    //         'bn' => 'Bengali - ???????????????',
    //         'bs' => 'Bosnian - bosanski',
    //         'br' => 'Breton - brezhoneg',
    //         'bg' => 'Bulgarian - ??????????????????',
    //         'ca' => 'Catalan - catal??',
    //         'ckb' => 'Central Kurdish - ?????????? (???????????????? ????????????)',
    //         'zh' => 'Chinese - ??????',
    //         'zh-HK' => 'Chinese (Hong Kong) - ??????????????????',
    //         'zh-CN' => 'Chinese (Simplified) - ??????????????????',
    //         'zh-TW' => 'Chinese (Traditional) - ??????????????????',
    //         'co' => 'Corsican',
    //         'hr' => 'Croatian - hrvatski',
    //         'cs' => 'Czech - ??e??tina',
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
    //         'fo' => 'Faroese - f??royskt',
    //         'fil' => 'Filipino',
    //         'fi' => 'Finnish - suomi',
    //         'fr' => 'French - fran??ais',
    //         'fr-CA' => 'French (Canada) - fran??ais (Canada)',
    //         'fr-FR' => 'French (France) - fran??ais (France)',
    //         'fr-CH' => 'French (Switzerland) - fran??ais (Suisse)',
    //         'gl' => 'Galician - galego',
    //         'ka' => 'Georgian - ?????????????????????',
    //         'de' => 'German - Deutsch',
    //         'de-AT' => 'German (Austria) - Deutsch (??sterreich)',
    //         'de-DE' => 'German (Germany) - Deutsch (Deutschland)',
    //         'de-LI' => 'German (Liechtenstein) - Deutsch (Liechtenstein)',
    //         'de-CH' => 'German (Switzerland) - Deutsch (Schweiz)',
    //         'el' => 'Greek - ????????????????',
    //         'gn' => 'Guarani',
    //         'gu' => 'Gujarati - ?????????????????????',
    //         'ha' => 'Hausa',
    //         'haw' => 'Hawaiian - ????lelo Hawai??i',
    //         'he' => 'Hebrew - ??????????',
    //         'hi' => 'Hindi - ??????????????????',
    //         'hu' => 'Hungarian - magyar',
    //         'is' => 'Icelandic - ??slenska',
    //         'id' => 'Indonesian - Indonesia',
    //         'ia' => 'Interlingua',
    //         'ga' => 'Irish - Gaeilge',
    //         'it' => 'Italian - italiano',
    //         'it-IT' => 'Italian (Italy) - italiano (Italia)',
    //         'it-CH' => 'Italian (Switzerland) - italiano (Svizzera)',
    //         'ja' => 'Japanese - ?????????',
    //         'kn' => 'Kannada - ???????????????',
    //         'kk' => 'Kazakh - ?????????? ????????',
    //         'km' => 'Khmer - ???????????????',
    //         'ko' => 'Korean - ?????????',
    //         'ku' => 'Kurdish - Kurd??',
    //         'ky' => 'Kyrgyz - ????????????????',
    //         'lo' => 'Lao - ?????????',
    //         'la' => 'Latin',
    //         'lv' => 'Latvian - latvie??u',
    //         'ln' => 'Lingala - ling??la',
    //         'lt' => 'Lithuanian - lietuvi??',
    //         'mk' => 'Macedonian - ????????????????????',
    //         'ms' => 'Malay - Bahasa Melayu',
    //         'ml' => 'Malayalam - ??????????????????',
    //         'mt' => 'Maltese - Malti',
    //         'mr' => 'Marathi - ???????????????',
    //         'mn' => 'Mongolian - ????????????',
    //         'ne' => 'Nepali - ??????????????????',
    //         'no' => 'Norwegian - norsk',
    //         'nb' => 'Norwegian Bokm??l - norsk bokm??l',
    //         'nn' => 'Norwegian Nynorsk - nynorsk',
    //         'oc' => 'Occitan',
    //         'or' => 'Oriya - ???????????????',
    //         'om' => 'Oromo - Oromoo',
    //         'ps' => 'Pashto - ????????',
    //         'fa' => 'Persian - ??????????',
    //         'pl' => 'Polish - polski',
    //         'pt' => 'Portuguese - portugu??s',
    //         'pt-BR' => 'Portuguese (Brazil) - portugu??s (Brasil)',
    //         'pt-PT' => 'Portuguese (Portugal) - portugu??s (Portugal)',
    //         'pa' => 'Punjabi - ??????????????????',
    //         'qu' => 'Quechua',
    //         'ro' => 'Romanian - rom??n??',
    //         'mo' => 'Romanian (Moldova) - rom??n?? (Moldova)',
    //         'rm' => 'Romansh - rumantsch',
    //         'ru' => 'Russian - ??????????????',
    //         'gd' => 'Scottish Gaelic',
    //         'sr' => 'Serbian - ????????????',
    //         'sh' => 'Serbo-Croatian - Srpskohrvatski',
    //         'sn' => 'Shona - chiShona',
    //         'sd' => 'Sindhi',
    //         'si' => 'Sinhala - ???????????????',
    //         'sk' => 'Slovak - sloven??ina',
    //         'sl' => 'Slovenian - sloven????ina',
    //         'so' => 'Somali - Soomaali',
    //         'st' => 'Southern Sotho',
    //         'es' => 'Spanish - espa??ol',
    //         'es-AR' => 'Spanish (Argentina) - espa??ol (Argentina)',
    //         'es-419' => 'Spanish (Latin America) - espa??ol (Latinoam??rica)',
    //         'es-MX' => 'Spanish (Mexico) - espa??ol (M??xico)',
    //         'es-ES' => 'Spanish (Spain) - espa??ol (Espa??a)',
    //         'es-US' => 'Spanish (United States) - espa??ol (Estados Unidos)',
    //         'su' => 'Sundanese',
    //         'sw' => 'Swahili - Kiswahili',
    //         'sv' => 'Swedish - svenska',
    //         'tg' => 'Tajik - ????????????',
    //         'ta' => 'Tamil - ???????????????',
    //         'tt' => 'Tatar',
    //         'te' => 'Telugu - ??????????????????',
    //         'th' => 'Thai - ?????????',
    //         'ti' => 'Tigrinya - ????????????',
    //         'to' => 'Tongan - lea fakatonga',
    //         'tr' => 'Turkish - T??rk??e',
    //         'tk' => 'Turkmen',
    //         'tw' => 'Twi',
    //         'uk' => 'Ukrainian - ????????????????????',
    //         'ur' => 'Urdu - ????????',
    //         'ug' => 'Uyghur',
    //         'uz' => 'Uzbek - o???zbek',
    //         'vi' => 'Vietnamese - Ti???ng Vi???t',
    //         'wa' => 'Walloon - wa',
    //         'cy' => 'Welsh - Cymraeg',
    //         'fy' => 'Western Frisian',
    //         'xh' => 'Xhosa',
    //         'yi' => 'Yiddish',
    //         'yo' => 'Yoruba - ??d?? Yor??b??',
    //         'zu' => 'Zulu - isiZulu'
    //     );
    //     return $languages_list;
    // }


}
