<div class="container-fluid pt-5">
        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">Form Edit Profile Member</span></h2>
        </div>
        <div class="row px-xl-5">
            <div class="col-lg-7 mb-5">
                <div class="contact-form">   
                    <form name="sentMessage"  method="post" action="<?php echo site_url('main/edit');?>" enctype="multipart/form-data">
                        <div class="control-group">
                        <input type="hidden" name="idMember" value="<?= $member->idKonsumen; ?>"/>
                            <h6>Nama Member</h6>
                            <input type="text" name="nama" class="form-control" id="name" 
                                required="required" data-validation-required-message="Please enter your name" value="<?= $member->namaKonsumen; ?>"/>
                        </div>
                        <div class="control-group">
                            <h6>Username</h6>
                            <input type="text" class="form-control" rows="3" name="username"
                                required="required"
                                data-validation-required-message="Please enter your message" value="<?= $member->username; ?>"></input>
                        </div>
                        <div class="control-group">
                            <h6>Email</h6>
                            <input type="text" class="form-control" rows="3" name="email"
                                required="required"
                                data-validation-required-message="Please enter your message" value="<?= $member->email; ?>"></input>
                        </div>
                        <div class="control-group">
                            <h6>No. Handphone</h6>
                            <input type="text" class="form-control" rows="3" name="telpon"
                            required="required"
                            data-validation-required-message="Please enter your message" value="<?= $member->tlpn; ?>"></input>
                        </div>
                        <div class="control-group">
                            <h6>Alamat</h6>
                            <input type="text" class="form-control" rows="3" name="alamat"
                                required="required"
                                data-validation-required-message="Please enter your message" value="<?= $member->alamat; ?>"></input>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" id="sendMesrsageButton">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
