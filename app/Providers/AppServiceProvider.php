<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;
use App\Models\Cms;
use App\Models\District;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        try {
            // View composer for all front views: cache shared layout data for 60 minutes
            View::composer(['front.*', 'front.layout.*'], function ($view) {
                $setting = Cache::remember('site_global_setting', 3600, function () {
                    return Setting::orderBy('id', 'asc')->first();
                });

                $siteLogo = Cache::remember('site_global_logo', 3600, function () use ($setting) {
                    if (!$setting || empty($setting->logo_image)) {
                        return null;
                    }
                    $val = $setting->logo_image;
                    if (filter_var($val, FILTER_VALIDATE_URL)) {
                        return $val;
                    }
                    $cleanPath = ltrim($val, '/');
                    if (str_starts_with($cleanPath, 'upload/')) {
                        return asset('public/' . $cleanPath);
                    }
                    if (str_starts_with($cleanPath, 'public/')) {
                        return asset($cleanPath);
                    }
                    return asset('public/upload/setting/' . basename($cleanPath));
                });

                $cmsPages = Cache::remember('site_global_cms', 3600, function () {
                    return Cms::where('status', 1)->get();
                });

                $aboutCms   = $cmsPages->firstWhere('id', 1) ?? $cmsPages->firstWhere('slug', 'about-us') ?? $cmsPages->first(fn($c) => stripos($c->title, 'about') !== false);
                $termsCms   = $cmsPages->firstWhere('id', 2) ?? $cmsPages->firstWhere('slug', 'terms-and-conditions') ?? $cmsPages->first(fn($c) => stripos($c->title, 'term') !== false);
                $privacyCms = $cmsPages->firstWhere('id', 3) ?? $cmsPages->firstWhere('slug', 'privacy-policy') ?? $cmsPages->first(fn($c) => stripos($c->title, 'privacy') !== false);
                $noticeCms  = $cmsPages->firstWhere('id', 4) ?? $cmsPages->firstWhere('slug', 'notice') ?? $cmsPages->first(fn($c) => stripos($c->title, 'notice') !== false);

                $layoutDistricts = Cache::remember('site_global_districts', 3600, function () {
                    return District::select('id', 'name')->where('status', 1)->orderBy('name')->get();
                });

                $layoutCategories = Cache::remember('site_global_categories', 3600, function () {
                    return Category::select('id', 'name', 'parent_id', 'image')
                        ->whereNull('parent_id')
                        ->where('status', 1)
                        ->orderBy('name')
                        ->get();
                });

                $view->with([
                    'siteTitle'        => $setting->site_title ?? 'Agent 24 India',
                    'siteSetting'      => $setting,
                    'siteLogo'         => $siteLogo,
                    'siteAbout'        => $aboutCms,
                    'siteTerms'        => $termsCms,
                    'sitePrivacy'      => $privacyCms,
                    'siteNotice'       => $noticeCms,
                    'siteCmsList'      => $cmsPages,
                    'siteDistricts'    => $layoutDistricts,
                    'siteCategories'   => $layoutCategories,
                ]);
            });
        } catch (\Throwable $e) {
            // Silently handle exceptions in CLI / migration environments
        }
    }
}

