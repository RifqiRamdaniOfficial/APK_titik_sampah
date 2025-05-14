<?php

namespace App\Models;


class Post
{
    private static $blog_posts = [
        [
            "title" => "Judul Post Pertama",
            "slug" => "judul-post-pertama",
            "author" => "Rifqi Ramdani",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti 
        doloribus qui ad nisi eaque blanditiis aliquid voluptatibus nesciunt eligendi 
        laudantium natus placeat, amet soluta molestiae eveniet officiis, quo dolor id 
        alias quasi ducimus! Natus consectetur, vitae atque enim at ipsum, quasi, 
        inventore ex beatae blanditiis voluptatibus nam sapiente? Quos nisi ad numquam 
        sapiente iusto quo officia deleniti recusandae vitae ea odio commodi quibusdam,
         ducimus dolores id rem atque sequi architecto magni reiciendis. Consectetur 
         quae consequatur exercitationem, iure eveniet nobis alias."
        ],
        [
            "title" => "Judul Post Kedua",
            "slug" => "judul-post-kedua",
            "author" => "Van Hohenhaim",
            "body" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti 
        doloribus qui ad nisi eaque blanditiis aliquid voluptatibus nesciunt eligendi 
        laudantium natus placeat, amet soluta molestiae eveniet officiis, quo dolor id 
        alias quasi ducimus! Natus consectetur, vitae atque enim at ipsum, quasi, 
        inventore ex beatae blanditiis voluptatibus nam sapiente? Quos nisi ad numquam 
        sapiente iusto quo officia deleniti recusandae vitae ea odio commodi quibusdam,
         ducimus dolores id rem atque sequi architecto magni reiciendis. Consectetur 
         quae consequatur exercitationem, iure eveniet nobis alias."
        ],
    ];

    public static function all()
    {
        return collect(self::$blog_posts);
    }

    //masuk ke data singgle data post berdasarkan slug
    public static function find($slug)
    {
        $posts = static::all();
        return $posts->firstWhere('slug', $slug); //menampilakan data berdasarkan slug
    }
}
