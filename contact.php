<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .header {
            background-color: #f9f9f9;
            padding: 50px 30px;
            display: flex;
            justify-content: flex-end;
            text-transform: uppercase;
            font-size: 20px;
        }

        .header ul {
            list-style-type: none;
            display: flex;
        }

        .header li {
            display: inline;
            margin: 0 15px;
        }

        .header a {
            text-decoration: none;
            color: black;
        }

        .content {
            text-align: center;
            flex: 1;
            padding: 50px 20px;
        }

        .content p {
            font-size: 18px;
            margin-bottom: 20px;
            color: #333;
        }

        .content h2 {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
        }

        footer .emails {
            margin-bottom: 10px;
            font-size: 14px;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        footer .emails a {
            text-decoration: none;
            color: white;
        }

        footer .emails a:hover {
            text-decoration: underline;
        }

        footer p {
            font-size: 12px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <header class="header">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Our Animals</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#" class="active">Contact</a></li>
        </ul>
    </header>
    <main class="content">
        <p>If you're interested in making a difference, please contact us at:</p>
        <h2>OFFICIAL DONATION CHANNEL</h2>
    </main>
    <footer>
        <div class="emails">
            <a href="mailto:example@gmail.com">example@gmail.com</a>
            <a href="mailto:example@gmail.com">example@gmail.com</a>
            <a href="mailto:example@gmail.com">example@gmail.com</a>
        </div>
        <p>&copy; 2024 Animal Adoption Organization. All Rights Reserved.</p>
    </footer>
</body>
</html>
