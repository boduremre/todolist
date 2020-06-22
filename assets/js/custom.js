/*! Custom.js by mrbdr */

$(function () {
    $('[data-toggle="tooltip"]').tooltip();

    $('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        // other options
    });

    //Datatable
    var table = $('#myTable').DataTable({
        "searching": false,
        "lengthChange": false,
        "ordering": false,
        "pageLength": $(this).data("pagelength"),
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Turkish.json"
        }
    });

    $("#userlogs").hide();
    $(".btn-getUserLogs").click(function (event) {
        event.preventDefault();

        $("#userlogs").hide();
        $("#spanUsername").empty('');
        $("#userlogs tbody").empty();

        var id = $(this).data("user-id");
        var username = $(this).data("username");

        $.ajax(
            {
                type: "GET",
                url: "user/logs/" + id,
                dataType: 'JSON',
                success: function (response) {
                    $("#spanUsername").html(username);
                    $.each(response, function () {
                        $("#userlogs tbody").append("<tr>");
                        $("#userlogs tbody").append("<td>" + this.date + "</td>");
                        $("#userlogs tbody").append("<td>" + this.ip_address + "</td>");
                        $("#userlogs tbody").append("<td>" + this.browser + "</td>");
                        $("#userlogs tbody").append("<td>" + this.platform + "</td>");
                        $("#userlogs tbody").append("<td>" + this.geo_loc + "</td>");
                        $("#userlogs tbody").append("</tr>");
                    });

                    $("#userlogs").show();
                },
                error: function () {
                    iziToast.error({
                        title: 'İşlem Başarısız!',
                        message: 'Bilinmeyen hata meydana geldi!',
                        position: "topCenter"
                    });
                }
            }
        );
    });
});