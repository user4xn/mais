<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" author="Wildan">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Content -->
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/') ?>vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/') ?>fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/') ?>vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/') ?>vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/') ?>vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/') ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/') ?>css/main.css">
    <!--===============================================================================================-->
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/fontawesome/css/all.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('dist/themify/themify-icons.css') ?>">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!--===============================================================================================-->
    <title>Mardizu Guest Book</title>
    <!-- Icon Web -->
    <link rel="icon" href="https://mardizu.co.id/assets/asset_index/images/cropped-favicon-2-1-192x192.png" sizes="192x192" />
</head>
<body>
           <!-- Content -->
           <?php echo $content ?>
           <!-- Content -->
</body>

<!--===============================================================================================-->
<script src="<?php echo base_url('assets/') ?>vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url('assets/') ?>vendor/bootstrap/js/popper.js"></script>
<script src="<?php echo base_url('assets/') ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url('assets/') ?>vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
<script src="<?php echo base_url('assets/') ?>vendor/tilt/tilt.jquery.min.js"></script>
<script >
    $('.js-tilt').tilt({
        scale: 1.1
    })

    $(document).ready(function(){

    $('#btn_kirim').click(function(){
        if($('#foto_input').get(0).files.length != 0 && $('#field_nama, #field_telephone, field_ket').val() != '') {
            Swal.fire({
                icon: 'info',
                html: '<h5>Loading...</h5>',
                allowEscapeKey: false,
                allowOutsideClick: false,
                onOpen: () => {
                  swal.showLoading();
                }
            });
        }
    });


    function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#pv_foto').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
    }

    $("#foto_input").change(function(){
        readURL(this);
        $('#pv_foto').css('display', 'block');
    });

    
    <?php if ($this->session->flashdata('status') == 'ok') { ?>
    let timerInterval
    Swal.fire({
      title: 'Terimakasih!',
      icon: 'success',
      html: 'Telah Mengisi Log Book <br> Gunakan Masker Dan Handsanitaizer',
      timer: 2000,
      timerProgressBar: true,
      didOpen: () => {
        Swal.showLoading()
        timerInterval = setInterval(() => {
          const content = Swal.getContent()
          if (content) {
            const b = content.querySelector('b')
            if (b) {
              b.textContent = Swal.getTimerLeft()/1000
            }
          }
        }, 100)
      },
      willClose: () => {
        clearInterval(timerInterval)
      }
    }).then((result) => {
      /* Read more about handling dismissals below */
      if (result.dismiss === Swal.DismissReason.timer) {
        console.log('I was closed by the timer')
      }
    });
    <?php } ?>
    });
</script>
<!--===============================================================================================-->
    <script src="<?php echo base_url('assets/') ?>js/main.js"></script>
</html>