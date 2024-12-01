<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
    <link rel="stylesheet" href="<?=base_url('assets\bootstrap-5.3.3-dist\bootstrap-5.3.3-dist\css\bootstrap.rtl.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('assets\fontawesome-free-6.6.0-web\fontawesome-free-6.6.0-web\css\all.min.css')?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</head>
<body>
  <div class="container">
    <div class="row mt-3">
        <div class="col-12">
            <h3 class="text-center">Data Pelanggan</h3>
            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalTambahProduk"><i class="fa-solid fa-cart-plus"></i>Tambah Produk</button>
        </div>
    </div>
  </div> 
  <div class="row">
    <div class="col-12">
      <div class="container mt-5">
        <table class="table table-bordered" id="pelangganTable">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Pelanggan</th>
              <th>Alamat</th>
              <th>No telp</th>
            </tr>
          </thead>
          <tbody>
            <!-- Data akan dimasukkan melalui AJAX -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script src="<?=base_url('assets\jquery-3.7.1.min.js')?>"></script>
  <script src="<?=base_url('assets\bootstrap-5.3.3-dist\bootstrap-5.3.3-dist\js\bootstrap.min.js')?>"></script>
  2<script src="<?=base_url('assets\fontawesome-free-6.6.0-web\fontawesome-free-6.6.0-web\js\all.min.js')?>"></script>

  <!--Modal Tambah Produk-->
  <div class="modal fade" id="modalTambahPelanggan" tabindex="-1" aria-labelledby="modalTambahPelanggan" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h1 class="modal-title" id="modalLabel">Tambah Pelanggan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formPelanggan">
             <div class="row mb-3">
                  <label for="namaProduk" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                  <div class="col-sm-8">
                        <input type="text" class="form-control" id="namaPelanggan" name="namaPelanggan">
                     </div>
                  </div>
             <div class="row mb-3">
                 <label for="alamatPelanggan" class="col-sm-4 col-form-label">Alamat</label>
                 <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="alamatPelanggan">
                </div>
             </div>
             <div class="row mb-3">
                 <label for="NotelpPelanggan" class="col-sm-4 col-form-label">No Telp</label>
                 <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="NotelpPelanggan">
                </div>
             </div>
             <button type="button" id="simpanPelanggan" class="btn btn-primary float-end">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Modal Edit Produk-->
<div class="modal fade" id="modalEditPelanggan" tabindex="-1" aria-labelledby="modalEditPelanggan" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h1 class="modal-title" id="modalEditLabel">Edit Pelanggan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEditPelanggan">
             <input type="hidden" id="editPelangganId" name="pelanggan_id">
             <div class="row mb-3">
                  <label for="editNamaPelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                  <div class="col-sm-8">
                        <input type="text" class="form-control" id="editNamaPelanggan" name="namaPelanggan">
                     </div>
                  </div>
             <div class="row mb-3">
                 <label for="editAlamatPelanggan" class="col-sm-4 col-form-label">Alamat</label>
                 <div class="col-sm-8">
                 <input type="text" class="form-control" id="editAlamatPelanggan" name="alamatPelanggan">
                </div>
             </div>
             <div class="row mb-3">
                 <label for="editNotelpPelanggan" class="col-sm-4 col-form-label">No Telp</label>
                 <div class="col-sm-8">
                 <input type="text" class="form-control" id="editNotelpPelanggan" name="alamatPelanggan">
                </div>
             </div>
             <button type="button" id="updatePelanggan" class="btn btn-primary float-end">Update</button>
        </form>
      </div>A
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    tampilProduk();
  function tampilProduk(){
    $.ajax({
      url: '<?=base_url('pelanggan/tampil')?>',
      type: 'GET',
      dataType: 'json',
      success: function(hasil){
        if (hasil.status === 'success'){
          var pelangganTable = $('#pelangganTable tbody');
          pelangganTable.empty(); //Hapus semua isi tabel

          var pelanggan = hasil.pelanggan;
          var no = 1;

          //Looping untuk memasukkan data ke dalam tabel
          produk.forEach(function(item) {
            var row  = '<tr>' +
            '<td>' + no + '</td>' +
            '<td>' + item.nama_pelanggan + '</td>' +
            '<td>' + item.alamat + '</td>' +
            '<td>' + item.no_telp + '</td>' +
            '<td>' +
                '<button class="btn btn-warning btn-sn editPelanggan" data-bs-toggle="modal" data-bs-target="#modalEditPelanggan" data"' + item.pelanggan_id + '"><i class="fa-solid fa-pencil"></i> Edit</button> '+
                '<button class="btn btn-danger btn-sn hapusProduk" data-id="' + item.pelanggan_id + '"><i class="fa-solid fa-trash-can"></i> Hapus</button> '+
            '</td>' +
          '</tr>';
          pelangganTable.append(row);
          no++;
          });
        } else {
          alert('Gagal mengambil data.');
        }
      },
      error: function(xhr, status, error) {
        alert('Terjadi kesalahan: '+ error);
      }
    });
  }
    
    $("#simpanPelanngan").on("click", function(){
      var formData = {
        nama_produk: $('#namaPelanggan').val(),
        harga: $('#alamatPelanggan').val(),
        stok: $('#notelpPelanggan').val()
      };

      $.ajax({
        url:'<?=base_url('pelanggan/simpan');?>',
        type:'POST',
        data: formData,
        dataType:'json',
        success:function(hasil){
          if(hasil.status ==="success"){
             //alert(hasil.message);
             $('#modalTambahPelanggan').modal('hide');
             $('#formPelanggan')[0].reset();
             tampilProduk();
          } else {
             alert('Gagal menyimpan data:'+ JSON.stringify(hasil.errors)); 
          }
        },
        error: function(xhr, status, error){
          alert('Terjadi kesalahan: '+ error);
        }
      });
    });
 
  $(document).on('click', '.hapusPelanggan', function(){
    var produkId = $(this).data('id');
    var konfirmasi = confirm('Apakah Anda yakin ingin menghapus pelanggan ini?');

    if(konfirmasi){
        $.ajax({
            url: '<?=base_url('pelanggan/hapus');?>',
            type: 'POST',
            data: {pelanggan_id: pelangganId},
            dataType: 'json',
            success: function(hasil){
                if(hasil.status === 'success'){
                    alert(hasil.message);
                    tampilPelanggan();
                } else {
                    alert('Gagal menghapus pelanggan: ' + hasil.message);
                }
            },
            error: function(xhr, status, error){
                alert('Terjadi kesalahan: ' + error);
            }
        });
    }

    $(document).on('click', '.editPelanggan', function(){
    var produkId = $(this).attr('data'); // Mengambil produk_id dari tombol edit

    $.ajax({
        url: '<?=base_url('pelanggan/get_pelanggan_by_id');?>', // URL untuk mengambil data produk
        type: 'GET',
        data: {pelanggan_id: pelangganId},
        dataType: 'json',
        success: function(hasil){
            if (hasil.status === 'success'){
                // Isi data produk ke dalam modal
                $('#editPelangganId').val(hasil.pelanggan.pelanggan_id);
                $('#editNamaPelanggan').val(hasil.pelanggan.nama_pelanggan);
                $('#editAlamatProduk').val(hasil.pelanggan.alamat);
                $('#editNotelpProduk').val(hasil.pelanggan.no_telp);

                // Tampilkan modal edit
                $('#modalEditPelanggan').modal('show');
            } else {
                alert('Gagal mengambil data pelanggan');
            }
        },
        error: function(xhr, status, error){
            alert('Terjadi kesalahan: ' + error);
        }
    });
});

$("#updateProduk").on("click", function(){
    var formData = {
        pelanggan_id: $('#editPelangganId').val(),
        nama_pelanggan: $('#editNamaPelanggan').val(),
        alamat: $('#editAlamatPelanggan').val(),
        no_telp: $('#editNotelpPelanggan').val()
    };

    $.ajax({
        url: '<?=base_url('pelanggan/update_pelanggan');?>',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(hasil){
            if(hasil.status === "success"){
                $('#modalEditPelanggan').modal('hide');
                $('#formEditPelanggan')[0].reset();
                tampilPelanggan(); // Update tabel produk
            } else {
                alert('Gagal mengupdate pelanggan: ' + JSON.stringify(hasil.errors));
            }
        },
        error: function(xhr, status, error){
            alert('Terjadi kesalahan: ' + error);
        }
    });
});
});
});
</script>
</body>
</html>