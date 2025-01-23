@extends('layouts.admin1')

@section('title', 'Create Task')


@section('content')


<div class="row justify-content-center">
    <div class="col-md-10">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow-sm border-0 mb-5"
            style="border-radius: 7px; background-color: #E8F0FE; transition: transform 0.3s, box-shadow 0.3s;">
            <div class="header" style="background-color: #0B20E9; color: white; border-radius: 8px 8px 0 0; padding: 20px;">
                <h5 class="card-title">Tambah Task Baru</h5>
            </div>

            <div class="card-body p-5">
                <!-- Penjelasan -->
                <div class="mb-4"
                    style="color: #4A4A4A; font-size: 14px; line-height: 1.6; border-left: 4px solid #0B20E9; padding-left: 15px; background-color: #FFFFFF; border-radius: 7px;">
                    <p>Isi informasi task dengan lengkap dan jelas. Data ini akan membantu dalam manajemen task dan alur pekerjaan yang lebih efisien.</p>
                </div>

                <!-- Formulir -->
                <form action="{{ route('task.store') }}" method="POST" enctype="multipart/form-data"
                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                    @csrf

                    <!-- Pilih Proyek -->

                    <div class="form-group">
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Pilih Project (Opsional)</h6>
                        <div class="form-group mb-4">
                            <label for="id" style="font-weight: 600;">Project</label>
                            <select name="id" id="id_projects" class="js-example-basic-single1 select-2  form-control shadow-sm"
                                style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;">
                                <option value="">Tidak Ada</option>
                                @foreach($projects as $project)
                                    <option value="{{ $project->id }}">{{ $project->id }} - {{ $project->name }} - {{ $project->client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <h6 class="mb-3" style="color: #0B20E9; font-weight: bold;">Status</h6>
                        <select name="status" class="form-control shadow-sm" style="border: 1px solid #0B20E9; border-radius: 7px;">
                            <option value="On-Going" selected>On-Going</option>
                        </select>
                    </div>

                    <div class="form-group mb-4">
                        <label for="id" style="font-weight: 600;">Pilih Pengguna</label>
                        <select name="id" class="js-example-basic-single form-control shadow-sm"
                            style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" required>
                            <option value="">Pilih Pengguna</option>
                            @foreach($user as $u)
                                <option value="{{ $u->id }}">{{ $u->id }} - {{ $u->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Judul Task -->
                    <div class="form-group mb-4">
                        <label for="title" style="font-weight: 600;">Judul Task</label>
                        <input type="text" name="title" id="title" class="form-control shadow-sm"
                            style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                            placeholder="Masukkan judul tugas" required>
                    </div>

                    <!-- Deskripsi Task -->
                    <div class="form-group mb-4">
                        <label for="description" style="font-weight: 600;">Deskripsi Task</label>
                        <textarea name="description" id="description" class="form-control shadow-sm"
                            style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;"
                            rows="5" placeholder="Masukkan deskripsi tugas" required></textarea>
                    </div>

                    <!-- Upload Gambar -->
                    <div class="form-group mb-4">
                        <label for="image" style="font-weight: 600;">Upload Gambar</label>
                        <input type="file" name="image[]" id="image" class="form-control shadow-sm"
                            style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; background-color: #f5f8fd;" multiple
                            accept="image/jpeg,image/png,application/pdf">
                        <small class="form-text text-muted">Anda bisa menambahkan banyak File. Format yang didukung: JPG, PNG, PDF. Setiap File Maks 3 MB </small>
                    </div>


                    <!-- Tombol Kirim -->
                    <div class="text-right">
                        <button type="submit" class="btn px-5 py-2"
                            style="background-color: #0B20E9; color: white; border-radius: 7px;">
                            Buat Task
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const files = event.target.files;
        const maxSize = 3 * 1024 * 1024; // 3 MB
        const allowedExtensions = ['jpg', 'jpeg', 'png', 'pdf'];
        let isValid = true;

        for (let file of files) {
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                alert(`Format file ${file.name} tidak didukung. Hanya JPG, PNG, dan PDF yang diizinkan.`);
                isValid = false;
            }

            if (file.size > maxSize) {
                alert(`Ukuran file ${file.name} melebihi 3 MB.`);
                isValid = false;
            }
        }

        if (!isValid) {
            event.target.value = ''; // Reset input file jika ada file tidak valid
        }
    });
    </script>



@push('addon-script')


<script>
    $(document).ready(function() {
        $('.js-example-basic-single').select2({
            placeholder: "Pilih Pengguna",
            allowClear: true
        });

    $(document).ready(function() {
        $('.js-example-basic-single1').select2({
            placeholder: "Pilih Proyek",
            allowClear: true
        });
    }); });
</script>
@endpush

@endsection
