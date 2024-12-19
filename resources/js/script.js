new DataTable("#dataTable");

var toastMixin = Swal.mixin({
    toast: true,
    icon: "success",
    title: "General Title",
    animation: false,
    position: "top-right",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener("mouseenter", Swal.stopTimer);
        toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
});

const swall = $(".flash-data").data("swall");

if (swall) {
    toastMixin.fire({
        animation: true,
        title: swall,
    });
}

const error = $(".flash-data").data("error");
if (error) {
    Swal.fire({
        title: "Woops",
        text: error,
        icon: "error",
    });
}

$(".show-confirm").click(function (event) {
    var form = $(this).closest("form");
    event.preventDefault();
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Data yang dihapus tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Hapus!",
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
