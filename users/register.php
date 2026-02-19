<?php
require_once __DIR__ . "/../topScript.php";
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

                        <div class="mb-3 form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a class="muted-link" href="#">Terms</a>.
                            </label>
                        </div>

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
    require_once __DIR__ . "/../scripts.php";
    ?>

    <script>
        const pass = document.getElementById('pass');
        const pass2 = document.getElementById('pass2');
        const toggle = document.getElementById('togglePass');

        toggle.addEventListener('click', () => {
            const isHidden = pass.type === 'password';
            pass.type = isHidden ? 'text' : 'password';
            toggle.textContent = isHidden ? 'Hide' : 'Show';
        });

        document.getElementById('registerForm').addEventListener('submit', (e) => {
            if (pass.value !== pass2.value) {
                e.preventDefault();
                alert('Passwords do not match.');
            }
        });
    </script>
</body>

</html>