$("#FileInput-1").on('change', function(e) {

  var labelVal = $(".title").text();
  var fileName = e.target.files[0].name;
  var extension = fileName.split('.').pop().toLowerCase();

  if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'webp' || extension == 'gif') {
    $(".filelabel i").removeClass().addClass('fa fa-file-image-o');
    $(".filelabel i, .filelabel .title").css('color', '#208440');
    $(".filelabel").css('border', '2px solid #208440');

    var reader = new FileReader();
    reader.onload = function(e) {
      $(".preview-1").attr('src', e.target.result);
    };
    reader.readAsDataURL(e.target.files[0]);
  } else if (extension == 'pdf') {
    $(".filelabel i").removeClass().addClass('fa fa-file-pdf-o');
    $(".filelabel i, .filelabel .title").css('color', 'red');
    $(".filelabel").css('border', '2px solid red');
    $(".preview-1").attr('src', '');
  } else if (extension == 'doc' || extension == 'docx') {
    $(".filelabel i").removeClass().addClass('fa fa-file-word-o');
    $(".filelabel i, .filelabel .title").css('color', '#2388df');
    $(".filelabel").css('border', '2px solid #2388df');
    $(".preview-1").attr('src', '');
  } else {
    $(".filelabel i").removeClass().addClass('fa fa-file-o');
    $(".filelabel i, .filelabel .title").css('color', 'black');
    $(".filelabel").css('border', '2px solid black');
    $(".preview-1").attr('src', '');
  }

  if (fileName) {
    if (fileName.length > 10) {
      $(".filelabel .title").text('');
    } else {
      $(".filelabel .title").text('');
    }
  } else {
    $(".filelabel .title").text('');
  }
});


$("#FileInput-2").on('change', function(e) {
  var labelVal = $(".title").text();
  var fileName = e.target.files[0].name;
  var extension = fileName.split('.').pop().toLowerCase();

  if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'webp' || extension == 'gif') {
    $(".filelabel i").removeClass().addClass('fa fa-file-image-o');
    $(".filelabel i, .filelabel .title").css('color', '#208440');
    $(".filelabel").css('border', '2px solid #208440');

    var reader = new FileReader();
    reader.onload = function(e) {
      $(".preview-2").attr('src', e.target.result);
    };
    reader.readAsDataURL(e.target.files[0]);
  } else if (extension == 'pdf') {
    $(".filelabel i").removeClass().addClass('fa fa-file-pdf-o');
    $(".filelabel i, .filelabel .title").css('color', 'red');
    $(".filelabel").css('border', '2px solid red');
    $(".preview-2").attr('src', '');
  } else if (extension == 'doc' || extension == 'docx') {
    $(".filelabel i").removeClass().addClass('fa fa-file-word-o');
    $(".filelabel i, .filelabel .title").css('color', '#2388df');
    $(".filelabel").css('border', '2px solid #2388df');
    $(".preview-2").attr('src', '');
  } else {
    $(".filelabel i").removeClass().addClass('fa fa-file-o');
    $(".filelabel i, .filelabel .title").css('color', 'black');
    $(".filelabel").css('border', '2px solid black');
    $(".preview-2").attr('src', '');
  }

  if (fileName) {
    if (fileName.length > 10) {
      $(".filelabel .title").text('');
    } else {
      $(".filelabel .title").text('');
    }
  } else {
    $(".filelabel .title").text('');
  }
});


$("#FileInput-3").on('change', function(e) {
  var labelVal = $(".title").text();
  var fileName = e.target.files[0].name;
  var extension = fileName.split('.').pop().toLowerCase();

  if (extension == 'jpg' || extension == 'jpeg' || extension == 'png' || extension == 'webp' || extension == 'gif') {
    $(".filelabel i").removeClass().addClass('fa fa-file-image-o');
    $(".filelabel i, .filelabel .title").css('color', '#208440');
    $(".filelabel").css('border', '2px solid #208440');

    var reader = new FileReader();
    reader.onload = function(e) {
      $(".preview-3").attr('src', e.target.result);
    };
    reader.readAsDataURL(e.target.files[0]);
  } else if (extension == 'pdf') {
    $(".filelabel i").removeClass().addClass('fa fa-file-pdf-o');
    $(".filelabel i, .filelabel .title").css('color', 'red');
    $(".filelabel").css('border', '2px solid red');
    $(".preview-3").attr('src', '');
  } else if (extension == 'doc' || extension == 'docx') {
    $(".filelabel i").removeClass().addClass('fa fa-file-word-o');
    $(".filelabel i, .filelabel .title").css('color', '#2388df');
    $(".filelabel").css('border', '2px solid #2388df');
    $(".preview-3").attr('src', '');
  } else {
    $(".filelabel i").removeClass().addClass('fa fa-file-o');
    $(".filelabel i, .filelabel .title").css('color', 'black');
    $(".filelabel").css('border', '2px solid black');
    $(".preview-3").attr('src', '');
  }

  if (fileName) {
    if (fileName.length > 10) {
      $(".filelabel .title").text('');
    } else {
      $(".filelabel .title").text('');
    }
  } else {
    $(".filelabel .title").text('');
  }
});