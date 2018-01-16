<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;
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
        return $request->get('domains').(empty($queries) ? '' : '?').http_build_query($queries);
    }
}