<?php

use App\Models\Portfolio;
use App\Models\PortfolioContent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class PortfoliosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        File::makeDirectory(storage_path('app/public/' . config('settings.portfolio.images.path')), '0755', true, true);

        factory(Portfolio::class, 5)->make()->each(function ($portfolio) {

            $imgUrl = 'https://picsum.photos/1000/600';
            $portfolio->save();
            $contents = [];
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $contents[] = factory(PortfolioContent::class)->make(['language' => $localeCode]);
            }
            $portfolio->contents()->saveMany($contents);

            $portfolio->addMediaFromUrl($imgUrl)->toMediaCollection('logo');

            $portfolio->addMediaFromUrl($imgUrl)->toMediaCollection('gallery');
            $portfolio->addMediaFromUrl($imgUrl)->toMediaCollection('gallery');

        });


    }

}
