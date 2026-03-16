<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;
use App\Models\User;
use App\Models\Category;

class Article extends Model
{
    use Searchable;
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'price', 'category_id', 'user_id', 'revisor_id', 'location'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'reviewed_at'
    ];
    
    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    
    public function revisor(): BelongsTo{
        return $this->belongsTo(User::class, 'revisor_id');
    }
    
    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }
    
    public function setAccepted($value){
        $this->is_accepted = $value;
        $this->revisor_id = auth()->id();
        $this->reviewed_at = now();
        $this->save();
        return true;
    }

    public function getOwner(){
        return User::where('id', $this->user_id)->first();
    }
    
    // funzione per contare gli articoli da revisionare
    public static function toBeRevisedCount()
    {
        // inserire query al DB
        return Article::where('is_accepted', null)->count();
    }   

    public function relatedArticles()
    {
        return $this->hasMany(Article::class, 'category_id', 'category_id')
                    ->where('id', '!=', $this->id)
                    ->limit(5); // Limit the number of related articles
    }
    
    public static function toBeRevisionedCount()
    {
        return self::where('is_accepted', null)->count();
    }
    
    public function toSearchableArray()
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category' => $this->category,           
        ];
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
