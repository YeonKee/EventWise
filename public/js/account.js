const profileInput = document.getElementById('profile-input');
const profilePreview = document.getElementById('profile_preview');

function previewImage(event) {
    const reader = new FileReader();

    reader.onload = function (e) {
        profilePreview.src = e.target.result;
    };

    if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]);
    }
}

profileInput.addEventListener('change', function (event) {
    previewImage(event);
});

function togglePasswordVisibility() {
    var passwordInput = document.getElementById("pass");
    var icon = document.querySelector(".toggle-icon");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
}

function toggleRePasswordVisibility() {
    var passwordInput = document.getElementById("re_pass");
    var icon = document.querySelector(".toggle-icon-re");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
}

function toggleOldPasswordVisibility() {
    var passwordInput = document.getElementById("old_pass");
    var icon = document.querySelector(".toggle-icon-old");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    } else {
        passwordInput.type = "password";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    }
}