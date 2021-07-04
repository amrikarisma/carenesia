jQuery(function($) {
    $('.btn-konfirmasi').on('click', function () {
        $el = $(this);
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Transaksi yang sudah dikonfirmasi tidak dapat diubah kembali",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'KONFIRMASI',
            cancelButtonText: 'Batalkan'
          }).then((result) => {
            if (result.isConfirmed) {
                var formData = {
                    'action': 'manual_confirmation',
                    'status'    : 'PAID',
                    'external_id' : $el.data('external-id'),
                };
                jQuery.ajax({
                    type: "POST",
                    dataType: "json",
                    url: ajax_carenesia.ajaxurl,
                    data: formData,
                    success: function(data){
                        console.log(data);
        
                        if(data.status == 'success') {
                            $el.closest('tr').find('.transaction_status').html(formData.status);
                            Swal.fire(
                                'Berhasil',
                                'Transaksi berhasil di konfirmasi',
                                'success'
                              );
                            $el.parent('.column-actions').remove();
                        } else {
                            Swal.fire(
                                'Gagal',
                                'Ada kesalahan silahkan coba lagi',
                                'error'
                              );
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        console.log("Status: ", textStatus);
                        console.log("Error: ", errorThrown); 
                    }    
                }); 
            }
        });
    });

    $('.btn-tolak').on('click', function () {
        $el = $(this);
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Transaksi yang ditolak tidak dapat diubah kembali",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'TOLAK',
            cancelButtonText: 'Batalkan'
          }).then((result) => {
            if (result.isConfirmed) {
                var formData = {
                    'action': 'manual_confirmation',
                    'status'    : 'CANCELED',
                    'external_id' : $el.data('external-id'),
                };
                
                jQuery.ajax({
                    type: "POST",
                    dataType: "json",
                    url: ajax_carenesia.ajaxurl,
                    data: formData,
                    success: function(data){
                        console.log(data);
                        if(data.status == 'success') {
                            $el.closest('tr').find('.transaction_status').html(formData.status);
                            Swal.fire(
                                'Berhasil',
                                'Transaksi transaksi berhasil dibatalkan',
                                'success'
                            );
                            $el.parent('.column-actions').remove();
                        } else {
                            Swal.fire(
                                'Gagal',
                                'Ada kesalahan silahkan coba lagi',
                                'error'
                            );
                        }
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 
                        console.log("Status: ", textStatus);
                        console.log("Error: ", errorThrown); 
                    }    
                }); 

            }
        });
    });
});