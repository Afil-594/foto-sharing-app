<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FotoKu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f3f4f6; /* Light gray seperti Tailwind */
            color: #4b5563; /* text-gray-600 */
            display: flex; /* Flexbox untuk center vertikal */
            justify-content: center; /* Center horizontal */
            align-items: center; /* Center vertikal */
            min-height: 100vh; /* Pastikan body penuh tinggi layar */
        }

        .container {
            max-width: 1280px; /* max-w-7xl */
            margin: 0 auto; /* mx-auto */
            padding: 3rem 1rem; /* py-12, default padding */
            border: 2px solid #d1d5db; /* Border abu-abu */
            border-radius: 8px; /* Sudut melengkung */
            background-color: #ffffff; /* Background putih */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Bayangan halus */
        }

        @media (min-width: 640px) {
            .container {
                padding-left: 1.5rem; /* sm:px-6 */
                padding-right: 1.5rem;
            }
        }

        @media (min-width: 1024px) {
            .container {
                padding-left: 2rem; /* lg:px-8 */
                padding-right: 2rem;
            }
        }

        h1 {
            font-size: 1.875rem; /* text-3xl */
            font-weight: 700; /* font-bold */
            color: #1f2937; /* text-gray-800 */
            margin: 0;
        }

        p {
            margin-top: 1rem; /* mt-4 */
            color: #4b5563; /* text-gray-600 */
            line-height: 1.5;
            text-align: center; /* Teks dan link di tengah */
        }

        a {
            color: #2563eb; /* text-blue-600 */
            text-decoration: none;
            font-weight: 600; /* font-semibold */
        }

        a:hover {
            text-decoration: underline; /* hover:underline */
        }

        /* Simulasi dark mode (opsional) */
        .dark-mode h1 {
            color: #e5e7eb; /* dark:text-gray-200 */
        }

        .dark-mode {
            background-color: #1f2937; /* Background gelap */
            color: #e5e7eb;
        }

        .dark-mode .container {
            border-color: #4b5563; /* Border lebih gelap di dark mode */
            background-color: #374151; /* Background container gelap */
        }
        .logo {
        display: block;
            margin: 0 auto 1.5rem auto; /* Center + spacing bawah */
              height: 200px; /* Ukuran bisa disesuaikan */
            width: auto;
}

    </style>
</head>
<body>

    <div class="container">
    <img src="<?php echo asset('images/Fotoku.png'); ?>" alt="FotoKu Logo" class="logo">

        <h1>Welcome to FotoKu</h1>
        <p>
            Share your moments with the world!<br>
            <?php if (Auth::check()): ?>
                <a href="<?php echo route('dashboard'); ?>">Go to Dashboard</a>
            <?php else: ?>
                <a href="<?php echo route('login'); ?>">Login</a> |
                <a href="<?php echo route('register'); ?>">Register</a>
            <?php endif; ?>
        </p>
    </div>
</body>
</html>