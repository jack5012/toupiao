<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;

class DomainsOauthController extends Controller
{

    public function __invoke(Request $request)
    {
        if ($request->has('code') && $request->has('domain')) {
            return redirect()->to($this->getTargetUrl($request));
        }
    }

    protected function getTargetUrl($request)
    {
        $domain = $request->get('domain');
        $code = $request->get('code');
        return $domain.(strpos($domain,'?') ? '&' : '?').'code='.$code;
    }
}