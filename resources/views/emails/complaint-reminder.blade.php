<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Form Reminder</title>
</head>
<body>
    <p>
        This this a reminder that this complaint was sent {{ $week }} ago, and still doesn't have an outcome.<br>
        Please update the complaint.
        <a href="{{ route('complaint-form.edit', $form->id) }}">Check the complaint</a>
    </p>
</body>
</html>
