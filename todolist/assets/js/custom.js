/*! Custom.js by mrbdr */

$(function () {
    //Tooltip açıldığında confimation çalışmıyor. Kapalı kalsın...
    //$('[data-toggle="tooltip"]').tooltip();

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
/*
    $('#logTable').DataTable( {
        "searching": false,
        "lengthChange": false,
        "ordering": false,
        "pageLength": $(this).data("pagelength"),
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Turkish.json"
        }
        //dom: 'Bfrtip',
        /*buttons: [
			  'excel', 'pdf'
            //'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } ); */

    //Switchery
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {color: '#dc3545', secondaryColor: '#64bd63'}); //size: 'small'
    });

    //Switchery checked/unchecked ile güncelleme
    $("body").on("change", ".js-switch", function () {
        var completed = $(this).prop("checked");
        var url = $(this).data("url");

        $.post(url, {"completed": completed}, function (response) {
            showMessageWithTimerThenReload("Yapılacak iş yapıldı olarak işaretlendi!");
        });
    });

    /*$('[data-toggle=confirmation]').confirmation({
        rootSelector: '[data-toggle=confirmation]',
        // other options
    });*/

	    $('#myTable > tbody > tr').click(function () {			
			$('tr.rowmenu').remove();
			var row_index = $(this).index();
					$('tr.rowmenu').remove();
									
				var islem_id = $('#myTable > tbody > tr').eq(row_index).data("gorev-id");

				$('#myTable > tbody > tr').eq(row_index).after('<tr class="rowmenu"><td class="clearfix" colspan="5"><a href="javascript:deleterecord('+islem_id+')" class="btn btn-sm btn-danger" >Sil</a></td></tr>');				
				
        });
});

function deleterecord(id) {
	var content = id + " id numaralı kayıt başarılı bir şekilde silindi.";
	var url = $('#deleteurl').data("url");	
    $.post(url, {"id": id}, function (response) {
        showMessageWithTimerThenReload(content);
    });
}



function showMessage(title, content, icon = "success") {
    swal(title, content, icon);
}

function showMessageWithTimerThenReload(message, pTimer = 1500) {
    swal(message, {
        buttons: false,
        timer: 1200,
        closeOnEsc: false,
        closeOnClickOutside: false,
    }).then(function () {
        location.reload();
    });
}

