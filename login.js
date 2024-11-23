const signUpButton = document.getElementById('signUpButton');
const signInButton = document.getElementById('signInButton');
const signInForm = document.getElementById('signIn');
const signUpForm = document.getElementById('signup');

signUpButton.addEventListener('click', function () {
    signInForm.style.display = "none";
    signUpForm.style.display = "block";
});
signInButton.addEventListener('click', function () {
    signInForm.style.display = "block";
    signUpForm.style.display = "none";
});

const validation = new JustValidate("#signupForm");

validation
    .addField("#fName", [
        { rule: "required", errorMessage: "Name is required" }
    ])
    .addField("#signUpEmail", [
        { rule: "required", errorMessage: "Email is required" },
        { rule: "email", errorMessage: "Invalid email format" },
        {
            validator: (value) => () => {
                return fetch("validate-email.php?email=" + encodeURIComponent(value))
                    .then(function (response) {
                        return response.json();
                    })
                    .then(function (json) {
                        return json.available;
                    });
            },
            errorMessage: "Email already taken"
        }
    ])
    .addField("#password", [
        { rule: "required", errorMessage: "Password is required" },
        { rule: "password", errorMessage: "Invalid password format" }
    ])
    .addField("#password_confirmation", [
        {
            validator: (value, fields) => {
                return value === fields["#password"].elem.value;
            },
            errorMessage: "Passwords should match"
        }
    ])
    .onSuccess((event) => {
        document.getElementById("signupForm").submit();
    });
