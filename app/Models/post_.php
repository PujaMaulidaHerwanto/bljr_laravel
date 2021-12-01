<?php

namespace App\Models;

class post_
{
    private static $blog_posts = [
        [
            "title" => "Judul Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Puja Maulida Herwanto",
            "body" => " "
        ],
        [
            "title" => "Judul Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Pacarnya Renjun",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis quae est animi cum ullam! Tempora ut eos harum, maxime magni modi eum voluptatibus dolorum accusamus ducimus. Quos temporibus tenetur aliquid corporis expedita voluptatibus voluptate, debitis quis. Ea veritatis rerum obcaecati perspiciatis voluptates atque laudantium harum, aperiam quae possimus vel. Veritatis, aliquam laborum? Minima laboriosam explicabo dolor ea, excepturi velit magni animi recusandae. Tempora assumenda suscipit perferendis omnis aut explicabo, impedit dolorem inventore voluptatum minima! Tenetur nesciunt enim reprehenderit fugit similique fugiat, vero laudantium nulla animi ut, quis tempore ducimus magnam. Harum quidem quo neque doloremque iure reprehenderit aut odio nesciunt?"
        ]
    ];

    public static function all()
    {
        // karena tipe nya function static maka harus pakai self::
        return collect(self::$blog_posts);
    }

    public static function find($slug)
    {
        $posts = static::all();

        // $post = [];

        // foreach ($posts as $p ) {
        //     if ($p["slug"] === $slug ) {
        //         $post = $p;
        //     }
        // }

        return $posts->firstWhere('slug', $slug);
    }

}

