<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/styles.css">
        <link rel="shortcut icon" type="image/x-icon" href="website_icon.ico" />

        <!-- =====BOX ICONS===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>
        <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/validate.js/0.13.1/validate.min.js"></script>

        <script type="module" src="lib/path.js"></script>

        

        <?php

        function strip_crlf($string)
        {
            return str_replace("\r\n", "", $string);
        }

        if (! empty($_POST["send"])) {
            $name = $_POST["userName"];
            $email = $_POST["userEmail"];
            $subject = $_POST["subject"];
            $content = $_POST["content"];

            $toEmail = "admin@phppot_samples.com";
            // CRLF Injection attack protection
            $name = strip_crlf($name);
            $email = strip_crlf($email);
            if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "The email address is invalid.";
            } else {
                // appending \r\n at the end of mailheaders for end
                $mailHeaders = "From: " . $name . "<" . $email . ">\r\n";
                if (mail($toEmail, $subject, $content, $mailHeaders)) {
                    $message = "Your contact information is received successfully.";
                    $type = "success";
                }
            }
        }
        require_once "contact-view.php";
        ?>

        <?php
            if (! empty($_POST["send"])) {
                $name = $_POST["userName"];
                $email = $_POST["userEmail"];
                $subject = $_POST["subject"];
                $content = $_POST["content"];
                $conn = mysqli_connect("localhost", "root", "test", "contactform_database") or die("Connection Error: " . mysqli_error($conn));
                $stmt = $conn->prepare("INSERT INTO tblcontact (user_name, user_email, subject,content) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $name, $email, $subject, $content);
                $stmt->execute();
                $message = "Your contact information is saved successfully.";
                $type = "success";
                $stmt->close();
                $conn->close();
            }
            require_once "contact-view.php";
        ?>




        <title>Nicholas Lauersdorf PhD</title>
    </head>
    <body>

        <!--===== HEADER =====-->
        <header class="l-header">
            <nav class="nav bd-grid">
                <div>
                    <a style="color: hsl(0, 0%, 0%);" href="index.html" class="nav__logo">Nicholas Lauersdorf</a>
                </div>

                <div style="color: hsl(0, 0%, 0%);" class="nav__menu" id="nav-menu">
                    <ul class="nav__list">
                        <li class="nav__item"><a style="color: hsl(0, 0%, 0%);" href="index.html" class="nav__link">Home</a></li>
                        <li class="nav__item"><a style="color: hsl(0, 0%, 0%);" href="about.html" class="nav__link">About</a></li>
                        <li class="nav__item"><a style="color: hsl(0, 0%, 0%);" href="experience.html" class="nav__link">Experience</a></li>
                        <li class="nav__item"><a style="color: hsl(0, 0%, 0%);" href="publications.html" class="nav__link">Publications</a></li>
                        <li class="nav__item"><a style="color: hsl(0, 0%, 0%);" href="contact.html" class="nav__link">Contact</a></li>
                    </ul>
                </div>

                <div class="nav__toggle" id="nav-toggle">
                    <i class='bx bx-menu'></i>
                </div>
            </nav>
        </header>
        <main class="l-main">
            <!--===== CONTACT =====-->
            <section class="contact section" id="contact">
                <div class="home__banner">
                    <video style="width: 100%" class="home__banner" alt "" autoplay loop muted>
                        <source src="assets/img/wallpaper.mp4" type="video/mp4">
                    </video>
                </div>
                <h2 class="section-title">Contact</h2>
                <?php echo((!empty($errorMessage)) ? $errorMessage : '') ?>
                <div class="contact__container bd-grid">
                    <form action="action_email.php" class="contact__form">
                        <input type="text" name="name" placeholder="Name" class="contact__input">
                        <input type="mail" name="email" placeholder="Email" class="contact__input">
                        <input type="text" name="subject" placeholder="Subject" class="contact__input">
                        <textarea name="message" id="" cols="0" rows="10" class="contact__input"></textarea>
                        <input type="button" value="Send" class="contact__button button">
                    </form>
                </div>
            </section>
        </main>
        <!--===== FOOTER =====-->
        <footer class="footer">
            <p class="footer__title">Nicholas Lauersdorf</p>
            <p class="footer__copy">Email: njlauersdorf@gmail.com</p>
            <div skills="color:rgb(255, 255, 255)" class="footer__social">
                <a skills="color:rgb(255, 255, 255)" href="https://www.linkedin.com/in/nicholaslauersdorf" class="footer__icon"><i class='bx bxl-linkedin' ></i></a>
                <a skills="color:rgb(255, 255, 255)" href="https://github.com/njlauersdorf/klotsa.git" class="footer__icon"><i class='bx bxl-github' ></i></a>
            </div>
            
        </footer>

        <!--===== SCROLL REVEAL =====-->
        <script src="https://unpkg.com/scrollreveal"></script>

        <!--===== MAIN JS =====-->
        <script src="assets/js/main.js"></script>

    </body>
</html>