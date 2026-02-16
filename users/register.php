<?php
// register.php
session_start();

$projectRoot = $projectRoot ?? ''; // keep if you already use it elsewhere
$err = $_SESSION['register_error'] ?? '';
unset($_SESSION['register_error']);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>GymPRs — Register</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Page background: dark + concrete texture */
        body {
            min-height: 100vh;
            margin: 0;
            color: #e5e7eb;
            background: #0b0d10;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background-image: url("https://plus.unsplash.com/premium_photo-1733342465008-17e1bf41f55a?fm=jpg&q=60&w=3000&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8ZGFyayUyMGNvbmNyZXRlfGVufDB8fDB8fHww");
            background-size: cover;
            background-position: center;
            opacity: 0.35;
            /* visible but not too busy */
            filter: contrast(1.1) brightness(0.55);
            pointer-events: none;
            z-index: 0;
        }

        /* Slight dark overlay for readability */
        body::after {
            content: "";
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 30% 20%, rgba(37, 99, 235, 0.10), transparent 45%),
                rgba(0, 0, 0, 0.55);
            pointer-events: none;
            z-index: 0;
        }

        .page-wrap {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px 12px;
        }

        .card-gym {
            width: 100%;
            max-width: 440px;
            border-radius: 16px;
            background: rgba(16, 18, 20, 0.92);
            border: 1px solid rgba(255, 255, 255, 0.10);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.45);
            backdrop-filter: blur(8px);
        }

        .brand {
            letter-spacing: 0.5px;
            font-weight: 700;
            font-size: 18px;
            color: #fff;
        }

        .sub {
            color: rgba(203, 213, 225, 0.85);
            font-size: 14px;
        }

        .form-control {
            background-color: #0b0d10;
            border: 1px solid rgba(255, 255, 255, 0.14);
            color: #e5e7eb;
        }

        .form-control:focus {
            background-color: #0b0d10;
            color: #fff;
            border-color: rgba(37, 99, 235, 0.75);
            box-shadow: 0 0 0 .25rem rgba(37, 99, 235, .15);
        }

        .btn-primary {
            background: #1e3a8a;
            border-color: #1e3a8a;
        }

        .btn-primary:hover {
            background: #2563eb;
            border-color: #2563eb;
        }

        .muted-link {
            color: rgba(203, 213, 225, 0.9);
            text-decoration: none;
        }

        .muted-link:hover {
            color: #fff;
            text-decoration: underline;
        }

        .divider {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(203, 213, 225, 0.55);
            font-size: 12px;
            margin: 14px 0;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: rgba(255, 255, 255, 0.10);
        }
    </style>
</head>

<body>
    <div class="page-wrap">
        <div class="card card-gym">
            <div class="card-body p-4 p-lg-4">

                <div class="mb-3 text-center">
                    <div class="brand">Create account</div>
                    <div class="sub">Join GymPRs and start building your gym.</div>
                </div>

                <?php if ($err): ?>
                    <div class="alert alert-danger py-2 mb-3" role="alert">
                        <?= htmlspecialchars($err, ENT_QUOTES, 'UTF-8') ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= $projectRoot ?>/backend/auth/register.php" id="registerForm" novalidate>

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input name="username" type="text" class="form-control" required minlength="3" maxlength="20"
                            autocomplete="username" placeholder="e.g. hristo123">
                        <div class="form-text text-secondary">3–20 characters.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" required autocomplete="email"
                            placeholder="you@example.com">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <input name="password" type="password" class="form-control" required minlength="8"
                                autocomplete="new-password" id="pass">
                            <button class="btn btn-outline-light" type="button" id="togglePass">Show</button>
                        </div>
                        <div class="form-text text-secondary">At least 8 characters.</div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm password</label>
                        <input name="password_confirm" type="password" class="form-control" required minlength="8"
                            autocomplete="new-password" id="pass2">
                    </div>

                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="terms" required>
                        <label class="form-check-label" for="terms">
                            I agree to the <a class="muted-link" href="#">Terms</a>.
                        </label>
                    </div>

                    <button class="btn btn-primary w-100 py-2" type="submit">
                        Create Account
                    </button>

                    <div class="divider">or</div>

                    <div class="text-center small text-secondary">
                        Already have an account?
                        <a class="muted-link" href="<?= $projectRoot ?>/login.php">Log in</a>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
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