James Isok
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purpose</title>
    <link rel="stylesheet" href="./designs/RecordForm.css">
</head>
<body>
    <h2>Add Record</h2>
    <form action="process_record.php" method="POST">
        <div class="container">
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" required>
            </div>
            
            <div class="form-group">
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" name="lastName" required>
            </div>
            
            <div class="form-group">
                <label for="purpose">Purpose:</label>
                <select id="purpose" name="purpose" required>
                    <option value="C#">C#</option>
                    <option value="Java">Java</option>
                    <option value="PHP">PHP</option>
                    <option value="Others">Others</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="room">Room:</label>
                <select id="room" name="room" required>
                    <option value="526">526</option>
                    <option value="539">539</option>
                    <option value="540">540</option>
                    <option value="537">537</option>
                </select>
            </div>
            
            <div class="form-group">
                <label for="session">Session:</label>
                <input type="text" id="session" name="session" required>
            </div>
        
        <button type="submit">submit</button>

    </div>
    </form>
</body>
</html>