<?php

namespace App\Services;

use App\Models\Cep;
use App\Models\Fisher;
use Illuminate\Support\Facades\Http;
use Victorybiz\GeoIPLocation\GeoIPLocation;

class GetGeoLocation
{
    
    
    public static function byAddress($address)
    {
        
        $lat = null;
        $lng = null;
        $error = null;

        try {
            $address = trim(preg_replace('/\s+/', ' ', $address));
            $apiKey = env('GOOGLE_MAP_KEY');
            $url = 'https://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false&key='.$apiKey;
            $geocode=file_get_contents($url);
            $output= json_decode($geocode);
            $lat = $output->results[0]->geometry->location->lat;
            $lng = $output->results[0]->geometry->location->lng;
        } catch (\Exception $e) {
            $error = $e->getMessage();
        }
        return (object) ['lat' => $lat, 'lng' => $lng, 'error' => $error];

    }

    public static function byFisher($fisher) {
        if($fisher instanceof Fisher) {
            if (!empty($fisher->cep)) {
                $return = $this->byAddress("{$fisher->number}, {$fisher->address}, {$fisher->neighborhood}, {$fisher->city}, {$fisher->uf} Brasil");
            } else if (!empty($fisher->international_address)) {
                $return = $this->byAddress("{$fisher->international_address}, {$fisher->zipcode}, {$fisher->country()->name}");
            }
        }
        return $return;        
    }

    public static function byIP($ip = null){
        $geoip = new GeoIPLocation(); 
        if (!empty($ip)){
            $geoip->setIP($ip);
        }
        $return = null;
        if(!empty($geoip->getCountry())){
            $return = (object) [ 'countryName' => $geoip->getCountry(),
                            'countryCode' => $geoip->getCountryCode(),
                            'lat' => $geoip->getLatitude(),
                            'lng' => $geoip->getLongitude()
                        ];
        }
        return $return;
    }

    public static function languageByCountry($country_code, $language_code = '')
    {
        $locales = array('af-ZA','am-ET','ar-AE','ar-BH','ar-DZ','ar-EG','ar-IQ','ar-JO','ar-KW',
                            'ar-LB','ar-LY','ar-MA','arn-CL','ar-OM','ar-QA','ar-SA','ar-SY','ar-TN',
                            'ar-YE','as-IN','az-Cyrl-AZ','az-Latn-AZ','ba-RU','be-BY','bg-BG','bn-BD',
                            'bn-IN','bo-CN','br-FR','bs-Cyrl-BA','bs-Latn-BA','ca-ES','co-FR','cs-CZ',
                            'cy-GB','da-DK','de-AT','de-CH','de-DE','de-LI','de-LU','dsb-DE','dv-MV',
                            'el-GR','en-029','en-AU','en-BZ','en-CA','en-GB','en-IE','en-IN','en-JM',
                            'en-MY','en-NZ','en-PH','en-SG','en-TT','en-US','en-ZA','en-ZW','es-AR',
                            'es-BO','es-CL','es-CO','es-CR','es-DO','es-EC','es-ES','es-GT','es-HN',
                            'es-MX','es-NI','es-PA','es-PE','es-PR','es-PY','es-SV','es-US','es-UY',
                            'es-VE','et-EE','eu-ES','fa-IR','fi-FI','fil-PH','fo-FO','fr-BE','fr-CA',
                            'fr-CH','fr-FR','fr-LU','fr-MC','fy-NL','ga-IE','gd-GB','gl-ES','gsw-FR',
                            'gu-IN','ha-Latn-NG','he-IL','hi-IN','hr-BA','hr-HR','hsb-DE','hu-HU','hy-AM',
                            'id-ID','ig-NG','ii-CN','is-IS','it-CH','it-IT','iu-Cans-CA','iu-Latn-CA','ja-JP',
                            'ka-GE','kk-KZ','kl-GL','km-KH','kn-IN','kok-IN','ko-KR','ky-KG','lb-LU','lo-LA',
                            'lt-LT','lv-LV','mi-NZ','mk-MK','ml-IN','mn-MN','mn-Mong-CN','moh-CA','mr-IN',
                            'ms-BN','ms-MY','mt-MT','nb-NO','ne-NP','nl-BE','nl-NL','nn-NO','nso-ZA','oc-FR',
                            'or-IN','pa-IN','pl-PL','prs-AF','ps-AF','pt-BR','pt-PT','qut-GT','quz-BO',
                            'quz-EC','quz-PE','rm-CH','ro-RO','ru-RU','rw-RW','sah-RU','sa-IN','se-FI',
                            'se-NO','se-SE','si-LK','sk-SK','sl-SI','sma-NO','sma-SE','smj-NO','smj-SE',
                            'smn-FI','sms-FI','sq-AL','sr-Cyrl-BA','sr-Cyrl-CS','sr-Cyrl-ME','sr-Cyrl-RS',
                            'sr-Latn-BA','sr-Latn-CS','sr-Latn-ME','sr-Latn-RS','sv-FI','sv-SE','sw-KE','syr-SY',
                            'ta-IN','te-IN','tg-Cyrl-TJ','th-TH','tk-TM','tn-ZA','tr-TR','tt-RU','tzm-Latn-DZ',
                            'ug-CN','uk-UA','ur-PK','uz-Cyrl-UZ','uz-Latn-UZ','vi-VN','wo-SN','xh-ZA','yo-NG',
                            'zh-CN','zh-HK','zh-MO','zh-SG','zh-TW','zu-ZA',);

        foreach ($locales as $locale)
        {
            $locale_region = locale_get_region($locale);
            $locale_language = locale_get_primary_language($locale);
            $locale_array = array('language' => $locale_language,
                                'region' => $locale_region);

            if (strtoupper($country_code) == $locale_region &&
                $language_code == '')
            {
                return locale_compose($locale_array);
            }
            elseif (strtoupper($country_code) == $locale_region &&
                    strtolower($language_code) == $locale_language)
            {
                return locale_compose($locale_array);
            }
        }

        return null;
    }

    
}