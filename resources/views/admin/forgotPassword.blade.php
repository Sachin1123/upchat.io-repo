@extends('iotAdmin.layouts.guest')

@section('content')
<div class="container-fluid">
				<div class="row no-gutter">
					<!-- The image half -->
					<div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex bg-primary-transparent">
						<div class="row wd-100p mx-auto text-center">
							<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p">
								<img src="../../assets/img/media/forgot.png" class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
							</div>
						</div>
					</div>
					<!-- The content half -->
					<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
						<div class="login d-flex align-items-center py-2">
							<!-- Demo content-->
							<div class="container p-0">
								<div class="row">
									<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
										<div class="mb-5 d-flex">
											<a href="index.html"><img src="../../assets/img/brand/favicon.png" class="sign-favicon-a ht-40" alt="logo">
											<img src="../../assets/img/brand/favicon-white.png" class="sign-favicon-b ht-40" alt="logo">
											</a>
											<h1 class="main-logo1 ms-1 me-0 my-auto tx-28">Va<span>le</span>x</h1>
										</div>
										<div class="main-card-signin d-md-flex bg-white">
											<div class="wd-100p">
												<div class="main-signin-header">
													<h2>Forgot Password!</h2>
													<h4>Please Enter Your Email</h4>
													@if ($errors->any())
											@foreach ($errors->all() as $error)
											<div class="container">
											<div class="alert alert-solid-danger mg-b-0" role="alert">
															<button aria-label="Close" class="close" data-bs-dismiss="alert" type="button">
																	<span aria-hidden="true">&times;</span>
															</button>
															<strong>Oh snap!</strong> {{ $error }}
											</div>
											</div>
																	<!-- <div style="color: red;font-size: 20px;">{{$error}}</div> -->
															@endforeach
													@endif
													<form method="POST" action="{{ route('password.email') }}">

													@csrf
													<div class="form-group">
															<label>Email</label> <input class="form-control" placeholder="Enter your email" type="email" name='email' id='email'>
														</div>
														<button class="btn btn-main-primary btn-block">Send</button>
													</form>
												</div>
												<div class="main-signup-footer mg-t-20">
													<p>Forget it, <a href="./"> Send me back</a> to the sign in screen.</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div><!-- End -->
						</div>
					</div><!-- End -->
				</div>
			</div>
			@endsection