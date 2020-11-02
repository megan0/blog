<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1=Category::create([
            'name'=>'News'
        ]);
        $category2=Category::create([
            'name'=>'Design'
        ]);
        $category3=Category::create([
            'name'=>'Partnership'
        ]);

        $author1=User::create([
            'name'=>'Ana',
            'email'=>'ana@gmail.com',
            'password'=>Hash::make('password'),
        ]);
        $author2=User::create([
            'name'=>'Andi',
            'email'=>'and@gmail.com',
            'password'=>Hash::make('password'),
        ]);

        $post1=Post::create([
            'title'=>'We relocated our office to a new designed garage',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            'content'=>'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'category_id'=>$category1->id,
            'image'=>'/1.jpg',
            'user_id'=>$author1->id
        ]);
        $post2=Post::create([
            'title'=>'Top 5 brilliant content marketing strategies',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            'content'=>'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'category_id'=>$category2->id,
            'image'=>'/2.jpg',
            'user_id'=>$author2->id
        ]);
        $post3=Post::create([
            'title'=>'Best practices for minimalist design with example',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            'content'=>'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'category_id'=>$category3->id,
            'image'=>'/4.jpg',
            'user_id'=>$author2->id
        ]);
        $post4=$author2->posts()->create([
            'title'=>'Congratulate and thank to Maryam for joining our team',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.',
            'content'=>'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',
            'category_id'=>$category1->id,
            'image'=>'/6.jpg',

        ]);

        $tag1=Tag::create([
            'name'=>'Record'
        ]);
        $tag2=Tag::create([
            'name'=>'Progress'
        ]);

        $tag3=Tag::create([
            'name'=>'Customers'
        ]);

        $post1->tags()->attach([$tag1->id,$tag2->id]);
        $post2->tags()->attach([$tag1->id]);
        $post3->tags()->attach([$tag3->id]);
        $post4->tags()->attach([$tag1->id]);




        
    }
}
