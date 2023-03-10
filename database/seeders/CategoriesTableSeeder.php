<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // //---------->  3-USUL
    // Category::create([
    //   [
    //     'name' => 'Мобильные телефоны',
    //     // 'name_en' => 'Mobile phones',
    //     'code' => 'mobiles',
    //     'description' => 'В этом разделе вы найдёте самые популярные мобильные телефонамы по отличным ценам!',
    //     // 'description_en' => 'Mobile phones section with best prices for best popular phones!',
    //     'image' => 'categories/mobile.jpg',
    //   ],
    //   [
    //     'name' => 'Портативная техника',
    //     // 'name_en' => 'Portable',
    //     'code' => 'portable',
    //     'description' => 'Раздел с портативной техникой.',
    //     // 'description_en' => 'Section with portables.',
    //     'image' => 'categories/portable.jpg',
    //   ],
    //   [
    //     'name' => 'Бытовая техника',
    //     // 'name_en' => 'Appliance',
    //     'code' => 'appliances',
    //     'description' => 'Раздел с бытовой техникой',
    //     // 'description_en' => 'Section with appliance',
    //     'image' => 'categories/appliance.jpg',
    //   ]
    // ]);

    Category::create([
      'name' => 'Мобильные телефоны',
      // 'name_en' => 'Mobile phones',
      'code' => 'mobiles',
      'description' => 'В этом разделе вы найдёте самые популярные мобильные телефонамы по отличным ценам!',
      // 'description_en' => 'Mobile phones section with best prices for best popular phones!',
      'image' => 'categories/mobile.jpg',
    ]);

    Category::create([
      'name' => 'Портативная техника',
      // 'name_en' => 'Portable',
      'code' => 'portable',
      'description' => 'Раздел с портативной техникой.',
      // 'description_en' => 'Section with portables.',
      'image' => 'categories/portable.jpg',
    ]);

    Category::create([
      'name' => 'Бытовая техника',
      // 'name_en' => 'Appliance',
      'code' => 'appliances',
      'description' => 'Раздел с бытовой техникой',
      // 'description_en' => 'Section with appliance',
      'image' => 'categories/appliance.jpg',
    ]);

    //---------->  1-USUL
    // DB::table('categories')->insert([
    //   [
    //     'name' => 'Мобильные телефоны',
    //     // 'name_en' => 'Mobile phones',
    //     'code' => 'mobiles',
    //     'description' => 'В этом разделе вы найдёте самые популярные мобильные телефонамы по отличным ценам!',
    //     // 'description_en' => 'Mobile phones section with best prices for best popular phones!',
    //     'image' => 'categories/mobile.jpg',
    //   ],
    //   [
    //     'name' => 'Портативная техника',
    //     // 'name_en' => 'Portable',
    //     'code' => 'portable',
    //     'description' => 'Раздел с портативной техникой.',
    //     // 'description_en' => 'Section with portables.',
    //     'image' => 'categories/portable.jpg',
    //   ],
    //   [
    //     'name' => 'Бытовая техника',
    //     // 'name_en' => 'Appliance',
    //     'code' => 'appliances',
    //     'description' => 'Раздел с бытовой техникой',
    //     // 'description_en' => 'Section with appliance',
    //     'image' => 'categories/appliance.jpg',
    //   ]
    // ]);
  }
}
