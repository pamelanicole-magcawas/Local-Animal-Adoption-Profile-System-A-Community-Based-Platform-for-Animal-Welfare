<?php
session_start();

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate CSRF token
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die('CSRF token mismatch');
    }

    // Validate form fields
    $required_fields = ['first_name', 'last_name', 'address', 'phone', 'email', 'adoption_reason', 'pet_preference', 'other_pets', 'living_situation', 'home_type', 'own_or_rent', 'landlord_permission', 'hours_alone', 'exercise_plan', 'vet_name', 'emergency_care', 'return_pet'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        }
    }

    // Validate email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    // Process form if no errors
    if (empty($errors)) {
        // TODO: Process the form data (e.g., save to database, send email)
        $success_message = "Thank you for submitting your adoption application!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adoption Application</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>ADOPTION APPLICATION</h1>
        <p class="note">* indicates required fields</p>
        
        <?php if (!empty($errors)): ?>
            <div class="error-messages">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (isset($success_message)): ?>
            <div class="success-message">
                <?php echo htmlspecialchars($success_message); ?>
            </div>
        <?php else: ?>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                
                <h2>APPLICANT'S INFO</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="first-name">Name *</label>
                        <div class="name-field">
                            <input type="text" id="first-name" name="first_name" placeholder="First" required value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>">
                            <input type="text" id="last-name" name="last_name" placeholder="Last" required value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="address">Address *</label>
                        <input type="text" id="address" name="address" required value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="phone">Phone *</label>
                        <input type="tel" id="phone" name="phone" required value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="adoption_reason">Reason for Adoption *</label>
                        <textarea id="adoption_reason" name="adoption_reason" required><?php echo isset($_POST['adoption_reason']) ? htmlspecialchars($_POST['adoption_reason']) : ''; ?></textarea>
                    </div>
                </div>

                <h2>QUESTIONNAIRE</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="pet_preference">Which pet are you interested in adopting? *</label>
                        <select id="pet_preference" name="pet_preference" required>
                            <option value="">Select an option</option>
                            <option value="cat" <?php echo (isset($_POST['pet_preference']) && $_POST['pet_preference'] === 'cat') ? 'selected' : ''; ?>>Cat</option>
                            <option value="dog" <?php echo (isset($_POST['pet_preference']) && $_POST['pet_preference'] === 'dog') ? 'selected' : ''; ?>>Dog</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Do you have any other pets? *</label>
                        <div class="radio-group">
                            <input type="radio" id="other_pets_yes" name="other_pets" value="yes" <?php echo (isset($_POST['other_pets']) && $_POST['other_pets'] === 'yes') ? 'checked' : ''; ?> required>
                            <label for="other_pets_yes">Yes</label>
                            <input type="radio" id="other_pets_no" name="other_pets" value="no" <?php echo (isset($_POST['other_pets']) && $_POST['other_pets'] === 'no') ? 'checked' : ''; ?> required>
                            <label for="other_pets_no">No</label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="living_situation">Describe your living situation: *</label>
                        <textarea id="living_situation" name="living_situation" required><?php echo isset($_POST['living_situation']) ? htmlspecialchars($_POST['living_situation']) : ''; ?></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="home_type">What type of home do you live in? *</label>
                        <select id="home_type" name="home_type" required>
                            <option value="">Select an option</option>
                            <option value="house" <?php echo (isset($_POST['home_type']) && $_POST['home_type'] === 'house') ? 'selected' : ''; ?>>House</option>
                            <option value="apartment" <?php echo (isset($_POST['home_type']) && $_POST['home_type'] === 'apartment') ? 'selected' : ''; ?>>Apartment</option>
                            <option value="condo" <?php echo (isset($_POST['home_type']) && $_POST['home_type'] === 'condo') ? 'selected' : ''; ?>>Condo</option>
                            <option value="other" <?php echo (isset($_POST['home_type']) && $_POST['home_type'] === 'other') ? 'selected' : ''; ?>>Other</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label>Do you own or rent your home? *</label>
                        <div class="radio-group">
                            <input type="radio" id="own" name="own_or_rent" value="own" <?php echo (isset($_POST['own_or_rent']) && $_POST['own_or_rent'] === 'own') ? 'checked' : ''; ?> required>
                            <label for="own">Own</label>
                            <input type="radio" id="rent" name="own_or_rent" value="rent" <?php echo (isset($_POST['own_or_rent']) && $_POST['own_or_rent'] === 'rent') ? 'checked' : ''; ?> required>
                            <label for="rent">Rent</label>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="landlord_permission">If you rent, do you have permission from your landlord to have a pet? *</label>
                        <select id="landlord_permission" name="landlord_permission" required>
                            <option value="">Select an option</option>
                            <option value="yes" <?php echo (isset($_POST['landlord_permission']) && $_POST['landlord_permission'] === 'yes') ? 'selected' : ''; ?>>Yes</option>
                            <option value="no" <?php echo (isset($_POST['landlord_permission']) && $_POST['landlord_permission'] === 'no') ? 'selected' : ''; ?>>No</option>
                            <option value="not_applicable" <?php echo (isset($_POST['landlord_permission']) && $_POST['landlord_permission'] === 'not_applicable') ? 'selected' : ''; ?>>Not Applicable</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="hours_alone">How many hours will the pet be alone each day? *</label>
                        <input type="number" id="hours_alone" name="hours_alone" min="0" max="24" required value="<?php echo isset($_POST['hours_alone']) ? htmlspecialchars($_POST['hours_alone']) : ''; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="exercise_plan">Describe your plan for exercising and socializing the pet: *</label>
                        <textarea id="exercise_plan" name="exercise_plan" required><?php echo isset($_POST['exercise_plan']) ? htmlspecialchars($_POST['exercise_plan']) : ''; ?></textarea>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="vet_name">Do you have a veterinarian? If yes, please provide their name: *</label>
                        <input type="text" id="vet_name" name="vet_name" required value="<?php echo isset($_POST['vet_name']) ? htmlspecialchars($_POST['vet_name']) : ''; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="emergency_care">Are you prepared to provide emergency medical care if needed? *</label>
                        <select id="emergency_care" name="emergency_care" required>
                            <option value="">Select an option</option>
                            <option value="yes" <?php echo (isset($_POST['emergency_care']) && $_POST['emergency_care'] === 'yes') ? 'selected' : ''; ?>>Yes</option>
                            <option value="no" <?php echo (isset($_POST['emergency_care']) && $_POST['emergency_care'] === 'no') ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="return_pet">If you can no longer care for the pet, will you return it to our shelter? *</label>
                        <select id="return_pet" name="return_pet" required>
                            <option value="">Select an option</option>
                            <option value="yes" <?php echo (isset($_POST['return_pet']) && $_POST['return_pet'] === 'yes') ? 'selected' : ''; ?>>Yes</option>
                            <option value="no" <?php echo (isset($_POST['return_pet']) && $_POST['return_pet'] === 'no') ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                </div>

                <button type="submit">Submit Application</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>