<?php

use App\Models\Portfolio;
use App\Models\PortfolioContent;
use App\Models\PortfolioImage;
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
        File::makeDirectory(storage_path('app/public/' . config('settings.portfolio.images.path')), '0755', true, true);

        factory(Portfolio::class, 5)->make()->each(function ($portfolio) {

            $portfolio->image = $this->getImage(config('settings.portfolio.logo.path'));
            $portfolio->save();

            $contents = [];
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $contents[] = factory(PortfolioContent::class)->make(['language' => $localeCode]);
            }

            $portfolio->contents()->saveMany($contents);

            $images = [];

            for ($i = 0; $i < 2; $i++) {
                $images[] = new PortfolioImage(['name' => $this->getImage(config('settings.portfolio.images.path'))]);
            }
            $portfolio->images()->saveMany($images);
        });


    }

    private function getImage($path)
    {
        $fileName = uniqid('') . '.jpg';
        $fileDir = storage_path('app/public/' . $path . '/' . $fileName);
        copy('https://picsum.photos/' .
            config('settings.portfolio.logo.width') .
            '/' .
            config('settings.portfolio.logo.height')
            , $fileDir);
        return $fileName;
    }
}
