<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    {{-- My Styles --}}
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.js"></script>
    <script src="/assets/js/main.js"></script>
    



    <title>Kompetinote</title>
</head>

<body>
    {{-- buat ngasih child view nya --}}
    @yield('container')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="https://kit.fontawesome.com/7f5de6ec03.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-3-typeahead/bootstrap3-typeahead.min.js"></script>


</body>

<!-- Modal -->
<div class="modal fade popupabout" id="popupabout" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kontak Kami</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button><br>
            </div>
            <div class="modal-body">
                <div class="contact-biro">Hubungi Biro 3 UKDW apabila terjadi masalah pada sistem</div>
                <div class="row content">
                    <div class="col-md-6 d-flex">
                        <div class="left">
                            <i class="fa-solid fa-envelope"></i>
                        </div>
                        <div class="right">
                            <div class="contact-title">Email</div>
                            <div class="contact-desc">biro3@staff.ukdw.ac.id</div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="left">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div class="right">
                            <div class="contact-title">Phone</div>
                            <div class="contact-desc">+62 813 3666 0839</div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="left">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="right">
                            <div class="contact-title">Office</div>
                            <div class="contact-desc">Office Gedung Hagios lantai 1, UKDW</div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="left">
                            <i class="fa-brands fa-instagram"></i>
                        </div>
                        <div class="right">
                            <div class="contact-title">Instagram</div>
                            <div class="contact-desc">biro3.ukdw</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</html>