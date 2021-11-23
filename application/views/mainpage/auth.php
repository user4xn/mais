<script src="<?php echo base_url('assets/') ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){

		<?php if ($this->session->flashdata('status') == 'fail'){ ?>
			Swal.fire({
			  title: 'Auth Failed',
			  icon: 'error',
			  html: 'Incorrect Username Or Password'
			});
		<?php } ?>
		<?php if ($this->session->flashdata('log_notify') == 'logout'){ ?>
			Swal.fire({
			  title: 'Logged Out',
			  icon: 'info',
			  html: 'You Have Been Logged Out'
			});			
		<?php } ?>
	})
</script>
<div class="contact1">
	<div class="card w-100  fadeInUp shadow-dan" style="border-radius: 30px;">
		<div class="card-body">
			<form method="post" action="<?php echo site_url('AdminControl/auth_verify') ?>">
				<span class="contact1-form-title pb-3">
	               <center>Halo!</center>
	            </span>
				<div class="wrap-input1">
	                <input class="input1" type="text" name="username" placeholder="Username">
	                <span class="shadow-input1"></span>
	            </div>

	            <div class="wrap-input1">
	                <input class="input1" type="password" name="password" placeholder="Password">
	                <span class="shadow-input1"></span>
	            </div>

	            <div class="container-contact1-form-btn">
                <button class="contact1-form-btn">
                    <span>
                        Login
                        <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                    </span>
                </button>
            </div>
			</form>
		</div>
	</div>
</div>