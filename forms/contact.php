// <?php
//   /**
//   * Requires the "PHP Email Form" library
//   * The "PHP Email Form" library is available only in the pro version of the template
//   * The library should be uploaded to: vendor/php-email-form/php-email-form.php
//   * For more info and help: https://bootstrapmade.com/php-email-form/
//   */

//   // Replace contact@example.com with your real receiving email address
//   $receiving_email_address = 'rafayshaikh633@gmail.com';

//   if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
//     include( $php_email_form );
//   } else {
//     die( 'Unable to load the "PHP Email Form" Library!');
//   }

//   $contact = new PHP_Email_Form;
//   $contact->ajax = true;
  
//   $contact->to = $receiving_email_address;
//   $contact->from_name = $_POST['name'];
//   $contact->from_email = $_POST['email'];
//   $contact->subject = $_POST['subject'];

//   // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
//   /*
//   $contact->smtp = array(
//     'host' => 'example.com',
//     'username' => 'example',
//     'password' => 'pass',
//     'port' => '587'
//   );
//   */

//   $contact->add_message( $_POST['name'], 'From');
//   $contact->add_message( $_POST['email'], 'Email');
//   $contact->add_message( $_POST['message'], 'Message', 10);

//   echo $contact->send();
// ?>




```php
<?php

/**
 * Secure BootstrapMade PHP Contact Form
 * Receives form submissions at:
 * rafayshaikh633@gmail.com
 */

$receiving_email_address = 'rafayshaikh633@gmail.com';

// Load PHP Email Form library
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Unable to load the PHP Email Form Library!');
}

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request.');
}

// Get form values safely
$name    = trim($_POST['name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Validate required fields
if ($name === '' || $email === '' || $message === '') {
    die('Please fill in all required fields.');
}

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die('Please enter a valid email address.');
}

// Prevent header injection
if (preg_match('/[\r\n]/', $name) || preg_match('/[\r\n]/', $email)) {
    die('Invalid input.');
}

// Clean subject
$subject = preg_replace('/[\r\n]+/', ' ', $subject);

if ($subject === '') {
    $subject = 'New Contact Form Message';
}

// Create contact form
$contact = new PHP_Email_Form;

// AJAX response
$contact->ajax = true;

// Receiver
$contact->to = $receiving_email_address;

// Sender information
$contact->from_name = $name;
$contact->from_email = $email;
$contact->subject = $subject;

// Add submitted information
$contact->add_message($name, 'Name');
$contact->add_message($email, 'Email');
$contact->add_message($subject, 'Subject');
$contact->add_message($message, 'Message', 10);

// Send email
echo $contact->send();

?>
```
