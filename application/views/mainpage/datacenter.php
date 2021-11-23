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

function showImage(id){
    window.open('<?php echo base_url()?>AdminControl/showPict/'+id,'popup','width=500,height=600,scrollbars=no,resizable=no'); return false;
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

	$('#pagination').on('click','a',function(e){
       e.preventDefault(); 
       var pagno = $(this).attr('data-ci-pagination-page');
       loadData(pagno);
    });

    loadData(0);

    $('#search_filter_btn').click(function(){
    	loadData(0);
    });

    $('#reset_filter_btn').click(function(){
    	$('#date_key_from').val('');
        $('#date_key_to').val('');
    	loadData(0);
    });

    $('#search_key').keyup(function(){
       loadData(0);
    });

    function loadData(pagno){

       var text = $('#search_key').val();
       var from = $('#date_key_from').val();
       var to   = $('#date_key_to').val();
       
       if(text != ""){
           var search_key = text;
       }else{
           var search_key = "";
       }

       if(from != "" && to != "") {
       	   var search_from = from;
       	   var search_to = to;
       }else{
       	   var search_from = "";
       	   var search_to = "";
       }
       
       $.ajax({
         url: '<?=base_url()?>AdminControl/load_all/'+pagno,
         type: 'get',
         data: {search_key:search_key, search_from:search_from, search_to:search_to},
         dataType: 'json',
         success: function(response){
         	$('#pagination').html(response.pagination);
            setData(response.result,response.row);
         },error: function(XMLHttpRequest, textStatus, errorThrown) {
            noResult();
       }   
       });
    }

    function noResult(){
            $('#datatable tbody').empty();
            var tr = "<tr>";
            tr += "<td colspan='5' style='text-align:center'> No Result </td>"; 
            $('#datatable tbody').append(tr);
    } 

    // Create table list
    function setData(result,sno){
       sno = Number(sno);
       $('#datatable tbody').empty();
       for(index in result){
       
	        var nama                = result[index].nama;
	        var created_at          = result[index].created_at;
	        var id                  = result[index].id;
	        var ket                 = result[index].ket;
	        var no_telp             = result[index].no_telp;
	        var foto_64         = result[index].foto_64;
	        sno++;

	          
			var tr =  "<tr>";				
				tr +=  "<td style='width:110px;' onclick='showImage("+id+")'><img src='data:image/jpeg;base64, "+foto_64+"' style='width: 100px'></td>";
				tr += "<td>";
				tr += nama + "<br>";
				tr += "<span class='badge badge-pill badge-danger'>"+no_telp+"</span><br><br>";
				tr += "<span class='blockquote-footer'>In : "+created_at+"</span>";
				tr += "</td>";
				tr += "</tr>";
				tr += "<tr><td colspan='2' style='font-size: 14px;color: #555'>Note : "+ket+"</td></tr>";

          	$('#datatable tbody').append(tr);
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
				<div class="col-md-12 mt-1 animated fadeInUp">
					<div class="card shadow-dan" style="border-radius: 35px; min-height: 65vh">
						<div class="card-body">
							<div class="h1 mb-5" style="color: #555">
								Data Center
							</div>
							<div class="row">
								<div class="col-xs-12 col-md-6 col-xl-3 pull-right">
									<input type="text" id="search_key" name="search_key" placeholder="Search Here.." class="input input1 mb-3">
								</div>
								<div class="col-xs-12 col-md-6 col-xl-3 pull-right">
									<input type="button" value="Filter" id="filterBtn" data-toggle="modal" data-target=".bd-example-modal-sm" class="input input1 mb-3 btn btn-primary" >
								</div>
								<table id="datatable" class="table table-bordered table-hover w-100">
									<thead>
										<td colspan="2">Visitors</td>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
							<div style='margin-top: 10px;' id='pagination'></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<!-- Small modal -->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       From: <br>
       <input type="datetime-local" id="date_key_from" name="date_key_from" placeholder="Search Here.." class="input input1 mb-3"><br>
       To: <br>
       <input type="datetime-local" id="date_key_to" name="date_key_to" placeholder="Search Here.." class="input input1 mb-3">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="reset_filter_btn" class="btn btn-danger" data-dismiss="modal">Reset</button>
        <button type="button" id="search_filter_btn" class="btn btn-primary" data-dismiss="modal">Search</button>
      </div>
    </div>
  </div>
</div>