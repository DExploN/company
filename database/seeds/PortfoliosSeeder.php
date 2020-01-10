<?php

use Illuminate\Database\Seeder;

class PortfoliosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Portfolio::class, 5)->make()->each(function ($portfolio) {
            $fileName = uniqid('') . '.jpg';
            $fileDir = public_path('storage/' . config('settings.portfolio.logo.path') . '/' . $fileName);
            copy('https://picsum.photos/' .
                config('settings.portfolio.logo.width') .
                '/' .
                config('settings.portfolio.logo.height')
                , $fileDir);
            $portfolio->image = $fileName;
            $portfolio->save();
        });


    }
}
