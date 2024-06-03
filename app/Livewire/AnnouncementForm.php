<?php

namespace App\Livewire;

use Livewire\Component;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Announcement;
use Livewire\WithFileUploads;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\GoogleVisionLabelImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AnnouncementForm extends Component
{
    use WithFileUploads;

    public $title;
    public $subtitle;
    public $price;
    public $body;
    public $category_id;
    public $imgs = [];
    public $temporary_imgs;

    protected $rules = [
        'title' => 'required|min:5',
        'subtitle' => 'required|min:5',
        'price' => 'required|numeric|min:1',
        'body' => 'required|min:15',
        'category_id' => 'required|exists:categories,id', // Limit image size to 1MB

    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }




    public function updatedTemporaryImgs()
    {
        if (
            $this->validate([
                'temporary_imgs.*' => 'image|max:1024',
                'temporary_imgs' => 'max:6',
            ])
        ) {
            foreach ($this->temporary_imgs as $img) {
                $this->imgs[] = $img;
            }
        }
    }
    public function removeImg($key)
    {
        if (in_array($key, array_keys($this->imgs))) {
            unset($this->imgs[$key]);
        }
    }

    public function save()
    {

        $this->validate();
        $this->announcement = Announcement::create([
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'body' => $this->body,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'user_id' => Auth::id(),
        ]);
        if (count($this->imgs) > 0) {
            foreach ($this->imgs as $img) {
                $newFileName = "announcements/{$this->announcement->id}";
                $newImage = $this->announcement->images()->create(['path' => $img->store($newFileName, 'public')]);
                // dispatch(new ResizeImage($newImage->path, 300, 300));
                // dispatch(new ResizeImage($newImage->path, 300, 300)));
                RemoveFaces::withChain([
                    new ResizeImage($newImage->path, 600, 600),
                    new GoogleVisionSafeSearch($newImage->id),
                    new GoogleVisionLabelImage($newImage->id)
                ])->dispatch($newImage->id);
            }
        } else {
            $this->announcement->images()->create(['path' => 'public/img/annunciodefault.jpg']);
        }
        File::deleteDirectory(storage_path('/app/livewire-tmp'));


        return redirect()->route('home')->with('message', __('ui.Annuncio approvato'));
    }



    public function render()
    {
        return view('livewire.announcement-form');
    }
}
