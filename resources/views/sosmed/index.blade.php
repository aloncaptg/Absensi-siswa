@extends('layouts.sb')

@section('content')
    <div class="container">
        <h1>Halaman Sosmed</h1>
        <p class="text-muted">Satu tab berisi link ke WhatsApp, Instagram, dan lainnya.</p>

        <div class="row">
            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-1"><i class="fab fa-whatsapp text-success"></i> WhatsApp</h5>
                            <small class="text-muted">Chat langsung melalui WhatsApp</small>
                        </div>
                        <a href="https://wa.me/" target="_blank" class="btn btn-success">Buka</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-1"><i class="fab fa-instagram" style="color:#C13584"></i> Instagram</h5>
                            <small class="text-muted">Profil Instagram</small>
                        </div>
                        <a href="https://instagram.com/" target="_blank" class="btn btn-primary">Buka</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-1"><i class="fab fa-facebook text-primary"></i> Facebook</h5>
                            <small class="text-muted">Halaman Facebook</small>
                        </div>
                        <a href="https://facebook.com/" target="_blank" class="btn btn-primary">Buka</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-1"><i class="fab fa-tiktok"></i> TikTok</h5>
                            <small class="text-muted">Akun TikTok</small>
                        </div>
                        <a href="https://tiktok.com/" target="_blank" class="btn btn-dark">Buka</a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-lg-4 mb-3">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title mb-1"><i class="fab fa-youtube text-danger"></i> YouTube</h5>
                            <small class="text-muted">Channel YouTube</small>
                        </div>
                        <a href="https://youtube.com/" target="_blank" class="btn btn-danger">Buka</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-info mt-3">
            Ingin link diarahkan ke akunmu? Kasih aku username/nomor (WA, IG, dll), nanti aku update URL-nya.
        </div>
    </div>
@endsection