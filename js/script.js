// password  toggler
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#exampleInputPassword1");

togglePassword.addEventListener("click", function (e) {
  // toggle the type attribute
  const type =
    password.getAttribute("type") === "password" ? "text" : "password";
  password.setAttribute("type", type);

  // toggle the eye / eye-slash icon
  this.querySelector("i").classList.toggle("fa-eye");
  this.querySelector("i").classList.toggle("fa-eye-slash");
});

window.onload = function () {
  // Select the form by its ID and reset it
  document.getElementById("login_form").reset();
};

