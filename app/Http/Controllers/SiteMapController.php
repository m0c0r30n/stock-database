<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Circle;
use Laravelium\Sitemap\SitemapServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class siteMapController extends Controller
{

  public function sitemap(){
    $sitemap = App::make("sitemap");
    $now = Carbon::now();
    $sitemap->add(URL::to('/'), $now, '1.0', 'always');
    $sitemap->add(URL::to('/contact'), '2020-6-1', '0.6', 'monthly');
    $sitemap->add(URL::to('/apply'), '2020-6-1', '0.6', 'monthly');
    $sitemap->add(URL::to('/qa'), '2020-6-1', '0.6', 'monthly');
    $sitemap->add(URL::to('/privacypolicy'), '2020-6-1', '0.6', 'monthly');

    $circles = Circle::orderBy('updated_at', 'desc')->get();
    foreach ($circles as $circle)
    {
        $sitemap->add(URL::to('/circles/' . $circle->id), $circle->updated_at, '0.8', 'monthly');
    }

    return $sitemap->render('xml');
  }
}