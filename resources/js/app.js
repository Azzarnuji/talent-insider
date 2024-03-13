import './bootstrap';
window.askBeforeExecution = function (message, callback) {
    Swal.fire({
        icon: 'info',
        text: message,
        showCancelButton: true,
        confirmButtonText: "Ok",
    }).then((result) => {
        if (result.isConfirmed) {
            callback();
        }
    });
}
