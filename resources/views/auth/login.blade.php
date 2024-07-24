@extends('layout.main')

@section('container')
    <div class="shapes-container">
        <div class="shape" data-aos="fade-down-left" data-aos-duration="1500" data-aos-delay="100"></div>
        <div class="shape" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100"></div>
        <div class="shape" data-aos="fade-up-right" data-aos-duration="1000" data-aos-delay="200"></div>
        <div class="shape" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"></div>
        <div class="shape" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>
        <div class="shape" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>
        <div class="shape" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300"></div>
        <div class="shape" data-aos="fade-down-right" data-aos-duration="500" data-aos-delay="200"></div>
        <div class="shape" data-aos="fade-down-right" data-aos-duration="500" data-aos-delay="100"></div>
        <div class="shape" data-aos="zoom-out" data-aos-duration="2000" data-aos-delay="500"></div>
        <div class="shape" data-aos="fade-up-right" data-aos-duration="500" data-aos-delay="200"></div>
        <div class="shape" data-aos="fade-down-left" data-aos-duration="500" data-aos-delay="100"></div>
        <div class="shape" data-aos="fade-up" data-aos-duration="500" data-aos-delay="0"></div>
        <div class="shape" data-aos="fade-down" data-aos-duration="500" data-aos-delay="0"></div>
        <div class="shape" data-aos="fade-up-right" data-aos-duration="500" data-aos-delay="100"></div>
        <div class="shape" data-aos="fade-down-left" data-aos-duration="500" data-aos-delay="0"></div>
    </div>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 bg-glass shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-2 mt-2">
                    <img src="/img/tablogo.png" class="img-fluid" style="width: 250px;">
                </div>
                <h4 class="mb-2 text-primary text-wrap text-center fw-bold">Sistem Informasi Puskesmas</h4>
                <h4 class="mb-4 text-primary text-wrap text-center fw-bold">(SIMPUS) Siulak Mukai</h4>
            </div>
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-3">
                        <h3 class="fw-bold">Selamat datang</h3>
                    </div>
                    @if (session('loginError'))
                        <div class="container">
                            <div class="alert alert-danger">
                                {{ session('loginError') }}
                            </div>
                        </div>
                    @else
                        <div class="container">
                            <div class="alert alert-primary">
                                Masukkan username dan password untuk melanjutkan
                            </div>
                        </div>
                    @endif
                    <form class="p-2" action="{{ route('auth') }}" method="post" autocomplete="off">
                        @csrf
                        <div class="form-floating mb-2">
                            <input type="text" class="form-control" id="floatingUsername" name="username" placeholder="Username">
                            <label for="floatingUsername">Username</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                            <label for="floatingPassword">Password</label>
                        </div>
                        <div class="input-group">
                            <button type="submit" class="btn btn-lg btn-danger w-100 fs-6">Login</button>
                        </div>
                    </form>
                    @can('checksuper')
                        <form action="{{ route('superuser') }}" method="post">
                            @csrf
                            @method('post')
                            <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Generate Super User</button>
                        </form>
                    @endcan
                </div>
            </div> 
        </div>
    </div>
    <footer class="shadow-none p-2 text-center fixed-bottom page-footer-home">
        <p class="mb-0 text-dark">Puskesmas Siulak Mukai © 2024. Developed by <a href="https://stenlyandika.github.io/" target="_blank" class="text-primary">Stenly Andika</a></p>
    </footer>
@endsection