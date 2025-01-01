<!-- resources/views/emails/verify_email.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Contact Verification</title>
</head>
<body>
    <p>Hello Admin,</p>
    <p>You have a new contact submission:</p>
    <p>Name: {{ $contact->name }}</p>
    <p>Email: {{ $contact->email }}</p>
    <p>Phone: {{ $contact->phone_no }}</p>
    <p>Message: {{ $contact->message }}</p>
    <p>Verification Token: {{ $contact->verification_token }}</p>
</body>
</html>
