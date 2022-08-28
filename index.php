<?php 
    // For the alert
    $alert_message = '';
    $alert_class   = '';


    // Check for the submit
    if(filter_has_var(INPUT_POST, 'submit')) {
        // Get the form data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        // Check required fields
        if(!empty($name) && !empty($email) && !empty($message)) {
            // Passed
            // Check email
            if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                // Failed
                $alert_message = 'Email is not valid';
                $alert_class   = 'alert alert-warning';

            } else {
                // Passed
                // Recipient Email
                $toEmail = 'zouhairsahtout66@gmail.com';
                // Subject
                $subject = 'Contact Request From ' . $name;
                // Email Body
                $body = '<h2>Contact Request </h2>
                         <h4>Name</h4><p>' . $name .'</p>
                         <h4>Email</h4><p>' . $email . '</p>
                         <h4>Message</h4><p>' . $message . '</p>
                ';

                // Email headers
                $headers = "MIME-Version: 1.0" . "\r\n";
                // Append to the headers
                $headers .= "Content-Type:text/html; charset=UTF-8" . "\r\n";
                
                // Additional Headers (from:..)
                $headers .= "From: " . $name . "<" . $email . ">" . "\r\n";

                if(mail($toEmail, $subject, $body, $headers)) {
                    // Email sent
                    $alert_message = 'Your email has been sent';
                    $alert_class   = 'alert alert-success';

                } else {
                    $alert_message = 'You email was not sent';
                    $alert_class   = 'alert alert-danger';
                }
                
            }


        } else {
            $alert_message = "Please fill in all fields";
            $alert_class   = "alert alert-danger";

        }



    }


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://bootswatch.com/5/cosmo/bootstrap.min.css">
        <title>Contact Us</title>
    </head>

    <body>
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Contact Us</a>
                </div>
            </div>
        </nav>

        <div class="container">
            <!-- Set alert if the user submit with empty fields -->
            <?php if($alert_message != ''): ?>
                <div class="<?php echo $alert_class; ?>"><?php echo $alert_message; ?></div>
            <?php endif; ?>

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
                </div>
                <br>
                <button type="submit" name="submit" class="btn btn-primary form-control">Submit</button> 
                </div>

            </form>
        </div>

        
    </body>

</html>