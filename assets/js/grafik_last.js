window.warna = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};
var currentpage = window.location.pathname.split('/')[2];
// alert(currentpage);
function tampilkan_grafik(){
	var ctx = document.getElementById("grafikdapil");
	// console.log("hiya hiya");
	var xwz = $.ajax({
		url 	: 	base_urlx + 'grafik/grafik/',
		method 	: 'GET',
		success : function(data){
			var caleg = [];
			var suara = [];
			var datay = JSON.parse(data);
			// console.log(datay);
			// console.log(datay["suara"]);
			for (i in datay['no_urut']){
				// console.log(i);
				caleg.push(datay['no_urut'][i]);
				suara.push(datay['suara'][i]);
				// suara.push(datay[i].suara);
			}
			// nama  = ['sate','dua','tiga','empat','lima','enam','tujuh','delapan'];
			// suarax = [1,9,3,5,7,2,7,1];
			// console.log(caleg);
			// console.log(suara);
			var datagrafik = {
				labels : caleg,
				datasets : [
					{
						label: 'Perhitungan Suara',
			            backgroundColor: window.warna.red,
			            borderColor: 'rgba(200, 200, 200, 0.75)',
			            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
			            hoverBorderColor: 'rgba(200, 200, 200, 1)',
			            data: suara
					}
				]

			}
			return datagrafik;
			// dimulai dari sini

		}
	}); // end of ajax

	console.log(xwz);
	var grafikku = new Chart(ctx, {
		type: 'bar',
		data : xwz
	});

}
tampilkan_grafik();
if(!currentpage){
	// jika halaman dashboard
	// console.log('ada');
	// tampilkan_grafik();
};