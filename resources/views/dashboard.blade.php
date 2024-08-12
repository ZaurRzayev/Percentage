<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send ID</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<h1>Send ID to ApplicantApprove Job</h1>
<form id="idForm">
    <label for="postApplicantId">Enter Post Applicant ID:</label>
    <input type="text" id="postApplicantId" name="postApplicantId" required>
    <button type="submit">Send</button>
</form>
<script>
    document.getElementById('idForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var postApplicantId = document.getElementById('postApplicantId').value;

        fetch('/send-id', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ postApplicantId: postApplicantId })
        })
            .then(response => response.json())
            .then(data => alert(data.status))
            .catch(error => console.error('Error:', error));
    });
</script>
</body>
</html>
