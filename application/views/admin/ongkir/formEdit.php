  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Ubah Ongkos Kirim</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Tambah Ongkos Kirim</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Data Ongkos Kirim</h3>
              </div>
              <!-- form start -->

							<form class="form-horizontal" method="post" action="<?php echo site_url('ongkir/edit');?>">
							<input type="hidden" name="id" value="<?php echo $ongkir->idOngkir; ?>">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kota Tujuan</label>
                    <div class="col-sm-9">
                      <input type="text" name="tujuan" class="form-control" value="<?php echo $ongkir->tujuan; ?>" id="inputEmail3" placeholder="Kota Tujuan" required>
                    </div>
                  </div>
									<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Kurir</label>
                    <div class="col-sm-9">
											<select class="form-control" name="kurir">
												<option value="JNE">JNE</option>
												<option value="POS">POS</option>
												<option value="TIKI">TIKI</option>

											</select>
                     
                    </div>
                  </div>
									<div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Ongkos Kirim</label>
                    <div class="col-sm-9">
                      <input type="text" name="ongkos" class="form-control" value="<?php echo $ongkir->ongkos; ?>" id="inputEmail3" placeholder="Ongkos Kirim" required>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info float-right">Simpan</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
