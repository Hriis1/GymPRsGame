<?php
require_once __DIR__ . "/../components/topScript.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymPRs — Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/main.css" rel="stylesheet">
    <link href="../assets/css/authentication.css" rel="stylesheet">
</head>

<body>
    <div class="page-layer">
        <div class="page-wrap">
            <div class="card card-gym">
                <div class="card-body p-4 p-lg-4">

                    <div class="mb-3">
                        <div class="brand">
                            <div class="brand-badge">G</div>
                            GymPRs
                        </div>
                        <div class="sub">Create your account and open your own gym!</div>
                    </div>

                    <form method="POST" action="<?= $projectRoot; ?>/backend/auth/register.php" id="registerForm"
                        novalidate>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <input name="username" type="text" class="form-control" required minlength="3"
                                maxlength="20" autocomplete="username">
                            <div class="mini mt-1">3–20 characters.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input name="email" type="email" class="form-control" required autocomplete="email"
                                placeholder="you@example.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <input name="password" type="password" class="form-control" required minlength="8"
                                    autocomplete="new-password" id="pass">
                                <button class="btn btn-outline-secondary" type="button" id="togglePass">Show</button>
                            </div>
                            <div class="mini mt-1">At least 8 characters.</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Confirm password</label>
                            <input name="password_confirm" type="password" class="form-control" required minlength="8"
                                autocomplete="new-password" id="pass2">
                        </div>

                        <!-- <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a class="muted-link" href="#">Terms</a>.
                            </label>
                        </div> -->

                        <button class="btn btn-primary w-100" type="submit">Create Account</button>

                        <div class="text-center mt-3 mini">
                            Already have an account? <a class="muted-link" href="<?= $projectRoot ?>/login.php">Log
                                in</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php
    require_once __DIR__ . "/../components/scripts.php";
    ?>

    <script>
        $(function () {

            const $pass = $('#pass');
            const $pass2 = $('#pass2');
            const $toggle = $('#togglePass');

            // Show / Hide password
            $toggle.on('click', function () {
                const isHidden = $pass.attr('type') === 'password';

                $pass.attr('type', isHidden ? 'text' : 'password');
                $(this).text(isHidden ? 'Hide' : 'Show');
            });

            // Form submit
            $('#registerForm').on('submit', function (e) {
                e.preventDefault();

                //make fields valid
                $('#registerForm .is-invalid').each(function () {
                    this.setCustomValidity('');
                    $(this).removeClass('is-invalid');
                });

                //Check passwords
                if ($pass.val() !== $pass2.val()) {
                    $pass2.addClass('is-invalid');
                    $pass2[0].setCustomValidity('Passwords do not match');
                    $pass2[0].reportValidity();
                    return;
                }

                //Submit the form
                submitForm("#registerForm", "../backend/users/userRouter.php", "registerUser", false, function (res) {

                    if (res == 1) { //No errors
                        window.location.href = '../game.php'; //redirect user to game page
                        return;
                    }

                    //Handle error
                    if (res == -1) { //invalid username
                        const $username = $('input[name="username"]');
                        $username.addClass('is-invalid');
                        $username[0].setCustomValidity('Enter a valid username');
                        $username[0].reportValidity();
                    } else if (res == -2) { //invalid email
                        const $email = $('input[name="email"]');
                        $email.addClass('is-invalid');
                        $email[0].setCustomValidity('Enter a valid email');
                        $email[0].reportValidity();
                    } else if (res == -3) { //invalid password
                        $pass.addClass('is-invalid');
                        $pass[0].setCustomValidity('Password is too short');
                        $pass[0].reportValidity();
                    } else if (res == -4) { //passwords do not match
                        $pass2.addClass('is-invalid');
                        $pass2[0].setCustomValidity('Passwords do not match');
                        $pass2[0].reportValidity();
                    } if (res == -5) { //invalid username
                        const $username = $('input[name="username"]');
                        $username.addClass('is-invalid');
                        $username[0].setCustomValidity('Username already taken');
                        $username[0].reportValidity();
                    } else if (res == -6) { //email taken
                        const $email = $('input[name="email"]');
                        $email.addClass('is-invalid');
                        $email[0].setCustomValidity('Email is already taken');
                        $email[0].reportValidity();
                    }

                });
            });

        });
    </script>

</body>

</html>