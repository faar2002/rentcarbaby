<!-- resources/views/emails/password.blade.php -->

Click here to reset your password: {{ url('http://localhost:8000/password/reset/'.$token) }}