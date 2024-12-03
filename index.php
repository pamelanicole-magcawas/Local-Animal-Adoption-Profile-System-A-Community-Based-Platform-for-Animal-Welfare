<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="index_style.css">
</head>
<body>
    <div class="container" id="signup" style="display:none;">
        <h1 class="form-title">SIGN UP</h1>
        <form method="post" action="register.php" id="signupForm">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fName" id="fName" placeholder="Full Name" required>
                <label for="fName">Full Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="signUpEmail" placeholder="Email" required>
                <label for="signUpEmail">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <label for="password">Password</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password" required>
                <label for="password_confirmation">Confirm Password</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" name="signUp">
        </form>
        <p class="or">----------or----------</p>
        <div class="links">
            <p>Already Have Account?</p>
            <button id="signInButton">Sign In</button>
        </div>
    </div>
    <div class="container" id="signIn">
        <h1 class="form-title">LOG IN</h1>
        <form method="post" action="login.php" id="signInForm">
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="signInEmail" placeholder="Email" required>
                <label for="signInEmail">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="signInPassword" placeholder="Password" required>
                <label for="signInPassword">Password</label>
            </div>
            <input type="submit" class="btn" value="Sign In" name="signIn">
        </form>
        <p class="or">----------or----------</p>
        <div class="links">
            <p>Don't have an account yet?</p>
            <button id="signUpButton">Sign Up</button>
        </div>
    </div>
    <script src="login.js"></script>
</body>
</html>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal Shelter</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
    <nav class="asus">
        <ul>
            <li><a href="#" class="active">Home</a></li>
            <li><a href="#">Our Animals</a></li>
            <li><a href="#">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="#">Sign Up</a></li>
            <li><a href="#">Login</a></li>
        </ul>
    </nav>
    </header>
    <main>
        <section class="hero">
            <img src="background.jpg" alt="Dog">
            <h2>ANIMALS NEED</h2>
            <h1>Your Help!</h1>
            <p>You can chip in with money & effort. Dogs, Cats and Even Racoons Adopt Any Pets You Like!</p>
            <button><a href="donate.php">Donate Now</a></button>
            <button><a href="#">Adopt Now</a></button>
        </section>
</body>
</html>
>>>>>>> 394b005174481348641d7507a3632dfc58cb0574
