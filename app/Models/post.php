<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class post extends Model
{
    use HasFactory;
    use Sluggable;

    // protected $fillable = ['title', 'excerpt', 'body'];

    //yang tidak bolerh diisi
    protected $guarded = ['id'];
    protected $with = ['author', 'category'];

    public function scopeFilter($query, array $filters)
    {
       
        // if (request('search')) {
        //     $query->where('title', 'like', '%' . request('search') . '%' )
        //         ->orWhere('body', 'like', '%' . request('search') . '%' );
        // }

        // if (isset ($filters['search']) ? $filters['search'] : false ) {
        //     return $query->where('title', 'like', '%' .$filters['search'] . '%' )
        //         ->orWhere('body', 'like', '%' .$filters['search'] . '%' );
        // }

        // $query->when($filters['search'] ?? false , function($query, $search)
        // {
        //     return $query->where('title', 'like', '%' . $search . '%' )
        //                 ->orWhere('body', 'like', '%' . $search . '%' );
        // });

        $query->when($filters['search'] ?? false, function($query, $search) {
            return $query->where(function($query) use ($search) {
                 $query->where('title', 'like', '%' . $search . '%')
                        ->orWhere('body', 'like', '%' . $search . '%');
             });
         });
        
        $query->when($filters['category'] ?? false, function($query, $category)
        {
            // join table category
            //whereHas = method laravel
            // ambil query yang mempunyai relationship belongsTo 'namaFunction'
            return $query->whereHas('category', function($query) use ($category)
            // pakai use karena category yg digunakan === category yang di callback sebelumnya
            {
                $query->where('slug', $category);
            });
        });

        $query->when($filters['author'] ?? false, function($query, $author)
        {
            return $query->whereHas('author', function($query) use ($author)
            {
                $query->where('username', $author);
            });
        });
    }

    // nama method nya harus sama dengan nama model yang dituju

    // satu post hanya bisa memiliku satu category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // bacanya dari post dulu jadi,
    // satu post hanya bisa dimiliki ole satu user
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Ini agar tiap router mencarinya bukan ID tpi jadi slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
