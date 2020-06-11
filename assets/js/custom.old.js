/*! Custom.js by mrbdr */

$(function () {
    //Tooltip açıldığında confimation çalışmıyor. Kapalı kalsın...
    $('[data-toggle="tooltip"]').tooltip();
	
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
        } ); 

    //Switchery
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function (html) {
        var switchery = new Switchery(html, {color: '#dc3545', secondaryColor: '#64bd63'}); //size: 'small'
    });

    //Switchery checked/unchecked ile güncelleme
    /*$("body").on("change", ".js-switch", function () {
        var completed = $(this).prop("checked");
        var url = $(this).data("url");
        var itemId = $(this).data("item-id");

        $.post(url, 
			{
				"id": itemId, 
				"completed": completed,
				'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'
			}, 
			function (response) {
				iziToast.success({
					title: 'İşlem Başarılı',
					message: 'Yapılacak iş yapıldı olarak işaretlendi!',
					position : "topCenter"
				});            
			});
	});

    $('#myTable > tbody > tr').click(function () {
        /*$('tr.rowmenu').remove();
        var row_index = $(this).index();
        $('tr.rowmenu').remove();

        var islem_id = $('#myTable > tbody > tr').eq(row_index).data("gorev-id");

        $('#myTable > tbody > tr').eq(row_index).after('<tr class="rowmenu"><td class="clearfix" colspan="5"><a data-toggle="tooltip" title="Sil" href="javascript:deleterecord(' + islem_id + ')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td></tr>');
		
		$(".btn-delete").toggle();

    }); */
});
