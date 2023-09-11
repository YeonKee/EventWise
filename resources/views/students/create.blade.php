@extends('layoutFront');

<style>
    body {
        overflow: hidden;
        /* Hide scrollbars */
    }
</style>

@section('body')
    <section class="signup">
        <div class="container">
            <form method="POST" class="register-form" id="register-form" action="/students/register" enctype="multipart/form-data">
                @csrf
                <div class="signup-content">
                    <div class="form-group input-group signup-image">
                        <label for="profile-input">
                            <img id="profile_preview" class="mx-auto rounded-circle" src="/img/default_profile.png" />
                        </label>
                        <input id="profile-input" class="d-none" type="file" name="profile"
                            accept=".gif, .jpg, .jpeg, .png" capture>
                        @error('profile')
                            <small class="text-danger profile-class" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror
                    </div>

                    <div class="signup-form">
                        <h2 class="form-title">Register Account</h2>
                        <div class="form-group">
                            <label for="name"><i class="fa-solid fa-user"></i></i></label>
                            <input type="text" name="name" id="name" placeholder="Name" />
                        </div>
                        @error('name')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group">
                            <label for="id"><i class="fa-solid fa-id-card"></i></label>
                            <input type="text" name="id" id="id" placeholder="Student ID" />
                        </div>
                        @error('id')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group">
                            <label for="email"><i class="fa-solid fa-envelope"></i></label>
                            <input type="email" name="email" id="email" placeholder="School Email" />
                        </div>
                        @error('email')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group">
                            <label for="re-address"><i class="fa-solid fa-location-dot"></i></label>
                            <input type="textarea" name="address" id="address" placeholder="Address" />
                        </div>
                        @error('address')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group">
                            <label for="pass"><i class="fa-solid fa-lock"></i></label>
                            <input type="password" name="pass" id="pass" placeholder="Password" />
                        </div>
                        @error('pass')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group">
                            <label for="re-pass"><i class="fa-solid fa-lock"></i></label>
                            <input type="password" name="re_pass" id="re_pass" placeholder="Re-enter Password" />
                        </div>
                        @error('re_pass')
                            <small class="text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </small>
                        @enderror

                        <div class="form-group form-button">
                            <input type="submit" name="signup" id="signup" class="form-submit" value="Register" style="font-weight: bold" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        const profileInput = document.getElementById('profile-input');
        const profilePreview = document.getElementById('profile_preview');

        profileInput.addEventListener('change', function() {
            const selectedFile = this.files[0];

            if (selectedFile) {
                // To read the selected file
                const reader = new FileReader();

                reader.onload = function(e) {
                    // Updates src of profilePreview image to display user selected image
                    profilePreview.src = e.target.result;
                };

                reader.readAsDataURL(selectedFile);
            }
        });
    </script>
@endsection
