<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Form</title>

    <!-- Bootsrap  -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>

    <!-- google font  -->

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
      rel="stylesheet"
    />
    <!-- icons  -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
    />
    <!-- local css  -->
    <link rel="stylesheet" href="../css/styles.css" />
  </head>
  <body class="d-flex align-items-center justify-content-center vh-100">
    <div class="container">
      <form
        class="form-group bg p-5 rounded-2 login-form"
        method="post"
        action="index.php"
        autocomplete="off"
        id="login_form"
      >
        <div class="mb-3">
          <h2 class="display-6 text-center">Login Form</h2>
          <label for="exampleInputEmail1" class="form-label mt-4"
            >Email address</label
          >
          <input
            type="email"
            name="email"
            class="form-control"
            id="exampleInputEmail1"
            aria-describedby="emailHelp"
           
          />
          <div id="emailHelp" class="form-text">
            We'll never share your email with anyone else.
          </div>
        </div>
        <label for="exampleInputPassword1" class="form-label mt-3"
          >Password</label
        >
        <div class="input-group">
          <input
            type="password"
            name="password"
            class="form-control"
            id="exampleInputPassword1"
            aria-label="Password"
            aria-describedby="togglePassword"
          />
          <button
            class="btn btn-outline-secondary"
            type="button"
            id="togglePassword"
          >
            <i class="fas fa-eye"></i>
          </button>
        </div>
        <div class="mb-3 form-check"></div>
        <button type="submit" name="login" class="btn">Login</button>
      </form>
    </div>
  </body>
  <script src="../js/script.js"></script>
</html>
