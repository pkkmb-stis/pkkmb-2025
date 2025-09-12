<?php

namespace App\Livewire\Home\Profil;

use Livewire\Component;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Support\Facades\Hash;

class Password extends Component
{
    use PasswordValidationRules;

    public  $password_lama;
    public  $password_baru;
    public  $password_baru_confirmation;

    /**
     * resetAll inputan
     *
     * @return void
     */
    private function resetAll()
    {
        $this->reset('password_lama', 'password_baru', 'password_baru_confirmation');
    }

    /**
     * ubahPassword
     *
     * @return void
     */
    public function ubahPassword()
    {
        $this->validate([
            'password_lama' => 'required',
            'password_baru' => $this->passwordRules(), // aturan dari jetstraam kayaknya
        ]);

        // cek apakah password lamanya benar atau tidak
        if (Hash::check(md5($this->password_lama), auth()->user()->password)) {
            try {
                auth()->user()->update(['password' => Hash::make(md5($this->password_baru))]);
                $this->dispatch('updated', 
                    title: "Password berhasil diubah", 
                    icon: 'success', 
                    iconColor: 'green'
                );
            } catch (\Throwable $th) {
                $this->dispatch('updated', 
                    title: "Gagal mengubah password", 
                    icon: 'error', 
                    iconColor: 'red'
                );
            }
            $this->resetAll();
        } else
            $this->addError('password_lama', 'Password lama tidak sesuai');
    }


    public function render()
    {
        if (count($this->getErrorBag()->all()) > 0)
            $this->resetAll();

        return view('home.profil.password');
    }
}
