<div class="contact1">
    <div class="container-contact1">
        <div class="contact1-pic js-tilt" data-tilt>
            <img src="<?php echo base_url('assets/') ?>images/img-01.png" class="border" alt="IMG" style="border-radius: 50%"><br>
            <center>
                <h1>M . A . I . S</h1>
                <span>Mardizu Access Information System</span>
            </center>
        </div>

        <form class="contact1-form validate-form" enctype="multipart/form-data" method="post" action="<?php echo base_url('dev/input_guest');?>">
            <span class="contact1-form-title">
               <center><img src="<?php echo base_url('assets/images/mdz-horizontal.png') ?>" style="width: 220px;"></center>
            </span>

            <div id="checkClass" class="wrap-input1 validate-input" data-validate = "Nama Diperlukan">
                <input class="input1" type="text" name="nama" placeholder="Nama" id="field_nama">
                <span class="shadow-input1"></span>
            </div>

            <div id="checkClass" class="wrap-input1 validate-input" data-validate = "Nomor Telepon Diperlukan">
                <input class="input1" type="text" name="telp" placeholder="No.Telepon" id="field_telephone">
                <span class="shadow-input1"></span>
            </div>

            <div class="wrap-input1 validate-input" data-validate = "Foto Diperlukan">
                <center>
                    <label id="fotoDiri" class="input1" style="background: #3498db;color:#fff; vertical-align: bottom;display: table-cell;vertical-align: middle;width: 100%" data-validate = "Foto Diperlukan">
                        <i class="fas fa-camera"></i> <input data-validate = "Foto Diperlukan" id="foto_input" class="foto" type="file" name="foto" style="display: none;cursor: pointer;">
                    </label>
                    <img class="mt-3" id="pv_foto" src="" style="width: 200px;border: 1px solid #ccc; text-align: center;display: none;">
                </center>
            </div>

            <div id="checkClass" class="wrap-input1 validate-input" data-validate = "Keterangan Diperlukan">
                <textarea class="input1" name="ket" placeholder="Keterangan" id="field_ket"></textarea>
                <span class="shadow-input1"></span>
            </div>

            <div class="container-contact1-form-btn">
                <button class="contact1-form-btn" id='btn_kirim' value="1">
                    <span>
                        Kirim
                        <i class="fas fa-long-arrow-alt-right" aria-hidden="true"></i>
                    </span>
                </button>

            </div>
        </form>
    </div>
</div>