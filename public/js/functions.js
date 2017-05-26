$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    $('#mobile-nav').on('click', function() {
       $('#mobile-nav').toggleClass('active');
    });

    // Sweetalert prompt for account deactivation
    $('#deactivate').on('click', function() {
        swal({
            title: "Are you sure?",
            text: "You will not be able to log in again",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#00B0FF",
            confirmButtonText: "I'm sure",
            closeOnConfirm: true
        },
        function(isConfirm){
            if ( !isConfirm ) {
                $('#deactivate').prop('checked', false);
            }
        });
    });

    // Custom file input box
    $('.file-input').on('change', function(e) {
        var file = '';
        var name = '';
        file = $('input[type=file]').val();
        name = file.split('\\').pop();
        $('#filename').text(name);
    });

    $('.table-icon.delete').on('click', function(e) {
        e.preventDefault();
        var file = $(this);
        swal({
                title: "Delete",
                text: "You will not be able to access the file again",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#00B0FF",
                confirmButtonText: "Delete",
                closeOnConfirm: true
        }).then(function () {
              $.ajax({
                  $(this).css('display', 'none');
                  url: $(file).attr('href')
              });
        });
    });

    /**$('.file-anchor').on('click', function() {
      var file_id = $(this).parent().data('id');
      var enc_status = $(this).parent().parent().data('enc');

      if ( enc_status === 'encrypted' ) {
        swal({
          title: 'Friendship request',
          text: 'You wish to senendship request. If you want you can add a personal note.',
          type: 'info',
          input: 'textarea',
          confirmButtonText: 'Send request',
          showCancelButton: true,
          showLoaderOnConfirm: true,
          inputValidator: function(textarea) {
              return new Promise(function(resolve, reject) {
                  if (textarea.length>200) {
                      reject('Your text is too long. Please use no more than 200 characters.');
                  } else {
                      resolve();
                  }
              });
          },
          preConfirm: function(textarea) {
              return new Promise(function(resolve, reject) {

                  // Make jQuery Ajax-request
                  $.ajax({
                      data       : { 'enc_pass' : textarea },
                      method     : 'POST',
                      url        : '/decrypt/file/' + file_id,
                      success: function() {
                          // Set content for success-sweetalert
                          sa_title = 'Success!';
                          sa_type = 'success';
                          resolve();
                      },
                      error: function(response) {
                          // Set content for failure-sweetalert
                          sa_title = 'Oops!';
                          sa_msg = 'Something went wrong. Please try again or contact us.';
                          sa_type = 'error';
                          reject('We were unable to process your request');
                      }
                  });
              });
          },
          allowOutsideClick: false
      }).then(function() {
          swal({
              // Show success or failure sweetalert
              title: sa_title,
              type: sa_type
          }).then(function() {
              // Hide button
              $('#addfriend').hide('slow');
//          }).done(); // Deprecated, see comment by limonte below
          }).catch(swal.noop());
//      }).done(); // Deprecated, see comment by limonte below
      }).catch(swal.noop());

      } else {
        window.location.href = "../download/" + file_id;
      }

    });
   **/

    $('.file-name').each(function() {
      var str = $(this).text();
      if ( str.length > 25 ) {
        $(this).text(str.substring(0,25) + '...');
      }
    });

    $('.file-wrap').each(function() {
      var type = $(this).attr('data-type');
      var file = $(this).find('.file-anchor');
      switch(type) {
       case type = 'png':
        $(file).prepend("<a href=<img src='../images/files/picture.svg' alt='image'>");
        break;
       case type = 'jpg':
        $(file).prepend("<img src='../images/files/picture.svg' alt='image'>");
        break;
       case type = 'jpeg':
        $(file).prepend("<img src='../images/files/picture.svg' alt='image'>");
        break;
       case type = 'gif':
        $(file).prepend("<img src='../images/files/picture.svg' alt='gif'>");
        break;
       case type = 'pdf':
        $(file).prepend("<img src='../images/files/pdf.svg' alt='pdf'>");
        break;
       case type = 'txt':
        $(file).prepend("<img src='../images/files/text-document.svg' alt='text-document'>");
        break;
       case type = 'rar':
        $(file).prepend("<img src='../images/files/rar-file-format.svg' alt='rar-file'>");
        break;
       case type = 'flv':
        $(file).prepend("<img src='../images/files/video.svg' alt='video-format'>");
        break;
       case type = 'avi':
        $(file).prepend("<img src='../images/files/video.svg' alt='video-format'>");
        break;
       case type = 'wmw':
        $(file).prepend("<img src='../images/files/video.svg' alt='video-format'>");
        break;
       case type = 'waw':
        $(file).prepend("<img src='../images/files/music-player.svg' alt='music-format'>");
        break;
       case type = 'mp3':
        $(file).prepend("<img src='../images/files/music-player.svg' alt='music'>");
        break;
       case type = 'webm':
        $(file).prepend("<img src='../images/files/music-player.svg' alt='music'>");
        break;
       case type = 'rar':
        $(file).prepend("<img src='../images/files/musicrar-file-format.svg' alt='rar-file'>");
        break;
       case type = 'docx':
        $(file).prepend("<img src='../images/files/text-document.svg' alt='rar-file'>");
       break;
       default:
        $(file).prepend("<img src='../images/files/folder.svg' alt='file'>");
      }
    });

});
