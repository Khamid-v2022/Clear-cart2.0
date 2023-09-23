const SwalModal = (icon, title, html) => {
    Swal.fire({
        icon,
        title,
        html
    })
}

const SwalErrorModal = (icon, title, html) => {
    Swal.fire({
        icon: 'error',
        title: 'title',
        text: html,
    })
}

const SwalConfirm = (icon, title, html, confirmButtonText, method, params, callback) => {
    Swal.fire({
        icon,
        title,
        html,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText,
        reverseButtons: true,
    }).then(result => {
        if (result.value) {
            return livewire.emit(method, params)
        }

        if (callback) {
            return livewire.emit(callback)
        }
    })
}

const SwalAlert = (icon, title, timeout = 3000) => {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: timeout,
        onOpen: toast => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon,
        title
    })
}

const ShowAlert = (message) => {
    // Set the options that I want
    toastr.options = {
        "closeButton": true,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    toastr.success(message);
}

document.addEventListener('DOMContentLoaded', () => {
    this.livewire.on('showSuccessMsg', message => {
        if (message != "") {
            ShowAlert(message)
        }
    });

    this.livewire.on('swal:modal', data => {
        SwalModal(data.icon, data.title, data.text)
    })

    this.livewire.on('swal:confirm', data => {
        SwalConfirm(data.icon, data.title, data.text, data.confirmText, data.method, data.params, data.callback)
    })

    this.livewire.on('swal:alert', data => {
        SwalAlert(data.icon, data.title, data.timeout)
    })
})