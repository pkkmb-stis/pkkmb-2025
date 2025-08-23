import { Notyf } from "notyf";

const notyf = new Notyf({
    duration: 2000
});

Livewire.on("error", message => {
    notyf.error(message);
});

Livewire.on("success", message => {
    notyf.success(message);
});

 window.addEventListener('updated', function(e) {
    Swal.fire({
    icon: e.detail.icon,
    title: e.detail.title,
    iconColor: e.detail.iconColor,
    timer: 3000,
    toast: true,
    position: 'top-right',
    timerProgressBar: true,
    showConfirmButton: true
    })
} )
