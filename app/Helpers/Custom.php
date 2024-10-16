<?php

if (!function_exists('only_numbers')) {
	function only_numbers($str)
	{
		return preg_replace('/[^0-9]/', '', $str);
	}
}

if (!function_exists('mask'))
{
	function mask($mask, $str) {
		$str = str_replace(' ', '', $str);

		for($i = 0; $i < strlen($str); $i++) {
			$mask[strpos($mask, '#')] = $str[$i];
		}

		return $mask;
	}
}

if (!function_exists('currency_formatter')) {
    function currency_formatter($lang, $number)
    {
        $formatter = new \NumberFormatter('pt_BR', \NumberFormatter::CURRENCY);
        return $formatter->format($number);
    }
}

if (!function_exists('currency_spellout_formatter')) {
    function currency_spellout_formatter($lang, $number)
    {
        $formatter = new \NumberFormatter('pt_BR', \NumberFormatter::SPELLOUT);
        return $formatter->format($number);
    }
}

if (!function_exists('route_action_name')) {
	function route_action_name()
	{
		return substr(Route::getCurrentRoute()->getActionName(), strpos(Route::getCurrentRoute()->getActionName(), '@') + 1);
	}
}

if (!function_exists('platform_name')) {
  function platform_name($str)
  {
    if(preg_match('/android/i', $str))
        return 'Android';

    if(preg_match('/iphone/i', $str))
        return 'IOS';

    if(preg_match('/linux/i', $str))
        return 'Linux';

    if(preg_match('/macintosh|mac os x/i', $str))
        return 'Mac OS';

    if(preg_match('/windows|win32/i', $str))
        return 'Windows';

    return 'Unknown';
  }
}

if (!function_exists('browser_name')) {
  function browser_name($str)
  {
    if(preg_match('/MSIE/i', $str) && !preg_match('/Opera/i', $str))
        return 'Internet Explorer';

    if(preg_match('/Firefox/i', $str))
        return 'Mozilla Firefox';

    if(preg_match('/OPR/i', $str))
        return 'Opera';

    if(preg_match('/Chrome/i', $str) && !preg_match('/Edge/i', $str))
        return 'Google Chrome';

    if(preg_match('/Safari/i', $str) && !preg_match('/Edge/i', $str))
        return 'Apple Safari';

    if(preg_match('/Netscape/i', $str))
        return 'Netscape';

    if(preg_match('/Edge/i', $str))
        return 'Edge';

    if(preg_match('/Trident/i', $str))
        return 'Internet Explorer';

    return 'Unknown';
  }
}

if (!function_exists('telephone')) {
    function telephone($number){
      if (strlen($number) <= 11) {
        $number="(".substr($number,0,2).") ".substr($number,2,-4)." - ".substr($number,-4);
        // primeiro substr pega apenas o DDD e coloca dentro do (), segundo subtr pega os números do 3º até faltar 4, insere o hifem, e o ultimo pega apenas o 4 ultimos digitos
      }
      else {
        $number= substr($number,0,2)." "."(".substr($number,2,2).") ".substr($number,4,-4)." - ".substr($number,-4);
      }
      return $number;
    }
}

if (!function_exists('cpf')) {
    function cpf($cpf){
        $cpf= substr($cpf,0,3).".".substr($cpf,3,3).".".substr($cpf,6,3)."-".substr($cpf,-2);
        return $cpf;
    }
}


if (!function_exists('cnpj')) {
    function cnpj($cnpj){
        $cnpj= substr($cnpj,0,2).".".substr($cnpj,2,3).".".substr($cnpj,5,3)."/".substr($cnpj,8,4)."-".substr($cnpj,-2);
        return $cnpj;
    }
}