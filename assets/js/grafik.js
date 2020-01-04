window.warna = {
	red: 'rgb(255, 99, 132)',
	orange: 'rgb(255, 159, 64)',
	yellow: 'rgb(255, 205, 86)',
	green: 'rgb(75, 192, 192)',
	blue: 'rgb(54, 162, 235)',
	purple: 'rgb(153, 102, 255)',
	grey: 'rgb(201, 203, 207)'
};

function grafik(settingx){
	var datagrafik;
	$.ajax({
		url 	: 	base_urlx + 'grafik/grafik/',
		method 	: 'POST',
		data 	: {id_dapil : + settingx.id_dapil},
		async: false,
		success : function(data){
			var caleg = [];
			var suara = [];
			var datay = JSON.parse(data);
			for (i in datay['no_urut']){
				caleg.push(datay[settingx.tampil][i]);
				suara.push(datay['suara'][i]);
			}
			datagrafik = {
				labels : caleg,
				datasets : [
					{
						// label: 'Perhitungan Suara',
			            // backgroundColor: [window.warna.red],
			            backgroundColor : ['rgba(255, 99, 132, 01)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
							'rgba(153, 102, 255, 1)',
							'rgba(255, 159, 64, 1)',
							'#009f9d',
							'#fffe9a',
							'#dcaee8',
							'#fa86be',
							'#c6e377',
							'#96dae4'],
			            borderColor: 'rgba(200, 200, 200, 0.75)',
			            borderWidth: 1,
			            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
			            hoverBorderColor: 'rgba(200, 200, 200, 1)',
			            data: suara
					}
				]
			};
			// return datagrafik;
			//
 		}

	}); // end of ajax
	return datagrafik;
	
}
function barx(namaid, id_dapil){
	var settingx = {tampil: "no_urut", id_dapil: id_dapil};
	var datagrafik = grafik(settingx);
	// console.log(datagrafik);
	var xxxx = $("#" + namaid);
	var	barGraph = new Chart(xxxx, {
		type: 'bar',
		data: datagrafik,
		options: {
	        legend: {
	            display: false
	        },
	       
    	},
	});
	// perdapil
	
}
function piex(namaid, id_dapil){
	var settingx = {tampil: "nama", id_dapil: id_dapil};
	var datagrafik = grafik(settingx);

	var dapil = $(namaid);
	var dapilGraph = new Chart(dapil, {
		type: 'pie',
		data: datagrafik,
		options: {
			legend: {
				position: 'left'
			}
		}
	});
}
var currentpage = window.location.pathname.split('/')[2];
if(!currentpage){
	// grafik();
	if($("#infohalaman").length){
		// alert("ada")
		var info = $("#infohalaman");
		var jumlah = info.attr("data-jumlahdapil");
		console.log(jumlah);
		var i;
		for (x = 1; x <= jumlah; x++) {
			// console.log("i yg ke " + x);
			// $(".grafikdapil")
			piex(".grafikdapil" + x,x);				
			
		}
	}else{
		barx("grafikdapil",1);
	}
	// piex(".grafikdapil2",);
	// $(".grafikdapil").hide(1000);
	// document.getElementById("#perdapil")
};

Chart.plugins.register({
  afterDatasetsDraw: function(chartInstance, easing) {
    // To only draw at the end of animation, check for easing === 1
    var ctx = chartInstance.chart.ctx;
    chartInstance.data.datasets.forEach(function(dataset, i) {
      var meta = chartInstance.getDatasetMeta(i);
      if (!meta.hidden) {
        meta.data.forEach(function(element, index) {
          // Draw the text in black, with the specified font
          ctx.fillStyle = 'white';
          var fontSize = 12;
          var fontStyle = 'normal';
          var fontFamily = 'Helvetica Neue';
          ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);
          // Just naively convert to string for now
          var dataString = dataset.data[index].toString();
          // Make sure alignment settings are correct
          ctx.textAlign = 'center';
          ctx.textBaseline = 'middle';
          var padding = 5;
          var position = element.tooltipPosition();
          if(parseInt(dataString) > 0){
	          ctx.fillText(dataString, position.x, position.y - (fontSize / 2) - padding);
          }
        });
      }
    });
  }
});
