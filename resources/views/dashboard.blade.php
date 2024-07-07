<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Percentage Updater Test</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        input, textarea, button {
            display: block;
            margin: 10px 0;
            padding: 10px;
            width: 100%;
            max-width: 300px;
        }
        textarea {
            height: 100px;
        }
    </style>
</head>
<body>
<h1>User Percentage Updater Test</h1>
<label for="percentageId">Percentage ID:</label>
<input type="number" id="percentageId" placeholder="Enter Percentage ID" required>

<label for="bracketString">Bracket String:</label>
<input type="text" id="bracketString" placeholder="Enter Bracket String (e.g., {10})" value="{}{}{}{}{}{}{}{}{}{}" required>

<button onclick="updatePercentage()">Update Percentage</button>

<h2>Response:</h2>
<pre id="response"></pre>

<script>
    async function updatePercentage() {
        const percentageId = document.getElementById('percentageId').value.trim();
        const bracketString = document.getElementById('bracketString').value.trim();

        const responseElement = document.getElementById('response');
        responseElement.textContent = 'Loading...';

        try {
            const response = await fetch(`http://64.226.121.124/api/v1/percentages/${percentageId}/complete`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    bracket_string: bracketString
                })
            });

            if (!response.ok) {
                const text = await response.text();
                throw new Error(text);
            }

            const data = await response.json();

            if (data && typeof data.percentage !== 'undefined') {
                responseElement.textContent = 'Percentage updated successfully: ' + data.percentage.toFixed(2) + '%';
            } else {
                throw new Error('Percentage value is undefined or null.');
            }

            document.getElementById('bracketString').value = '{}{}{}{}{}{}{}{}{}{}'; // Reset input field
        } catch (error) {
            responseElement.textContent = 'Error: ' + error.message;
            console.error('Fetch error:', error);
        }
    }
</script>
</body>
</html>
