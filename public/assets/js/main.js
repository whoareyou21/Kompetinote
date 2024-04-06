$(document).ready(function () {
  autoinput();
  emailValidation();
  setTimeout(function () {
    $('.alert-success').fadeOut()
    $('.alert-danger').fadeOut()
  }, 3000);
});

$('.logout').on('click', function (e) {
  e.preventDefault();

  Swal.fire({
    title: 'Yakin Ingin Keluar?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#1D74F5',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya'
  }).then((result) => {
    if (result.isConfirmed) {
      var id = $(this).data("id");
      var token = $("meta[name='csrf-token']").attr("content");

      $.ajax(
        {
          url: "/logout",
          type: 'POST',
          data: {
            "_token": token,
          },
          success: function (res) {
            if (res) {
              Swal.fire({
                title: res.success,
                icon: 'success',
                confirmButtonColor: '#1D74F5',
                confirmButtonText: 'OK'
              }).then((result) => {
                window.location = res.url
              })
            }
            else {
              Swal.fire({
                title: res.error,
                icon: 'error',
                confirmButtonColor: '#1D74F5',
                confirmButtonText: 'OK'
              }).then((result) => {
                window.location = res.url
              })
            }
          }
        })
    }
  })
})

$('.delete-confirm').on('click', function (e) {
  e.preventDefault();

  Swal.fire({
    title: 'Yakin Menghapus Data ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#1D74F5',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      var id = $(this).data("id");
      var token = $("meta[name='csrf-token']").attr("content");

      $.ajax(
        {
          url: "/dashboard" + id,
          type: 'DELETE',
          data: {
            "_token": token,
          },
          success: function (res) {
            Swal.fire({
              title: res.success,
              icon: 'success',
              confirmButtonColor: '#1D74F5',
              confirmButtonText: 'OK'
            }).then((result) => {
              window.location = res.url
            })
          }
        })
    }
  })
})

$('.update-approve').on('click', function (e) {
  e.preventDefault();

  Swal.fire({
    title: 'Yakin Menyetujui Data ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#1D74F5',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed) {
      var id = $(this).data("id");
      var token = $("meta[name='csrf-token']").attr("content");

      $.ajax(
        {
          url: "/dashboard" + id,
          type: 'PUT',
          data: {
            "_token": token,
          },
          success: function (res) {
            Swal.fire({
              title: res.success,
              icon: 'success',
              confirmButtonColor: '#1D74F5',
              confirmButtonText: 'OK'
            }).then((result) => {
              window.location = res.url
            })
          }
        })
    }
  })
})

$('.update-reject').on('click', function (e) {
  e.preventDefault();

  Swal.fire({
    title: 'Yakin Menolak Data ini?',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#1D74F5',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya!',
    cancelButtonText: 'Batal',
    html: '<input id="rejection_note" placeholder="Alasan Menolak">  </input>'
  }).then((result) => {
    if (result.isConfirmed) {
      var id = $(this).data("id");
      var token = $("meta[name='csrf-token']").attr("content");
      var rejection_note = $('#rejection_note').val();

      $.ajax(
        {
          url: "/dashboard" + id,
          type: 'PUT',
          data: {
            "_token": token,
            "rejection_note": rejection_note
          },
          success: function (res) {
            Swal.fire({
              title: res.success,
              icon: 'success',
              confirmButtonColor: '#1D74F5',
              confirmButtonText: 'OK'
            }).then((result) => {
              window.location = res.url
            })
          }
        })
    }
  })
})

function handleYearChange() {
  var dateInput = document.getElementById('tahunOnly');
  var selectedYear = new Date(dateInput.value).getFullYear();
  dateInput.value = selectedYear;
}


$(document).on("click", function (event) {
  if (!$(event.target).closest("#category").length) {
    $("#suggesstion-box-activity").hide();
    $("#suggesstion-box-lecture").hide();
  }
});

$("#input_type_participation").change(function () {
  var selectedValue = $(this).val();
  if (selectedValue == 'Kelompok') {
    $('.type-group').show()
  } else {
    $('.type-group').hide()
  }
});

$("#achievement").change(function () {
  if($(this).val()=="Pendaftar"){
    $('#additonal-file').hide();
    $('#certificate').removeAttr('required');
    $('#organizer_url').removeAttr('required');
    $('#handover').removeAttr('required');
    $('#other_document').removeAttr('required');
  }else{
    $('#additonal-file').show();
    $('#certificate').addAttr('required');
    $('#organizer_url').addAttr('required');
    $('#handover').addAttr('required');
    $('#other_document').addAttr('required')
  }
});

function autoinput() {
  //Activity
  $("#addactivity_name").keyup(function () {
    var categoriesJson = $('#valuecategories').val();
    var categoriesObj = JSON.parse(categoriesJson);
    var searchTerm = $(this).val().toLowerCase();
    var suggestions = [];


    if (searchTerm.length > 0) {
      suggestions = categoriesObj.filter(function (item) {
        return item.activity_name.toLowerCase().includes(searchTerm);
      }).map(function (item) {
        return item.activity_name;
      });
    }

    displaySuggestionsActivity(suggestions);
  });

  function displaySuggestionsActivity(suggestions) {
    var suggestionList = $('#suggesstion-box-activity');
    suggestionList.empty();
    var content = ''

    if (suggestions.length > 0) {
      content += ('<ul>');
      suggestions.forEach(function (suggestion) {
        content += ('<li onClick="selectActivity(\'' + suggestion + '\')">' + suggestion + '</li>');
      });
      content += ('</ul>');
      suggestionList.append(content);
      suggestionList.show();
    }
  }

  //Lecture
  $("#addsupervisor").keyup(function () {
    var categoriesJson = $('#valuelectures').val();
    var categoriesObj = JSON.parse(categoriesJson);
    var searchTerm = $(this).val().toLowerCase();
    var suggestions = [];
    if (searchTerm.length > 0) {
      suggestions = categoriesObj.filter(function (item) {
        return item.name.toLowerCase().includes(searchTerm);
      }).map(function (item) {
        return item.name;
      });
    }

    displaySuggestionsLecture(suggestions);
  });

  function displaySuggestionsLecture(suggestions) {
    var suggestionList = $('#suggesstion-box-lecture');
    suggestionList.empty();
    var content = ''

    if (suggestions.length > 0) {
      content += ('<ul>');
      suggestions.forEach(function (suggestion) {
        content += ('<li onClick="selectLecture(\'' + suggestion + '\')">' + suggestion + '</li>');
      });
      content += ('</ul>');
      suggestionList.append(content);
      suggestionList.show();
    }
  }
}
function selectActivity(val) {
  var categoriesJson = $('#valuecategories').val();
  var categoriesObj = JSON.parse(categoriesJson);
  categoriesObj.forEach(function (item) {
    if (item.activity_name.toLowerCase() == val.toLowerCase()) {
      $('#activity_level').val(item.activity_level);
      $('#category').val(item.category);
      $('#activity_year').val(item.activity_year);
      $('#category_id').val(item.id);
      $('#input_activity_type').val(item.activity_type);
      if (item.activity_type == 'Kelompok') {
        $('.type-group').show();
      } else {
        $('.type-group').hide();
      }
    }
  });
  $("#addactivity_name").val(val);
  $("#suggesstion-box-activity").hide();
}

function selectLecture(val) {
  var categoriesJson = $('#valuelectures').val();
  var categoriesObj = JSON.parse(categoriesJson);
  categoriesObj.forEach(function (item) {
    if (item.name.toLowerCase() == val.toLowerCase()) {
      $('#supervisor_nik').val(item.nim);
      $('#supervisor_id').val(item.id);
    }
  });
  $("#addsupervisor").val(val);
  $("#supervisor_id").hide();
}

function emailValidation() {
  var currentURL = window.location.href;
  $("#campus_emailstudent").keyup(function () {
    var email = $(this).val();
    var pattern;
    var currentPage = window.location.pathname;
    var textemail;
    if (currentPage.includes('/register')) {
      pattern = /^[a-zA-Z0-9._-]+@students\.ukdw\.ac\.id$/;
      textemail="Harus menggunakan email student dengan domain @students.ukdw.ac.id"
    } else {
      pattern = /^[a-zA-Z0-9._-]+@staff\.ukdw\.ac\.id$/;
      textemail="Harus menggunakan email student dengan domain @staff.ukdw.ac.id"
    }

    if (!pattern.test(email)) {
      $('#emailHelp').text(textemail);
      $('#campus_emailstudent').addClass('is-invalid');
      $('.btn-primary').addClass("disabled")
    } else {
      $('#campus_emailstudent').removeClass('is-invalid');
      $('#emailHelp').text("");
      $('.btn-primary').removeClass("disabled")
    }
  });
  $('#togglePassword').on('click', function (e) {
    var passwordField = $('#password');
    var passwordFieldType = passwordField.attr('type');
    var newType = (passwordFieldType === 'password') ? 'text' : 'password';
    passwordField.attr('type', newType);
    $(this).toggleClass('fa-eye fa-eye-slash');
  });
}
