function convertx(data){
	// convert object to array
	if(data == 'undefined'){
		return null;
	}
	var result = Object.keys(data).map(function(key) {
  		return [Number(key), data[key]];
	});
	return result;
}
function waktu(){
	var tgl = new Date();
	setTimeout("waktu()",60000);
    // document.getElementById("jam").innerHTML = tgl.getHours() + ' : ' + tgl.getMinutes() + ' : ' + tgl.getSeconds();
    document.getElementById("jam").innerHTML = tgl.getHours() + ' : ' + tgl.getMinutes();

}

function readURL(input) {
	// bagian form input file
	// ketika input file di klik maka akan berubah
	if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	            $('#img-upload').attr('src', e.target.result);
	        }
	        
	        reader.readAsDataURL(input.files[0]);
	 }
}
function kembalikanFormatForm(id, halaman){
	if(id){
		// edit
		$("#formx").attr("action", halaman + '/edit');
		$(".modal-title").text("Ubah " + halaman);
	}else{
		// tambah
		document.getElementById("formx").reset();
		$("#formx").attr("action", halaman + '/tambah');
		$(".modal-title").text("Tambah " + halaman);
	}
}

function pesan(isi = 'berhasil',status = 'success'){
	// status = warning, success
	Swal.fire({
  		// position: 'top-end',
  		type: status,
  		title: isi,
  		showConfirmButton: false,
  		timer: 1500
	});
	if(status == 'success'){
		 setTimeout(location.reload(), 5000);
	}
}
function hapus(linkx){
	$.ajax({
		url: linkx
	}).done(function(data){
		console.log(data)
	});
	// alert($(this).attr("href"));
	// return false;
}
function sweethapus(link){
	Swal.fire({
	  title: 'Ingin menghapus data ?',
	  text: "Apakah anda yakin akan menghapus data ini",
	  type: 'warning',
	  // width: 600,
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Iya, Hapus',
	  cancelButtonText: 'Tidak, Batal!'
  
	}).then((result) => {
	  if (result.value) {
	  	hapus(link);
  		Swal.fire({
	      title: 'Telah dihapus',
	      text:'Berhasil menghapus data'+ link,
	      type: 'success'
    	}).then(function(){
    		location.reload();
    	})

	  }
	})
}
function harusangka(){
	// var a = document.getElementById("jumlahtpsxx").value();
	// alert("sate");
	return false;
}