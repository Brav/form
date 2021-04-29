<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complaint Form Filled</title>
</head>
<body>

    <p>
        Form informations: <br>
        Clinic: {{ $form->clinic->name }} <br>
        Regional Manager: {{ $form->clinic->regionalManager ?
            $form->clinic->regionalManager->first()->user->name : '/'  }} <br>
        Team member logging the complaint: {{ $form->team_member  }} <br>
        Position of the team member: {{ $form->team_member_position  }} <br>
        Client/Owner name: {{ $form->client_name  }} <br>
        Patient name: {{ $form->patient_name  }} <br>
        PMS code: {{ $form->pms_code  }} <br>
        Date of the incident: {{$form->date_of_incident->format('d/m/Y')  }} <br>
        Date of client complaint (if applicable): {{ $form->date_of_client_complaint !== null ?
            date('d/m/Y', \strtotime($form->date_of_client_complaint)) : '/' }} <br>
        Description of the incident and/or complaint: {{$form->description  }} <br>
        Location of the incident: {{$form->location->name  }} <br>
        Category: {{$form->category->name  }} <br>
        Type: {{$form->type->name  }} <br>
        Channel: {{$form->channel->name  }} <br>
        Complaint Level: {{ $form->complaintLevel() ?? '/'  }} <br>
        Severity: {{$severities[$form->severity] ?? '/'  }} <br>
    </p>

    <p>
        <a href="{{ route('complaint-form.manage') }}">Check the complaint</a>
    </p>
</body>
</html>
