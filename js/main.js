// ready function
$(document).ready(function () {
    $(".btn-editproduk").on("click", function () {
      console.log("ready!");
    // get data from button edit
    const id = $(this).data("id");
    const nama = $(this).data("nama");
    const ket = $(this).data("ket");
    
   
    // Set data to Form Edit
        
    $("#modal_nama_produk").val(nama);
    $("#modal_ket_produk").val(ket);
    $("#modal_id_produk").val(id);
  });
});
