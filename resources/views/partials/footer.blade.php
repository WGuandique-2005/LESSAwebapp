<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <style>
        /* styles.css */

        .main-footer {
            background-color: #011B40;
            color: white;
            text-align: center;
            padding: 1.5rem 0;
            border-radius: 8px;
            margin: 10px;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.2);
        }

        .footer-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-link {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease, transform 0.2s ease;
            position: relative;
        }

        .footer-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background-color: #4CAF50;
            /* A nice contrasting color */
            left: 0;
            bottom: -5px;
            transition: width 0.3s ease;
        }

        .footer-link:hover {
            color: #4CAF50;
            transform: translateY(-2px);
        }

        .footer-link:hover::after {
            width: 100%;
        }

        .footer-copyright {
            margin: 0;
            font-size: 0.9rem;
            opacity: 0.8;
        }

        @media screen and (max-width: 768px) {
            .footer-container {
                flex-direction: column;
                padding: 0 1rem;
            }

            .footer-links {
                flex-direction: column;
                gap: 0.8rem;
                margin-bottom: 1rem;
            }

            .footer-link {
                font-size: 1rem;
            }

            .footer-copyright {
                font-size: 0.8rem;
            }
        }

        @media screen and (max-width: 480px) {
            .main-footer {
                padding: 1rem 0;
                margin: 5px;
            }

            .footer-links {
                gap: 0.6rem;
            }

            .footer-link {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <footer class="main-footer">
        <div class="footer-container">
            <div class="footer-links">
                <a href="{{ route('info') }}" class="footer-link">Info</a>
                <a href="#" class="footer-link">Privacy Policy</a>
                <a href="#" class="footer-link">Terms of Service</a>
            </div>
            <p class="footer-copyright">&copy; 2025 LESSA. All rights reserved.</p>
        </div>
    </footer>
</body>

</html>