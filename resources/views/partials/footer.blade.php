<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
</head>
<body>
    <footer>
        <div class="footer-content">
            <a href="#">Info</a>
            <p>&copy; 2025 LESSA. All rights reserved.</p>
        </div>
        <style>
            footer {
                background-color: #011B40;
                color: white;
                text-align: center;
                padding: 1rem 0;
                position: relative;
                border-radius: 8px;
                margin: 5px;
            }
            .footer-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 0 1.5rem;
            }
            .footer-content p {
                margin: 0;
            }
            .footer-content a {
                color: white;
                text-decoration: none;
                font-weight: 600;
                transition: color 0.3s ease;
            }
            @media screen and (max-width: 768px) {
                .footer-content {
                    flex-direction: column;
                    align-items: center;
                }
                .footer-content a {
                    margin-bottom: 0.5rem;
                }
                
            }

        </style>
    </footer>
</body>
</html>