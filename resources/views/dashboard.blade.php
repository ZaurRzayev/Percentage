<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            margin-bottom: 10px;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #output {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
            border-radius: 4px;
            display: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Notification Generator</h1>
    <form id="notificationForm">
        <label for="UserFullName">User Full Name:</label>
        <input type="text" id="UserFullName" name="UserFullName" required>

        <label for="NewDate">New Date:</label>
        <input type="date" id="NewDate" name="NewDate" required>

        <label for="PostTitle">Post Title:</label>
        <input type="text" id="PostTitle" name="PostTitle" required>

        <label for="PostId">Post ID:</label>
        <input type="number" id="PostId" name="PostId" required>

        <label for="BusinessName">Business Name:</label>
        <input type="text" id="BusinessName" name="BusinessName" required>

        <label for="UserId">User ID:</label>
        <input type="number" id="UserId" name="UserId" required>

        <label for="BusinessId">Business ID:</label>
        <input type="number" id="BusinessId" name="BusinessId" required>

        <label for="jobId">Job ID:</label>
        <input type="number" id="jobId" name="jobId" required>

        <button type="button" id="generateNotification">Generate Notification</button>
    </form>
    <div id="output"></div>
</div>
<script>
    document.getElementById('generateNotification').addEventListener('click', function() {
        const UserFullName = document.getElementById('UserFullName').value;
        const NewDate = document.getElementById('NewDate').value;
        const PostTitle = document.getElementById('PostTitle').value;
        const PostId = document.getElementById('PostId').value;
        const BusinessName = document.getElementById('BusinessName').value;
        const UserId = document.getElementById('UserId').value;
        const BusinessId = document.getElementById('BusinessId').value;
        const jobId = document.getElementById('jobId').value;

        const notificationMessage = `Congratulations! ${UserFullName} accepted to ${BusinessName} in ${NewDate} to ${PostTitle}. Accepted by ${PostId}.`;

        const outputDiv = document.getElementById('output');
        outputDiv.innerText = notificationMessage;
        outputDiv.style.display = 'block';
    });
</script>
</body>
</html>
