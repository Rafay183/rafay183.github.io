
<?php

/**
 * BootstrapMade PHP Email Form
 * Secure contact form handler
 */

$receiving_email_address = 'rafayshaikh633@gmail.com';

// Load PHP Email Form Library
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    echo 'Unable to load the PHP Email Form Library!';
    exit;
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo 'Invalid request method.';
    exit;
}

// Get form data
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validate required fields
if ($name === '' || $email === '' || $message === '') {
    echo 'Please fill in all required fields.';
    exit;
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo 'Please enter a valid email address.';
    exit;
}

// Prevent email header injection
if (preg_match('/[\r\n]/', $name) || preg_match('/[\r\n]/', $email)) {
    echo 'Invalid input detected.';
    exit;
}

// Clean subject
$subject = preg_replace('/[\r\n]+/', ' ', $subject);

if ($subject === '') {
    $subject = 'New Website Contact Form Submission';
}

// Initialize PHP Email Form
$contact = new PHP_Email_Form;

$contact->ajax = true;

// Receiver
$contact->to = $receiving_email_address;

// Sender
$contact->from_name = $name;
$contact->from_email = $email;
$contact->subject = $subject;

// Add form details
$contact->add_message($name, 'Name');
$contact->add_message($email, 'Email');
$contact->add_message($subject, 'Subject');
$contact->add_message($message, 'Message', 10);

// Send
echo $contact->send();

?>
```
