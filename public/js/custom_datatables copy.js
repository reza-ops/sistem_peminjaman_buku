"use strict";
// Class definition

var global = function () {
    // Private functions

    // basic demo
    var datatablenya = function (id_datatable, url_ajax, column) {

        var datatable = $(id_datatable).DataTable({
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                paginate: {
                    next: '<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
                    previous: '<span><i class="fa fa-angle-left" aria-hidden="true"></i></span>'
                }
            },
            // createdRow: function (row, data, dataIndex) {
            //     // $(row).find('td').addClass('text-left');
            // },
            processing: true,
            serverSide: true,
            ajax: url_ajax,
            columns: column
        });

        $(id_datatable).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var el = this;
            var route = $(this).attr("data-route");
            console.log(route);
            Swal.fire({
                title: "Apakah yakin hapus data ini ?",
                text: "Lanjutkan untuk menghapus",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: route,
                        type: 'get', // replaced from put
                        dataType: "JSON",
                        beforeSend: function () {
                            $.blockUI();
                        },
                        success: function (response) {
                            if (response.status == true) {
                                $(id_datatable).DataTable().ajax.reload();
                                swal.fire("Deleted!", response.message, "success");
                            } else {
                                swal.fire("Failed!", response.message, "error");
                            }
                            $.unblockUI();
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                };
            });
        });


    };

    var datatablePost = function (id_datatable, url_ajax, column, param) {
        // console.log(id_datatable)
        // console.log(id_datatable);
        var datatable = $(id_datatable).DataTable({
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                paginate: {
                    next: '<span><i class="fa fa-angle-right" aria-hidden="true"></i></span>',
                    previous: '<span><i class="fa fa-angle-left" aria-hidden="true"></i></span>'
                }
            },
            createdRow: function (row, data, dataIndex) {
                $(row).find('td').addClass('text-left');
            },
            processing: true,
            serverSide: true,
            destroy: true,
            searching: false,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            ajax: {
                url: url_ajax,
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: param,
            },
            columns: column,

        });
        $(id_datatable).css("width", "100%");
        $(id_datatable).addClass("nowrap");
        $("select").removeClass("custom-select-sm");
        $("select").removeClass("custom-select");
        $(id_datatable).on('click', '.btn-delete', function (e) {
            e.preventDefault();
            var el = this;
            var route = $(this).attr("data-route");

            Swal.fire({
                title: "Apakah yakin hapus data ini ?",
                text: "Lanjutkan untuk menghapus",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
            }).then((result) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (result.value) {
                    $.ajax({
                        url: route,
                        type: 'get', // replaced from put
                        dataType: "JSON",
                        beforeSend: function () {
                            $.blockUI();
                        },
                        success: function (response) {
                            if (response.status == true) {
                                $(id_datatable).DataTable().ajax.reload();
                                swal.fire("Deleted!", response.message, "success");
                            } else {
                                swal.fire("Failed!", response.message, "error");
                            }
                            $.unblockUI();
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                };
            });
        });
        $(id_datatable).on('click', '.btn-musnahkan', function (e) {
            e.preventDefault();
            var el = this;
            var route = $(this).attr("data-route");

            Swal.fire({
                title: "Apakah yakin memusnahkan darah ini ?",
                text: "Lanjutkan untuk mengmemusnahkan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
            }).then((result) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (result.value) {
                    $.ajax({
                        url: route,
                        type: 'get', // replaced from put
                        dataType: "JSON",
                        beforeSend: function () {
                            $.blockUI();
                        },
                        success: function (response) {
                            if (response.status == true) {
                                $(id_datatable).DataTable().ajax.reload();
                                swal.fire("Berhasil!", response.message, "success");
                            } else {
                                swal.fire("Gagal!", response.message, "error");
                            }
                            $.unblockUI();
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                };
            });
        });


        $(id_datatable).on('click', '.btn-cancel', function (e) {
            e.preventDefault();
            var el = this;
            var route = $(this).attr("data-route");

            Swal.fire({
                title: "Apakah yakin membatalkan order ini ?",
                text: "Lanjutkan untuk membatalkan",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Yes',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: route,
                        type: 'get', // replaced from put
                        dataType: "JSON",
                        beforeSend: function () {
                            $.blockUI();
                        },
                        success: function (response) {
                            if (response.status == true) {
                                $(id_datatable).DataTable().ajax.reload();
                                swal.fire("Berhasil", response.message, "success");
                            } else {
                                swal.fire("Gagal!", response.message, "error");
                            }
                            $.unblockUI();
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        }
                    });
                };
            });
        });


    };

    return {
        // public functions
        init_datatable: function (id_datatable, url_ajax, column) {
            datatablenya(id_datatable, url_ajax, column);
        },
        init_datatable_post: function (id_datatable, url_ajax, column, param) {
            datatablePost(id_datatable, url_ajax, column, param);
        },
    };
}();
