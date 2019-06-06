<?php

namespace Giuga;

class DomainToIp
{
    public static function find($domain)
    {
        if (stripos($domain, '://') !== false) {
            $domain = substr($domain, stripos($domain, '://') + 3);
        }
        if (substr($domain, strlen($domain) - 1) == '/') {
            $domain = substr($domain, 0, strlen($domain) - 1);
        }
        return self::getIpForDomain($domain);
    }

    private static function getIpForDomain($domain)
    {
        $dns = dns_get_record($domain);
        if (isset($dns[0])) {
            if ($dns[0]['type'] == 'CNAME') {
                return self::find($dns[0]['target']);
            } else {
                return $dns[0]['ip'];
            }
        }
        /**
         * Woops dns fetch failed let's try something else then
         */
        $secondLook = gethostbyname($domain);
        if (filter_var($secondLook, FILTER_VALIDATE_IP)) {
            return $secondLook;
        }
        return false;
    }
}
