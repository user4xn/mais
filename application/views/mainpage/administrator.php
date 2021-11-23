<style type="text/css">
	body, html{
		background: url(<?php echo base_url('assets/css/imgcss/bg.png') ?>);
	}
</style>
<script src="<?php echo base_url('assets/') ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
window.onload = startTime;
function startTime() {
    var today = new Date();
    var hr = today.getHours();
    var min = today.getMinutes();
    var sec = today.getSeconds();
    ap = (hr < 12) ? "<span>AM</span>" : "<span>PM</span>";
    hr = (hr == 0) ? 12 : hr;
    hr = (hr > 12) ? hr - 12 : hr;
    //Add a zero in front of numbers<10
    hr = checkTime(hr);
    min = checkTime(min);
    sec = checkTime(sec);
    document.getElementById("clock").innerHTML = hr + ":" + min + ":" + sec + " " + ap;
    
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    var curWeekDay = days[today.getDay()];
    var curDay = today.getDate();
    var curMonth = months[today.getMonth()];
    var curYear = today.getFullYear();
    var date = curWeekDay+", "+curDay+" "+curMonth+" "+curYear;
    document.getElementById("date").innerHTML = date;
    
    var time = setTimeout(function(){ startTime() }, 500);
}
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

$(document).ready(function(){


	$('#btn-arclass').click(function(){
		var btn = $('#btn-arclass').val();
		
		if (btn == 0) {
		
		$('#panel').removeClass('d-none');
		$('#panel').removeClass('d-md-none');
		$('#panel').addClass('d-block');
		setTimeout(
		function(){
		$('#btn-arclass').css('left',10);
		$('#btn-arclass').css('border-radius','30px');
		$('#btn-arclass').removeClass('ti-arrow-right');
		$('#btn-arclass').addClass('ti-close');
		 }, 300);
		$(this).val('1');
		
		}else{
		
		$('#panel').removeClass('d-block');
		$('#panel').addClass('d-none');
		$('#panel').addClass('d-md-none');
		setTimeout(
		function(){
		$('#btn-arclass').css('left',0);
		$('#btn-arclass').css('border-top-left-radius','0px');
		$('#btn-arclass').css('border-bottom-left-radius','0px');
		$('#btn-arclass').removeClass('ti-close');
		$('#btn-arclass').addClass('ti-arrow-right');
		 }, 100);
		$(this).val('0');

		}

	});

	loadData();

	var tid = setInterval(refreshRecent, 2000);
	function refreshRecent() {
	loadData();
	}

	function loadData(){
       
       $.ajax({
         url: '<?=base_url()?>AdminControl/load_recent',
         type: 'get',
         dataType: 'json',
         success: function(response){
         setData(response.result, response.total, response.t_visitor);
         },error: function(XMLHttpRequest, textStatus, errorThrown) {
          console.log('Data Not Found', textStatus, errorThrown);
       	 }   
       });

    }

    function setData(result, total, t_visitor){
       $('#datatable', 'div').empty();

       $('#total_visitor h1').empty();
       var tr2 = total;
       $('#total_visitor h1').append(tr2);

       $('#today_visitor h1').empty();
       var tr3 = t_visitor;
       $('#today_visitor h1').append(tr3);

       for(index in result){
        var nama                = result[index].nama;
        var created_at          = result[index].created_at;
        var foto_64             = result[index].foto_64;
        var id                  = result[index].id;
        var ket                 = result[index].ket;
        var no_telp             = result[index].no_telp;
          
        var tr = "<div class='col-md-3'>";
		    tr += "<img style='width: 100%;border-radius:20px;	' src='data:image/jpeg;base64,"+foto_64+"'>";
		    tr += "</div>";
			tr += "<div class='col-md-9 '>";
		    tr += "<table class='table bordered' style='width: 100%'>";
		    tr += "<tr>";
		    tr += "<td class='p-1'>Name </td>";
		    tr += "<td class='p-1'> : </td>";
		    tr += "<td class='p-1'>"+nama+"</td>";
		    tr += "</tr>";
		    tr += "<tr>";
		    tr += "<td class='p-1'>Phone Number </td>";
		    tr += "<td class='p-1'> : </td>";
		    tr += "<td class='p-1'> "+no_telp+"</td>";
		    tr += "</tr>";
		    tr += "<tr>";
		    tr += "<td class='p-1'>Time Visit</td>";
		    tr += "<td class='p-1'> : </td>";
		    tr += "<td class='p-1'>"+created_at+"</td>";
		    tr += "</tr>";
		    tr += "<tr>";
			tr += "<td class='p-1'>Annotation</td>";
			tr += "<td class='p-1'> : </td>";
			tr += "<td class='p-1'> </td>";
			tr += "</tr>";
			tr += "<tr>";
			tr += "<td colspan='3' class='p-1'> "+ket+" </td>";
			tr += "</tr>";
			tr += "</table>";
			tr += "</div>";
        $('#datatable', 'div').append(tr);

        }
     }
});

</script>
	
<div class="row col-md-12 shadow-dan border p-2 animated slideInDown m-0" style="position: fixed;background: #fff;z-index: 9">
	<div class="col d-none d-sm-block navbar border clock-dan"><b id="date"></b> - <b id="clock"></b></div>
	<div class="col d-none d-md-none d-xl-block d-sm-block v-center navbar border pull-right title-dan">Mardizu Sejahtera</div>
	<div class="col navbar border pull-right profile-dan"><i class="ti ti-crown"></i>Hai, <?php echo ucwords($this->session->userdata('nama')) ?> <a href="<?php echo site_url('AdminControl/logout') ?>" class="btn btn-outline-primary">Logout</a></div>
</div>
<div class="w-100 container-fluid" style="padding-top: 80px;">
	<div class="pt-3 contanier" style="display: flex;justify-content: space-around;align-items: flex-start;">

	<button value="0" id="btn-arclass" class="btn btn-primary d-xl-none d-block d-md-block d-sm-none animated slideInLeft ti ti-arrow-right" style="border-bottom-left-radius: 0;border-top-left-radius: 0;line-height: 20px;border-top-right-radius: 15px;border-bottom-right-radius: 15px;position: fixed;left:0;z-index: 19"></button>

		<div id="panel" class="col d-none d-xl-block d-md-none d-sm-block animated fadeInLeft" style="position: fixed;z-index: 9;">
			<div class="card shadow-dan bg-white" style="width: 200px;position: fixed;border-radius: 35px;opacity: 0.9;">
				<div class="card-body">
					<ul style="display: block;">
						<li class="m-3"><a href="<?php echo site_url("AdminControl") ?>"><i class="ti ti-dashboard mr-3"></i> Dashboard </a></li>
						<li class="m-3"><a href="<?php echo site_url("AdminControl/datacenter") ?>"><i class="ti ti-search mr-3"></i> Data Search </a></li>
						<li class="m-3"><a href=""><i class="ti ti-settings mr-3"></i> Settings </a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="col-2 d-none d-xl-block d-md-none d-sm-block"></div>
		<div class="col" style="height: 100vh;">
			
			<div class="row">
				<div class="col-md-6 col-xl-3 mb-2 col-lg-4 d-lg-block animated fadeInUp">
					<div class="card shadow-dan" style=" border-radius: 35px;color: #555">
						<div class="card-body" id="today_visitor">
							<i class="ti ti-more-alt pull-right" style="font-size: 60px;"></i>
							<h1>-</h1>
							Today Visitor
						</div>
					</div>
				</div>
				<div class="col-md-6 col-xl-3 d-xl-block col-lg-4 d-lg-block d-none d-md-block d-sm-block mb-2 animated fadeInUp">
					<div class="card shadow-dan" style=" border-radius: 35px;color: #555">
						<div class="card-body" id="total_visitor">
							<i class="ti ti-info-alt pull-right" style="font-size: 60px;"></i>
							<h1>42</h1>
							Total Visitor
						</div>
					</div>
				</div>
				<div class="col-md-3 col-xl-3 d-xl-block col-lg-4 d-lg-block d-none d-md-none d-sm-block mb-2 animated fadeInUp">
					<div class="card shadow-dan" style=" border-radius: 35px;color: #555">
						<div class="card-body">
							<i class="ti ti-more-alt pull-right" style="font-size: 60px;"></i>
							<h1>-</h1>
							unavailable
						</div>
					</div>
				</div>
				<div class="col-md-3 d-xl-block d-none d-md-none d-sm-block mb-2 animated fadeInUp">
					<div class="card shadow-dan" style=" border-radius: 35px;color: #555">
						<div class="card-body">
							<i class="ti ti-cloud-up pull-right" style="font-size: 60px;"></i>
							<h1>-</h1>
							unavailable
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12 mt-4 animated fadeInUp">
					<div class="card shadow-dan" style="border-radius: 35px; min-height: 65vh">
						<div class="card-body">
							<div class="h1 mb-5" style="color: #555">
								Recent Visitor
							</div>
							<div class="row" id="datatable">
								
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>