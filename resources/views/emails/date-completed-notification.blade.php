<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Report Completion</title>
</head>
<body>
<p>
    Complaint Report Completion: <br>
    <strong>{{ $clinic->name }}</strong><br>

    Please note the complaint report has been marked as complete. The matter will now be consider closed.
    No further message will be sent. <br>

    You can view the complaint report by following this link: <br>
    <a href="{{ route('complaint-form.edit', $complaintForm->id) }}">Check the complaint</a>
</p>
<p>
    Regards, <br>
    Clinical Governance Team
</p>
</body>
</html>
