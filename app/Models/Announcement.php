<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [

        'title',
        'subtitle',
        'body',
        'price',
        'user_id',
        'category_id'
    ];

    public function toSearchableArray()
    {
        return[
            'id'=> $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'body' => $this->body,
            'price' => $this->price,
            'user' => $this->user,
            'category' => $this->category,
        ];
    }


    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function setAccepted($value)
    {
        $this->is_accepted = $value;
        $this->save();
        return true;
    }

    public function setUpdated(){
        $this->updated_at = Carbon::now();
        $this->save();
        return true;
    }

    public static function toBeRevisedCount(){
        return Announcement::where('is_accepted', null)->count();
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

}
