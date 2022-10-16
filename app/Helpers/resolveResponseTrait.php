<?php

namespace App\Helpers;

trait ResolveResponseTrait
{
    public function resolveResponse($view = 'pages.index', $data = null, $routeRedirect = null, $options = null)
    {
        if (\request()->wantsJson()) {
            return response([
                'succuess' => true,
                'code' => StatusResponseCodes::SUCCUESS,
                'data' => $data
            ]);
        } else {
            // return redirect
            if ($routeRedirect) return redirect()->route($routeRedirect, $options);
            return view($view)->with('data', $data);
        }
    }
}
