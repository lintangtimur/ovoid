<?php

declare(strict_types=1);

namespace Stelin;


final class Config
{
    public const HOST = 'agw.ovo.id';
    public const BASE_URL = 'https://' . self::HOST . '/';

    /**
     * Header `client-id`. The API expects a hardcoded literal `'ovo_android'`; sending the
     * app's OAuth client id value here instead is what used to make every request fail with
     * `OV00013 "Anda Tidak Memiliki Akses"`.
     */
    public const CLIENT_ID = 'ovo_android';

    /** Header `App-Version` — `3.166.0`. */
    public const APP_VERSION = '3.166.0';

    public const OS = 'Android';
    public const OS_VERSION = '13';

    /**
     * User-Agent sent with every request. Some deployments reject requests with an
     * unrecognized User-Agent, so it's set explicitly rather than left blank.
     */
    public const USER_AGENT = 'okhttp/4.9.0';

    public const CHANNEL_CODE = 'ovo_android';

    /** `appsource` form field / payment v2 marker. */
    public const APP_SOURCE = 'ovo';

    private function __construct()
    {
        // Static constant holder only.
    }
}
