<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use SleepingOwl\Admin\Http\Controllers\AdminController;

class HomeController extends AdminController
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return $this->renderContent(view('dashboard'));
    }

    public function prognosis()
    {
        return $this->renderContent(view('prognosis'));
    }

    public function stock()
    {
        return $this->renderContent(view('stock'));
    }
}
