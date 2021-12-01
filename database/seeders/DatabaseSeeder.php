<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\post;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        // User::create([
        //     'name' => 'Puja Maulida Herwanto',
        //     'email' => 'puja.maulida13@gmail.com',
        //     'password' => bcrypt('12345')
        // ]);

        User::create([
            'name' => 'Renjun Huang',
            'username' => 'renjunhuang',
            'email' => 'huangrenjun23@gmail.com',
            'password' => bcrypt('password')
        ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programing',
            'slug' => 'programing',
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design',
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal',
        ]);

        post::factory(20)->create();

        // post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Illum a eum tempora aut vero, fugit harum incidunt soluta architecto totam dolores ipsam mollitia adipisci id.',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita ut natus dolor excepturi provident, at illo dolorum temporibus assumenda perspiciatis laboriosam velit, asperiores facere ratione incidunt minima, alias placeat error nobis autem ipsum eum nulla? Dolor ex obcaecati commodi omnis, ipsum voluptatum, quibusdam numquam illo nam libero maxime possimus est, vitae consequatur totam? Harum ab molestiae minima qui, cumque accusantium provident iure dicta, dolor voluptate aspernatur officiis nemo iusto maxime dolorum. Ex dolore unde repellat omnis atque blanditiis dolorem nesciunt beatae, cum laboriosam corrupti, dolorum fuga cupiditate. Saepe ullam suscipit sequi delectus, nulla, consectetur molestias similique doloribus, nobis repudiandae nihil.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // post::create([
        //     'title' => 'Judul Ke Dua',
        //     'slug' => 'judul-ke-dua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita ut natus dolor excepturi provident, at illo dolorum temporibus assumenda perspiciatis laboriosam velit, asperiores facere ratione incidunt minima, alias placeat error nobis autem ipsum eum nulla? Dolor ex obcaecati commodi omnis, ipsum voluptatum, quibusdam numquam illo nam libero maxime possimus est, vitae consequatur totam? Harum ab molestiae minima qui, cumque accusantium provident iure dicta, dolor voluptate aspernatur officiis nemo iusto maxime dolorum. Ex dolore unde repellat omnis atque blanditiis dolorem nesciunt beatae, cum laboriosam corrupti, dolorum fuga cupiditate. Saepe ullam suscipit sequi delectus, nulla, consectetur molestias similique doloribus, nobis repudiandae nihil.',
        //     'category_id' => 1,
        //     'user_id' => 2
        // ]);

        // post::create([
        //     'title' => 'Judul Ke Tiga',
        //     'slug' => 'judul-ke-tiga',
        //     'excerpt' => 'Illum a eum tempora aut vero, fugit harum incidunt soluta architecto totam dolores ipsam mollitia adipisci id.',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita ut natus dolor excepturi provident, at illo dolorum temporibus assumenda perspiciatis laboriosam velit, asperiores facere ratione incidunt minima, alias placeat error nobis autem ipsum eum nulla? Dolor ex obcaecati commodi omnis, ipsum voluptatum, quibusdam numquam illo nam libero maxime possimus est, vitae consequatur totam? Harum ab molestiae minima qui, cumque accusantium provident iure dicta, dolor voluptate aspernatur officiis nemo iusto maxime dolorum. Ex dolore unde repellat omnis atque blanditiis dolorem nesciunt beatae, cum laboriosam corrupti, dolorum fuga cupiditate. Saepe ullam suscipit sequi delectus, nulla, consectetur molestias similique doloribus, nobis repudiandae nihil.',
        //     'category_id' => 2,
        //     'user_id' => 1
        // ]);

        // post::create([
        //     'title' => 'Judul Ke Empat',
        //     'slug' => 'judul-ke-empat',
        //     'excerpt' => 'Illum a eum tempora aut vero, fugit harum incidunt soluta architecto totam dolores ipsam mollitia adipisci id.',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Expedita ut natus dolor excepturi provident, at illo dolorum temporibus assumenda perspiciatis laboriosam velit, asperiores facere ratione incidunt minima, alias placeat error nobis autem ipsum eum nulla? Dolor ex obcaecati commodi omnis, ipsum voluptatum, quibusdam numquam illo nam libero maxime possimus est, vitae consequatur totam? Harum ab molestiae minima qui, cumque accusantium provident iure dicta, dolor voluptate aspernatur officiis nemo iusto maxime dolorum. Ex dolore unde repellat omnis atque blanditiis dolorem nesciunt beatae, cum laboriosam corrupti, dolorum fuga cupiditate. Saepe ullam suscipit sequi delectus, nulla, consectetur molestias similique doloribus, nobis repudiandae nihil.',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);

    }
}
