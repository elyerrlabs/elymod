<?php

namespace {{ Module }}\App\Http\Controllers;

use App\Http\Controllers\WebController;


final class SettingController extends WebController
{

    /**
     * Contruct
     */
    public function __construct()
    {
        parent::__construct();
        parent::middleware('userCanAny:admin:settings:full,admin:settings:view');
    }

    /**
     * General settings page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function general()
    {
        return view('{{ Module }}::settings.general');
    }
}
