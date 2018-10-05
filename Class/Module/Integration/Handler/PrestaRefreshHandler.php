<?php

namespace App\Module\Integration\Handler;

use App\Handler;
use App\Module\Files\Collection\FileCollection;
use App\Module\Files\Request\GetFilesRequest;
use App\Module\Files\Response\GetFilesResponse;
use App\Request\EmptyRequest;
use App\Response\SuccessResponse;
use App\Type\FileResponse;
use App\Type\FilesResponse;
use App\Type\Filter;
use App\Type\FilterKind;
use App\User;

class PrestaRefreshHandler extends Handler
{
    public function __invoke(EmptyRequest $request): SuccessResponse
    {
        $email = 'worzala86@gmail.com';
        $password = 'X6DAP9NPG421NFXH5T5JI736Q34F73CZ';
        $url = 'http://prestashop.localhost/api/customers/?filter[email]=' . $email . '&filter[passwd]=' . $password;

        $ch = curl_init();
        $user_agent = 'Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
        curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
        echo curl_exec($ch);

        exit;
        return new SuccessResponse;
    }
}