<?php

use App\Models\Menu;
use App\Models\Page;
use App\Models\PageContent;
use Illuminate\Database\Seeder;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        factory(Page::class, 5)->make()->each(function ($page) use ($faker) {
            $page->path = $faker->unique()->regexify('[a-z]{4,10}');
            $page->save();
            $contents = [];
            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
                $contents[] = factory(PageContent::class)->make(['language' => $localeCode]);
            }
            $page->contents()->saveMany($contents);

            (new Menu([
                'path' => '/' . $page->path,
                'active_path' => '/' . $page->path,
                'title' => $faker->unique()->word(),
                'fa_code' => 'fas fa-address-card',
            ]))->save();
        });
    }
}
