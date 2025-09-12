<?php

namespace App\Livewire\Admin\Informasi\Pengumuman;

use Livewire\Component;
use App\Models\Publishable;
use Livewire\WithFileUploads;
class Add extends Component
{
    use WithFileUploads;

    public $title;
    public $content;
    public $publish_datetime;
    public $isModalOpen = false;
    public $image;
    public $rand;

    public function resetForm()
    {
        $this->rand++;
    }

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'publish_datetime' => 'required|date_format:Y-m-d H:i:s',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    /**
     * closeModal add pengumuman
     *
     * @return void
     */
    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->reset('title', 'content', 'publish_datetime', 'image');
        $this->resetValidation();
    }

    /**
     * add new pengumuman
     *
     * @return void
     */
public function submit()
{
    $this->validate();

    if (!userHasPermission(PERMISSION_ADD_PENGUMUMAN)) {
        $this->dispatch('updated', 
            title: 'Kamu tidak memiliki akses untuk menambah pengumuman', 
            icon: 'error', 
            iconColor: 'red'
        );
        return;
    }

    try {
        $data = [
            'title' => $this->title,
            'content' => $this->content,
            'publish_datetime' => $this->publish_datetime,
            'category' => 1,
        ];

        if ($this->image) {
            // Simpan gambar di folder public/uploads
            $filename = sha1(uniqid(mt_rand(), true)) . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('images/upload-pengumuman', $filename, 'public');
            $data['image'] = $filename;
        }

        Publishable::create($data);
        
        $this->closeModal();
        
        $this->dispatch('updated', 
            title: 'Berhasil Menambahkan Pengumuman', 
            icon: 'success', 
            iconColor: 'green'
        );
        
        $this->resetForm();
        $this->dispatch('reloadTable');
        
    } catch (\Exception $e) {
        $this->dispatch('updated', 
            title: $e->getMessage(), 
            icon: 'error', 
            iconColor: 'red'
        );
    }
}

    public function render()
    {
        return view('admin.informasi.pengumuman.add');
    }
}