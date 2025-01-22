@extends('layouts.admin1')

@section('title')
    Edit Password {{ $item->name }}
@endsection

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
                <div class="header" style="background-color: #0B20E9; color: white; border-radius: 8px 8px 0 0;">
                    <h6 class="card-title text-left" style="padding-left:50px;">Edit Kata Sandi</h6>
                </div>
                <div class="card-body p-5">

                    <!-- Explanation -->
                    <div class="mb-4"
                        style="color: #4A4A4A; font-size: 14px; line-height: 3; border-left: 4px solid #0B20E9; padding-left: 15px;
                                background-color: #FFFFFF; border-radius: 7px; box-shadow: 0 4px 7px rgba(0, 0, 0, 0.02);">
                        <p>
                            Ubah password dengan hati-hati. Pastikan kata sandi yang Anda masukkan aman dan sesuai dengan
                            kebijakan sistem.
                        </p>
                    </div>

                    <!-- Form -->
                    <form action="/admin/user/editpassword/{{ $item->id }}" method="POST" enctype="multipart/form-data"
                        style="border: 1px solid #0B20E9; border-radius: 7px; padding: 20px; background-color: #ffffff;">
                        @method('PUT')
                        @csrf

                        <!-- Password Section -->

                        <div class="form-group mb-4">
                            <label for="password" style="font-weight: 600;">Kata Sandi Baru</label>
                            <div style="position: relative;">
                                <input type="password" name="password" id="password" autocomplete="new-password"
                                    class="form-control shadow-sm"
                                    style="border: 1px solid #0B20E9; border-radius: 7px; padding: 10px; padding-right: 35px; background-color: #f5f8fd;"
                                    placeholder="Minimal 8 karakter, kombinasi huruf besar, kecil & angka"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                                    title="Kata sandi harus memiliki minimal 8 karakter, kombinasi huruf besar, huruf kecil, dan angka"
                                    required>
                                <!-- Ikon mata -->
                                <span class="toggle-password" onclick="togglePasswordVisibility()"
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                                    <i id="eyeIcon" class="fa fa-eye-slash" style="color: #0B20E9;"></i>
                                </span>
                            </div>
                            <small class="form-text text-muted" style="margin-top: 5px;">Kata sandi minimal 8 karakter, harus mengandung huruf besar, huruf kecil, dan angka</small>
                        </div>


                        <!-- Save Button -->
                        <div class="text-right mt-5">
                            <button type="submit" class="btn px-5 py-2">
                                Simpan
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Hover and Focus Effects -->
    <style>
        .header {
        background-color: #0B20E9;
        color: white;
        font-weight: bold;
        padding-bottom: 10px;
        padding-top: 20px;
    }
        .form-control:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .form-control:focus {
            box-shadow: 0 4px 12px rgba(11, 32, 233, 0.2);
            border-color: #0B20E9;
        }

        .btn {
            background-color: #0B20E9; /* Button Color */
            color: #FFFFFF;
            font-weight: 500;
            border: none;
            border-radius: 7px;
            padding: 10px 20px;
            box-shadow: 0px 6px 10px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
        }

        .btn:hover {
            background-color: #E8F0FE; /* Button Hover Color */
            color: #0B20E9;
            border: 2px solid #0B20E9;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        h2 {
            position: relative;
        }

        h2::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background-color: #0B20E9;
            margin: 8px auto 0;
            border-radius: 2px;
        }

        div.mb-4 p {
            margin: 0;
            transition: all 0.3s ease;
        }
    </style>
<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.remove("fa-eye-slash");
            eyeIcon.classList.add("fa-eye");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("fa-eye");
            eyeIcon.classList.add("fa-eye-slash");
        }
    }
   </script>
@endsection
