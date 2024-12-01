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
            <h3 class="text-center">Data Produk</h3>
            <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalTambahProduk"><i class="fa-solid fa-cart-plus"></i>Tambah Produk</button>
        </div>
    </div>
  </div> 
  <div class="row">
    <div class="col-12">
      <div class="container mt-5">
        <table class="table table-bordered" id="produkTable">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Stok</th>
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
  <div class="modal fade" id="modalTambahProduk" tabindex="-1" aria-labelledby="modalTambahProduk" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h1 class="modal-title" id="modalLabel">Tambah Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formProduk">
             <div class="row mb-3">
                  <label for="namaProduk" class="col-sm-4 col-form-label">Nama Produk</label>
                  <div class="col-sm-8">
                        <input type="text" class="form-control" id="namaProduk" name="namaProduk">
                     </div>
                  </div>
             <div class="row mb-3">
                 <label for="hargaProduk" class="col-sm-4 col-form-label">Harga</label>
                 <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="hargaProduk">
                </div>
             </div>
             <div class="row mb-3">
                 <label for="stokProduk" class="col-sm-4 col-form-label">Stok</label>
                 <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="stokProduk">
                </div>
             </div>
             <button type="button" id="simpanProduk" class="btn btn-primary float-end">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Modal Edit Produk-->
<div class="modal fade" id="modalEditProduk" tabindex="-1" aria-labelledby="modalEditProduk" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header bg-warning text-white">
        <h1 class="modal-title" id="modalEditLabel">Edit Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formEditProduk">
             <input type="hidden" id="editProdukId" name="produk_id">
             <div class="row mb-3">
                  <label for="editNamaProduk" class="col-sm-4 col-form-label">Nama Produk</label>
                  <div class="col-sm-8">
                        <input type="text" class="form-control" id="editNamaProduk" name="namaProduk">
                     </div>
                  </div>
             <div class="row mb-3">
                 <label for="editHargaProduk" class="col-sm-4 col-form-label">Harga</label>
                 <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="editHargaProduk">
                </div>
             </div>
             <div class="row mb-3">
                 <label for="editStokProduk" class="col-sm-4 col-form-label">Stok</label>
                 <div class="col-sm-8">
                    <input type="number" step="0.01" class="form-control" id="editStokProduk">
                </div>
             </div>
             <button type="button" id="updateProduk" class="btn btn-primary float-end">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    tampilProduk();
  function tampilProduk(){
    $.ajax({
      url: '<?=base_url('produk/tampil')?>',
      type: 'GET',
      dataType: 'json',
      success: function(hasil){
        if (hasil.status === 'success'){
          var produkTable = $('#produkTable tbody');
          produkTable.empty(); //Hapus semua isi tabel

          var produk = hasil.produk;
          var no = 1;

          //Looping untuk memasukkan data ke dalam tabel
          produk.forEach(function(item) {
            var row  = '<tr>' +
            '<td>' + no + '</td>' +
            '<td>' + item.nama_produk + '</td>' +
            '<td>' + item.harga + '</td>' +
            '<td>' + item.stok + '</td>' +
            '<td>' +
                '<button class="btn btn-warning btn-sn editProduk" data-bs-toggle="modal" data-bs-target="#modalEditProduk" data"' + item.produk_id + '"><i class="fa-solid fa-pencil"></i> Edit</button> '+
                '<button class="btn btn-danger btn-sn hapusProduk" data-id="' + item.produk_id + '"><i class="fa-solid fa-trash-can"></i> Hapus</button> '+
            '</td>' +
          '</tr>';
          produkTable.append(row);
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
    
    $("#simpanProduk").on("click", function(){
      var formData = {
        nama_produk: $('#namaProduk').val(),
        harga: $('#hargaProduk').val(),
        stok: $('#stokProduk').val()
      };

      $.ajax({
        url:'<?=base_url('produk/simpan');?>',
        type:'POST',
        data: formData,
        dataType:'json',
        success:function(hasil){
          if(hasil.status ==="success"){
             //alert(hasil.message);
             $('#modalTambahProduk').modal('hide');
             $('#formProduk')[0].reset();
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
 
  $(document).on('click', '.hapusProduk', function(){
    var produkId = $(this).data('id');
    var konfirmasi = confirm('Apakah Anda yakin ingin menghapus produk ini?');

    if(konfirmasi){
        $.ajax({
            url: '<?=base_url('produk/hapus');?>',
            type: 'POST',
            data: {produk_id: produkId},
            dataType: 'json',
            success: function(hasil){
                if(hasil.status === 'success'){
                    alert(hasil.message);
                    tampilProduk();
                } else {
                    alert('Gagal menghapus produk: ' + hasil.message);
                }
            },
            error: function(xhr, status, error){
                alert('Terjadi kesalahan: ' + error);
            }
        });
    }

    $(document).on('click', '.editProduk', function(){
    var produkId = $(this).attr('data'); // Mengambil produk_id dari tombol edit

    $.ajax({
        url: '<?=base_url('produk/get_produk_by_id');?>', // URL untuk mengambil data produk
        type: 'GET',
        data: {produk_id: produkId},
        dataType: 'json',
        success: function(hasil){
            if (hasil.status === 'success'){
                // Isi data produk ke dalam modal
                $('#editProdukId').val(hasil.produk.produk_id);
                $('#editNamaProduk').val(hasil.produk.nama_produk);
                $('#editHargaProduk').val(hasil.produk.harga);
                $('#editStokProduk').val(hasil.produk.stok);

                // Tampilkan modal edit
                $('#modalEditProduk').modal('show');
            } else {
                alert('Gagal mengambil data produk');
            }
        },
        error: function(xhr, status, error){
            alert('Terjadi kesalahan: ' + error);
        }
    });
});

$("#updateProduk").on("click", function(){
    var formData = {
        produk_id: $('#editProdukId').val(),
        nama_produk: $('#editNamaProduk').val(),
        harga: $('#editHargaProduk').val(),
        stok: $('#editStokProduk').val()
    };

    $.ajax({
        url: '<?=base_url('produk/update_produk');?>',
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(hasil){
            if(hasil.status === "success"){
                $('#modalEditProduk').modal('hide');
                $('#formEditProduk')[0].reset();
                tampilProduk(); // Update tabel produk
            } else {
                alert('Gagal mengupdate produk: ' + JSON.stringify(hasil.errors));
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