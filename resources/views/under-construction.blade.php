<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CBT Universitas Sriwijaya | Dashboard Peserta</title>

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="{{ asset('images/logo/logo-unsri.png') }}">

	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{asset('template/css/vendors_css.css')}}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{asset('template/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('template/css/skin_color.css')}}">

    <style>
        body {
            background-size: cover !important; 
            background-position: center !important;
        }
        /* Style untuk nama website di pojok kiri atas */
        .website-brand {
            position: absolute; /* Menempatkan elemen secara absolut */
            top: 40px;         /* Jarak dari atas */
            left: 130px;        /* Jarak dari kiri */
            z-index: 100;      /* Memastikan ia berada di atas konten lain */
        }
        .website-brand h1 {
            color: #435BA5; /* Warna sesuai dengan judul 'WEBSITE' */
            font-size: 24px;
            font-weight: bold;
            margin: 0;
            padding: 0;
        }
        .website-brand img {
            /* Sesuaikan ukuran gambar logo sesuai kebutuhan Anda */
            width: 150px; /* Contoh lebar */
            height: auto; /* Mempertahankan rasio aspek */
            display: block; /* Agar tidak ada spasi di bawah gambar */
        }
    </style>
     	

</head>
<body class="hold-transition bg-img text-center theme-primary" style="background-image: url(images/under-construction.jpg);background-size: cover; background-position: center;" data-overlay="1">

    <div class="website-brand">
        <img src="{{asset('images/logo-ssi-blue.png')}}" alt="SSI Inquiry Logo">
        {{-- <h1>SSI INQUIRY</h1> --}}
    </div>
	
	<div class="container h-p100">
		<div class="row justify-content-md-center align-items-center h-p100">
			<div class="col-12">
				<div class="box bg-transparent no-border no-shadow">	
					<div class="box-body text-center">
						    
						<div class="row justify-content-md-center align-items-center h-p100">
							
							<div class="col-md-5 col-12">
								<div class="text-start">
									<h1 class="fs-50" style="color: #435BA5"><strong>WEBSITE</strong></h1>	
                                    <p class="fs-30" style="color: #435BA5">UNDER CONSTRUCTION</p>	

					  				<p class="mt-20 text-grey fs-18">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Omnis illo eligendi odio quod at veritatis voluptatem vitae deserunt suscipit. Reiciendis excepturi ipsum maiores fugit perferendis, quos incidunt iusto sint inventore.</p>
									
									{{-- <div class="mx-auto mt-40">
										<h3 class="text-uppercase text-white">NOTIFY ME WHEN IT'S READY</h3>
										<div class="input-group">
											<input type="text" class="form-control p-10" placeholder="Your Email Address......">
											<button type="button" class="btn btn-success">Notify Me</button>
										</div>
									</div>
									
									<p class="gap-items-2 mt-40">
									  <a class="btn btn-social-icon btn-facebook" href="#"><i class="fa fa-facebook"></i></a>
									  <a class="btn btn-social-icon btn-google" href="#"><i class="fa fa-twitter"></i></a>
									  <a class="btn btn-social-icon btn-instagram" href="#"><i class="fa fa-linkedin"></i></a>
									  <a class="btn btn-social-icon btn-twitter" href="#"><i class="fa fa-twitter"></i></a>
									</p> --}}
									
								</div>
							</div>
							<div class="col-md-5 col-12">								
								{{-- <div class="box box-body my-50 bg-transparent no-shadow b-0">
									<div id="countdown" class="row justify-content-md-center text-white"></div>
								</div> --}}
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</div>
	

    <!-- Vendor JS -->
    <script src="{{asset('template/js/vendors.min.js')}}"></script>
    <script src="{{asset('template/js/pages/chat-popup.js')}}"></script>
    <script src="{{asset('assets/icons/feather-icons/feather.min.js')}}"></script>

    <!-- EduAdmin App -->
    <script src="{{asset('template/js/pages/coundown-timer.js')}}"></script>
    
</body>
</html>
