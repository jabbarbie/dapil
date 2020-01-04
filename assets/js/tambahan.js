// var base_urlx = "http://localhost/dapil/";
var base_urlx = window.location.origin + "/dapil/";
// alert(base_urlx);
window.setTimeout("waktu()",1000);
$.fn.dataTable.ext.search.push (
		function (settings, data, dataIndex){
			
			console.log("masuk dt");

			if(settings.sTableId == 'table_dt'){
				// console.log("masuk if");
				var id_pencarian = parseInt($("#combocari").children("option:selected").val());
				// var id_dapil = 1;
				// console.log("udah masuk dt " + id_pencarian);
				var id_field  = (data[2]) || 0;	
				// console.log(data[2]);
				// console.log(id_field);
				// console.log(id_dapil);

				if ((id_pencarian == id_field)){
					return true;
				}
			return false;
			}
		else{
			return true;
		}

		}
);
// var table=$('#table_dt');
var dt_laporan = $("#table_js").DataTable({
	"processing": true, //Feature control the processing indicator.
    "serverSide": true, //Feature control DataTables' server-side processing mode.
    "order": [], //Initial no order.

    // Load data for the table's content from an Ajax source
    

    "ajax": {
        "url": base_urlx + "tps/table_laporan",
        "type": "POST",
      //    "data": {
    		// "sate": parseInt($("#combolaporankel").val())
    	 // },
	    "data": function(d) {
	    	return $.extend( {} , d, {
    			"id": parseInt($("#combolaporankel").val())
	    	});
    	},
    },
    "order": [],
    "columnDefs": [{
    	"targets" : [0],
    	"orderable" : false
    }],
    // "pagingType": "simple",
    // "searching": false,
    // "paging": false, 
    // "info": false

});
function ubahlink(){
	var id = parseInt($("#combolaporankel").val());
	if(id > 0){
		$("#btn-report").attr("href", base_urlx + "laporan/rekapsuara/" + id );	
	}
}
$("#table_nosearch").DataTable();
var dt = $('#table_dt').DataTable({
	"columnDefs": [
        {
            "targets": [2],
            "visible": false,
        }
    ],
    "pagingType": "simple"
});
$("#combocari").change( function(){
	dt.draw();

});

$("#combolaporankel").change( function(){
	// console.log($("#combolaporankel").val());
	dt_laporan.draw();
	ubahlink();

})
$("#combocarikecamatan").change(function(){
	var id_kecamatan = $(this).val();
	// alert(id_kecamatan);
	$.ajax({
		url: 	base_urlx + 'kelurahan/carikelurahan/' + id_kecamatan,
		type: "GET",
		dataType: 'json',

		// data: {},
		success: function (data){
			$("#combolaporankel option").remove();
			console.log(data);
			var seleksi = '';
			$.each(data, function(key, value){
				seleksi = '';
				if(key <= 0){
					seleksi = 'selected'
				}
				$("#combolaporankel").append("<option " + seleksi + " value=" + value['id'] + "> " + value['text'] + "</option>");
				$("#btn-report").attr("data-id", value['id']);
			})

		}

	}).done(function(){
		dt_laporan.draw();
		ubahlink();
	});
})
$("#formx").on("submit", function(form){
	// submit form
	form.preventDefault();

	form_data	= $(this).serialize(),
	actionx		= $(this).attr("action");
	console.log(actionx);
	$.ajax({
		url: 	base_urlx + actionx,
		type: "POST",
		data:   new FormData(this),
		// dataType: 'json',

		processData:false,
        contentType:false,
        cache:false,
        async:false,
		
		success: function (data){
			console.log(data);
			if(data.success == true){
				console.log("bisa");

			}else{
				$.each(data.message, function(key, value){
		         var element = $('#x' + key);
		         if(value){
	              element.closest('div.form-group')
		              .removeClass('has-error')
		              .addClass(value.length > 0 ? 'has-error' : 'has-success')
		              .find('.text-danger')
		              .remove();
	              element.after(value);
	          }
				})
			}
		}
	}).done(function(data){
		console.log(data);

		var data = JSON.parse(data);
		console.log(data);
		if(data['success']){
			pesan("Data berhasil disimpan");			
		}else{
			pesan(data['message'], 'error');			
			// console.log("Gagal " + data['message']);
		}
	})
});

// khusus tps 
var IsiAttribute = ['notps', 'idkelurahan'];
$('#table_tps tbody').on('click', '.tubah', function(e){			
// $('[data-target="#formTPS"]').on('click', function(e){
	var $target = $(e.target);
	var modalSelector = $target.data('target');

	var notpsx = ($target.data('notps')),
		idkelurahanx = ($target.data('idkelurahan'));

	//alert(notpsx);
	
	// IsiAttribute.forEach(function (attributeName) {
		
	// 	var $modalAttribute = $(modalSelector + ' #modal-' + attributeName);
	// 	var dataValue = $target.data(attributeName);
	// 	$modalAttribute.text(dataValue || '');
	// });
	
	// var notps1 = $target.data('notps');
	// 	idkelurahanx = $("#idkelurahanx").attr("valx");
	// console.log(notpsx);
	var id_suara = $("#id_suaray").attr("val");
	// var items = [];
	// alert("afa");
	$.ajax({
		url : base_urlx + 'tps/carisuara',
		type: "POST",
		data:   {notps: notpsx, id_suara: id_suara},
		dataType: 'json',

		// processData:false,
        // contentType:false,

		success: function (data){
			console.log(data);
			$("#notpsx").val(notpsx);
			$(".notpsx").html(notpsx);
			// var data = JSON.stringify(data);
			var datax = (data['suara']?convertx(data['suara']):null);
			// var partai = (data['partai']?data['partai']:0);
			// console.log(data['partai']);
			// if (data['suara']){
			// 	var datax = convertx(data[''])
			// }
			if(datax){
				$("form").attr("action","suara/edit");
				$("#id_tps").val(data['id_tps']);
				$("#suara_partai").val(data['partai']);
				$("#suara_tidaksah").val(data['tidaksah']);
			}else{
				$(".xnotps").val(0);
				$("#id_tps").val(0)

				$("form").attr("action","suara/tambah");
			}
			if(data != false){

			// var datax = convertx(data['suara']);
			// if(data['id_tps'] > 0){
			// 	tambah data
			// }else{
			// 	ubah data
			// }


			// console.log(typeof [1,2,3,4,5]);
			// data = convertx(data);
			// alert("Jumlah data array " + datax.length);
			// alert("id tps " + data['id_tps']);
			
			if(parseInt(data['id_tps']))
			$.each(datax, function(key, value){
					console.log(key + ' <= keynya + valuenya => ' + value);
					var no_urut = value[1]['no_urut'];
					var suara = value[1]['suara'];

					var tc = $("#no_urut"+ no_urut);					
					tc.val(suara);
			});

			}
		}
	})
	.done(function(data){
			console.log("done");
			// $("#modal-notps").html(msg);
			// $(".notpsx").val(notps 1);
	});		
});

$('#table_tps tbody').on('click', '.tlapor', function(e){			
	var $target = $(e.target);
	var modalSelector = $target.data('target');
	var notpsx = ($target.data('notps')),
		idkelurahanx = ($target.data('idkelurahan'));
	var id_suara = $("#id_suaray").attr("val"),
		id_dapil = ($target.data('iddapil'));
		// alert(id_dapil);
	console.log(id_dapil);
	// var datanya = array('id_suara' => id_suara,)
	// console.log(id_suara + ' dan ' + idkelurahanx);
	var dataku = {'id_suara': id_suara,
				  'id_kelurahan': idkelurahanx,
				  'no_tps' : notpsx
				 };
	$.ajax({
		url : base_urlx + 'suara/getidtps',
		type: "POST",
		// data:   {id_suara: id_suara, id_kelurahan: idkelurahanx},
		data:   dataku,
		
		// data:   ,

		// dataType: 'json',

		// processData:false,
        // contentType:false,

		success: function (id_tps){

			if(parseInt(id_tps) <= 0){
				// $(".modal-body").hide(200);
				$(".modal-body .laporanTPSx").attr("src","");
			}else{
				$(".modal-body").show(500);				
				var url = base_urlx + 'laporan/tps/' + idkelurahanx + '/' + id_tps + '/' + id_suara + '/' + id_dapil;
				$("#laporanTPS").attr("frameborder",0);
				$(".modal-body .laporanTPSx").attr("src",url);

				$(".btnHapusx").attr("data-link", base_urlx + "suara/hapustps/" + id_tps);
			}
			console.log(url);
			// $("#laporanTPS").attr("src",url);
			// alert(url);

			// console.log(data);
		}
	})
});

// keperluan upload foto 
$(document).on('change', '.btn-file :file', function() {
	var input = $(this),
	label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
	input.trigger('fileselect', [label]);
});
$("#imgInp").change(function(){readURL(this);}); 	

$('.btn-file :file').on('fileselect', function(event, label) {
	var input = $(this).parents('.input-group').find(':text'),
	    log = label;

	if( input.length ) {
	    input.val(log);
	} else {
	    if( log ) alert(log);
	}
});
// end upload foto

$(document).ready( function () {	
	// formModal selain tps
	// $('[data-target="#formModal"]').on('click', function(e){
		$('#table_nosearch tbody, #table_dt tbody').on('click', '.tubah', function(e){			
		// alert("ada");
		// when button click and show modal.. this is hmm
		$(".modal-body").show(200);

		var $target = $(e.target);
		var halaman = ($target.data('halaman')),
			id = parseInt($target.data('id'));
		// $("form").attr("action", halaman + "/edit");
		$("#pk").attr("value", id);
		kembalikanFormatForm(id, halaman);
		// $("#xnama").val(nama);
		// console.log(halaman);
		$.ajax({
			url : base_urlx + halaman +'/modal' + halaman,
			type: "GET",
			data:   {id: id, halaman: halaman },
			dataType: 'json',

			// processData:false,

	        // contentType:false,
			success: function (data){
				// alert("sate");
				// data = convertx(data);
				// console.log(data);
				// console.log("datanya : " + data[0][1]);

				// $("#kecamatan").val(data[1][1]);
				// $("#id_kecamatan").hide(1000);
				var pk = 0,
					id_hal = 'id_' + halaman;
				$.each(data, function(key, value){
					var tc = $("#"+key);					
					console.log(key);

					if(key.substr(0,2) == 'id' && key != id_hal){
						// cari id_halaman selain dari id_primary key (cari fk) 
						pk = value;
					}
					if (tc.length){
						// console.log("ada xx");
						if(tc.is("input")){
							// kalau element yg dimaksud adalah bertipe input
							tc.val(value);
						}else{

							// selain input (combobox)
							tc.val(pk);
						}
					}else{
						// console.log("masuk else");
					}
				})

			}
		}).done(function(){
			// console.log("kelar");
		});
	});
	// select2
	$("#seleksix").select2();
	$(".seleksi").select2({
		placeholder : 'Pilih Kecamatan',
	    // minimumInputLength: 2,
		ajax: {
			url: 	base_urlx + 'kecamatan/carikecamatan',
			dataType: 'json',
			type: 'GET',
			delay: 250,
			data: function(params){
				return {
					search: params.term
				}
			},
			processResults: function(data, page){
				return {
					results: data
				}
			}
		}
	});
	$("#kecamatancb").change(function(){
		var id_kecamatan = $(this).val();
		$(".seleksi2").select2({
			ajax: {
			url: 	base_urlx + 'kelurahan/carikelurahan/' + id_kecamatan,
			dataType: 'json',
			type: 'GET',
			delay: 250,
			data: function(params){
				return {
					search: params.term
				}
			},
			processResults: function(data, page){
				console.log(data);
				return {
					results: data
				}
			}
		}
		});
	})



}); // document on ready

$(".btnHapusx, .btn-hapus").click(function(){
	var link = $(this).attr("data-link");
	sweethapus(link);
})
