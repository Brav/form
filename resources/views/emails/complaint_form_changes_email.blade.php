<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Report Changes</title>
</head>
<body>
<p>
    Complaint report for the following clinics has new changes: <br>
    <strong>{{ $clinic->name }}</strong><br>

    Latest updates:

    @foreach($changedFields as $key => $value)
        <strong>{{ ucwords(str_replace('_', ' ', $key)) }}</strong>: {{ $value }} <br>
    @endforeach

    You can view the complaint report by following this link: <br>
    <a href="{{ route('complaint-form.edit', $complaintForm->id) }}">Check the complaint</a>

</p>
<p>
    Regards, <br>
    Clinical Governance Team
</p>
</body>
</html>
