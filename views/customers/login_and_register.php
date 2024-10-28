<link rel="stylesheet" href="../public/css/loginstyle.css" />
<!-- Bootstrap CSS -->
<link href="../public/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link href="../public/tiny-slider.css" rel="stylesheet">


<div class="container" id="container">
    <div class="form-container sign-up-container overflow-auto">
        <form  class='mt-3'id="registerForm" action="../php/handler_register.php" method="POST" onsubmit="return registerUser(event)">
            <input class='m-3' type="text" id="userName" name="username" placeholder="Username" >
            <input  type="text" id="firstName" name="first_name" placeholder="First Name" >
            <input class='m-3' type="text" id="lastName" name="last_name" placeholder="Last Name" >
            <input  type="email" id="email" name="email" placeholder="Email" >
            <input class='m-3' type="tel" id="phone" name="phone_number" placeholder="Phone Number" >
            <input  type="password" id="password" name="password" placeholder="Password" >
            <input  class='m-3' type="password" id="confirmPassword" name="confirm_password" placeholder="Confirm Password" >
            <button type="submit">Sign Up</button>
        </form>
    </div>
    <div class="form-container sign-in-container">
        <form action="../php/handler_login.php" method="POST" id="loginForm" onsubmit="return LoginUser(event)"  >
            <h1>Sign In</h1>
            <input type="email" name="email" placeholder="Email" id="loginEmail"  />
            <input class='m-3' type="password" name="password" placeholder="Password" id="loginPassword"  />
            <button id="loginSubmit" type="submit">Sign In</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Welcome Back!</h1>
                <p>To keep connected with us please login with your personal info</p>
                <button class="ghost" id="signIn">Sign In</button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Hello, Friend!</h1>
                <p>Enter your personal details and start with us</p>
                <button class="ghost" id="signUp">Sign Up</button>
            </div>
        </div>
    </div>
</div>

<script>

    document.addEventListener('DOMContentLoaded', function() {
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');
        const registerForm = document.getElementById('registerForm');
        const loginForm = document.getElementById('loginForm');
        const userName = document.getElementById("userName").value;
        const firstName = document.getElementById("firstName").value;
        const lastName = document.getElementById("lastName").value;
        const email = document.getElementById("email").value;
        const phone = document.getElementById("phone").value;
        const password = document.getElementById("password").value;
        const confirmPassword = document.getElementById("confirmPassword").value;
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });

        registerForm.addEventListener('submit', function(event) {
            event.preventDefault();
            if (validateRegisterForm()) {
                submitRegisterForm();
            }
        });

        loginForm.addEventListener('submit', function(event) {
            event.preventDefault();
            if (validateLoginForm()) {
                submitLoginForm();
            }
        });
    });

</script>


