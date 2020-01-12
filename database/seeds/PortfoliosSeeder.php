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
        File::makeDirectory(storage_path('app/public/' . config('settings.portfolio.logo.path')), '0755', true, true);
        factory(Portfolio::class, 5)->make()->each(function ($portfolio) {
            $fileName = uniqid('') . '.jpg';
            $fileDir = storage_path('app/public/' . config('settings.portfolio.logo.path') . '/' . $fileName);
            copy('https://picsum.photos/' .
                config('settings.portfolio.logo.width') .
                '/' .
                config('settings.portfolio.logo.height')
                , $fileDir);
            $portfolio->image = $fileName;
            $portfolio->save();

            $contents = [];
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $contents[] = factory(PortfolioContent::class)->make(['language' => $localeCode]);
            }

            $portfolio->contents()->saveMany($contents);
        });


    }
}
