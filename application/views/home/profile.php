<?php
$idMember = $this->session->userdata('idKonsumen');
$member = $this->db->get_where('tbl_member', ['idKonsumen' => $idMember])->row_array();
?>
<div class="container-fluid pt-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">Profile Member</span></h2>
    </div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Nama : <?= $member['namaKonsumen'] ?></h5>
            <p class="card-text">Username : <?= $member['username'] ?></p>
            <p class="card-text">Email : <?= $member['email'] ?></p>
            <p class="card-text">No. Handphone : <?= $member['tlpn'] ?></p>
            <p class="card-text">Alamat : <?= $member['alamat'] ?></p>
            <a href="<?= site_url('main/get_by_id/' . $member['idKonsumen']) ?>" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>