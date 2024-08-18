@extends('layouts.app')

@section('title', 'Kontak Kami')

@include('layouts.nav.navbar_user')

@section('content')

<div class="container-fluid contact bg-light py-5">
    <div class="container py-5">
        <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
            <h4 class="text-primary">Kontak Kami</h4>
            <h1 class="display-4 mb-4">Jika Anda memiliki komentar, silakan ajukan sekarang</h1>
        </div>
        <div class="row g-5">
            <div class="col-xl-6 wow fadeInLeft" data-wow-delay="0.2s">
                <div class="contact-img d-flex justify-content-center">
                    <div class="contact-img-inner">
                        <img src="assets/images/cic.jpg" class="img-fluid w-100" alt="Image">
                    </div>
                </div>
            </div>
            <div class="col-xl-6 wow fadeInRight" data-wow-delay="0.4s">
                <div>
                    <h4 class="text-primary text-center">Kirim Saran</h4>
                    <p class="mb-4">Kirim saran atau komentar kamu tentang event yang sudah kamu ikuti</p>
                    <form>
                        <div class="row g-3">
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-0" id="name" placeholder="Your Name">
                                    <label for="name">Nama</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control border-0" id="email" placeholder="Your Email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6 my-2">
                                <div class="form-floating">
                                    <input type="tel" class="form-control border-0" id="phone" placeholder="Phone">
                                    <label for="phone">No telepon</label>
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6 my-2">
                                <div class="form-floating">
                                    <input type="text" class="form-control border-0" id="project" placeholder="Project">
                                    <label for="project">Nama Event</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control border-0" placeholder="Leave a message here" id="message" style="height: 120px"></textarea>
                                    <label for="message">Pesan</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary w-100 py-3 my-3">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bagian kontak informasi -->
        <div class="row g-4">
            <div class="col-md-3 wow fadeInUp" data-wow-delay="0.2s">
                <div class="contact-add-item">
                    <div class="contact-icon text-primary mb-4">
                        <i class="fas fa-map-marker-alt fa-2x"></i>
                    </div>
                    <div>
                        <h4>Alamat</h4>
                        <p class="mb-0">Jl. Kesambi No.202, Drajat, Kec. Kesambi, Kota Cirebon, Jawa Barat 45133</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 wow fadeInUp" data-wow-delay="0.4s">
                <div class="contact-add-item">
                    <div class="contact-icon text-primary mb-4">
                        <i class="fas fa-envelope fa-2x"></i>
                    </div>
                    <div>
                        <h4>Mail Us</h4>
                        <p class="mb-0">@cic.ac.id</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 wow fadeInUp" data-wow-delay="0.6s">
                <div class="contact-add-item">
                    <div class="contact-icon text-primary mb-4">
                        <i class="fa fa-phone-alt fa-2x"></i>
                    </div>
                    <div>
                        <h4>Telephone</h4>
                        <p class="mb-0">0231 200418</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 wow fadeInUp" data-wow-delay="0.8s">
                <div class="contact-add-item">
                    <div class="contact-icon text-primary mb-4">
                        <i class="fab fa-firefox-browser fa-2x"></i>
                    </div>
                    <div>
                        <h4>Website</h4>
                        <p class="mb-0">www.cic.ac.id</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Bagian Google Maps -->
        <div class="col-12 wow fadeInUp mt-5" data-wow-delay="0.2s">
            <div class="rounded">
                <iframe class="rounded w-100" 
                    style="height: 400px;" 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.2964098273665!2d108.55051807441717!3d-6.733646665838223!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f1d8ebc133e3f%3A0x91385801f5822049!2sUniversitas%20Catur%20Insan%20Cendekia%20(CIC)!5e0!3m2!1sid!2sid!4v1723187717759!5m2!1sid!2sid" 
                    loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>

@endsection
