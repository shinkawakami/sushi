<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'image',
        'date',
        'category_id',
        'prefecture_id',
        'cost_id',
        'image_url', 


    ];

    public function getPaginateByLimit(int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        //return $this::with(['category', 'cost', 'prefecture'])->orderBy('updated_at', 'DESC')->paginate($limit_count);
    
        $prefecture_id = request('prefecture'); // ユーザーID
        $cost_id = request('cost'); // カテゴリーID
        
        return $this::with('prefecture', 'cost')
            ->when($prefecture_id, function ($query) use ($prefecture_id) {
                return $query->whereHas('prefecture', function ($query) use ($prefecture_id) {
                    $query->where('id', $prefecture_id);
                });
            })
            ->when($cost_id, function ($query) use ($cost_id) {
                return $query->whereHas('cost', function ($query) use ($cost_id) {
                    $query->where('id', $cost_id);
                });
            })
            ->orderBy('updated_at', 'DESC')
            ->paginate($limit_count);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function prefecture()
    {
        return $this->belongsTo(Prefecture::class);
    }
    
    public function cost()
    {
        return $this->belongsTo(Cost::class);
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
