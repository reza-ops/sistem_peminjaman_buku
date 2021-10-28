$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.form-global-handle').submit(function (event) {
        event.preventDefault();
        // var title = global_locale == 'en' ? 'Are you sure?' : 'Apakah anda yakin?';
        // var mes = global_locale == 'en' ? 'Are you sure untuk melanjutkannya?' : 'Apakah anda yakin untuk melanjutkan?';
        var title = 'Apakah anda yakin ?'
        var mes = 'Apakah anda yakin untuk melanjutkannya ?'
        Swal.fire({
            title: title,
            text: mes,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes',
        }).then((result) => {
            $('body').css('padding', '0');
            if (result.value) {
                $.blockUI();

                $(this).off('submit').submit();
            }
        });
    });
    $('.form-global-handle-transfusi').submit(function (event) {
        event.preventDefault();
        // var title = global_locale == 'en' ? 'Are you sure?' : 'Apakah anda yakin?';
        // var mes = global_locale == 'en' ? 'Are you sure untuk melanjutkannya?' : 'Apakah anda yakin untuk melanjutkan?';
        var title = 'Apakah anda yakin ?'
        var mes = 'jika anda melakukan pembatalan, maka ada biaya ?'
        Swal.fire({
            title: title,
            text: mes,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#DD6B55',
            confirmButtonText: 'Yes',
        }).then((result) => {
            $('body').css('padding', '0');
            if (result.value) {
                $.blockUI();

                $(this).off('submit').submit();
            }
        });
    });

});
