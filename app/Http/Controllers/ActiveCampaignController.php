<?php

namespace Futbol\Http\Controllers;

use Illuminate\Http\Request;
use AC;
use ActiveCampaign;

class ActiveCampaignController extends Controller
{
    
    private $ac;

    function __construct()
    {
        $this->ac = new ActiveCampaign(config('activecampaign.api_url'), config('activecampaign.api_key'));
    }
    
    public function index() {
        dd($this->ac->api("contact/view?email=jorgeconsalvacion@gmail.com"));
    }
}
