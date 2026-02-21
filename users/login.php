<?php
require_once __DIR__ . "/../components/topScript.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymPRs — Login</title>

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
                    </div>

                    <form method="POST" action="<?= $projectRoot; ?>/backend/auth/login.php" id="loginForm">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Username</label>
                            <input name="username" type="text" class="form-control" required autocomplete="username">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <div class="input-group">
                                <input name="password" type="password" class="form-control" required minlength="8"
                                    autocomplete="current-password" id="pass">
                                <button class="btn btn-outline-secondary" type="button" id="togglePass">Show</button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                                <label class="form-check-label" for="remember">
                                    Remember me
                                </label>
                            </div>

                            <a class="muted-link mini" href="<?= $projectRoot ?>/users/forgotPassword.php">Forgot
                                password?</a>
                        </div>

                        <button class="btn btn-primary w-100" type="submit">Log In</button>

                        <div class="text-center mt-3 mini">
                            Don’t have an account? <a class="muted-link"
                                href="<?= $projectRoot ?>/users/register.php">Create
                                one</a>
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

            const $username = $('input[name="username"]');
            const $pass = $('#pass');
            const $toggle = $('#togglePass');

            // Show / Hide password
            $toggle.on('click', function () {
                const isHidden = $pass.attr('type') === 'password';

                $pass.attr('type', isHidden ? 'text' : 'password');
                $(this).text(isHidden ? 'Hide' : 'Show');
            });

            // Form submit
            $('#loginForm').on('submit', function (e) {
                e.preventDefault();

                $('#loginForm .is-invalid').removeClass('is-invalid'); // remove is-invalid classes

                //Submit the form
                submitForm("#loginForm", "../backend/users/userRouter.php", "logInUser", false, successFunc = function (res) {

                    if (res == 1) { //No errors
                        window.location.href = '../game.php'; //redirect user to game page
                        return;
                    }

                    //Error
                    $username.addClass('is-invalid');
                    $username[0].setCustomValidity('Incorrect username or password');
                    $username[0].reportValidity();
                });
            });

        });
    </script>

</body>

</html>