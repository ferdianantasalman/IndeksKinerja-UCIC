<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary"></i>Indeks Kinerja</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('assets_admin/img/user.jpg') }}" alt=""
                    style="width: 40px; height: 40px;">
                <div
                    class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1">
                </div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ $data['name'] }}</h6>
                <span>{{ $data['role'] }}</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="/admin/dashboard" class="nav-item nav-link active"><i
                    class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="/admin/bobotnilai" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>
                Nilai</a>
            <a href="/admin/categories" class="nav-item nav-link active"><i
                    class="fa fa-tachometer-alt me-2"></i>Kategori</a>
            <a href="/admin/questions" class="nav-item nav-link active"><i
                    class="fa fa-tachometer-alt me-2"></i>Pertanyaan</a>
            <a href="/admin/options" class="nav-item nav-link active"><i
                    class="fa fa-tachometer-alt me-2"></i>Jawaban</a>
            <a href="/admin/results" class="nav-item nav-link active"><i class="fa fa-tachometer-alt me-2"></i>Hasil</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="fa fa-laptop me-2"></i>Pendidikan</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="/admin/jenjang_pendidikan/questions" class="dropdown-item">Pertanyaan</a>
                    <a href="/admin/jenjang_pendidikan/options" class="dropdown-item">Jawaban</a>
                    <a href="/admin/jenjang_pendidikan/results" class="dropdown-item">Hasil</a>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i
                        class="fa fa-laptop me-2"></i>Fungsional</a>
                <div class="dropdown-menu bg-transparent border-0">
                    <a href="/admin/jenjang_fungsional/questions" class="dropdown-item">Pertanyaan</a>
                    <a href="/admin/jenjang_fungsional/options" class="dropdown-item">Jawaban</a>
                    <a href="/admin/jenjang_fungsional/results" class="dropdown-item">Hasil</a>
                </div>
            </div>
        </div>
    </nav>
</div>
