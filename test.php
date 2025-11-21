<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>hello ici on test</h2>
    <p>juste un test</p>
    <div>
        <p>test</p>
        <div id="testDiv"></div>
    </div>
    <script>
        
        const API_BASE = '/kodpwomo/backend';
let userId = "GOOGLE_hwoiP9nzChbWi7TClQnLWlhlKqy12";
fetch(`${API_BASE}/deliveries/user/${encodeURIComponent(userId)}`)
.then(response => response.json())
.then(data => {
    document.getElementById('testDiv').innerHTML = JSON.stringify(data);
})
.catch(error => console.error('Error fetching data:', error));
    </script>
</body>
</html>