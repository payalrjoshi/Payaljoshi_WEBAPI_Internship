<!DOCTYPE html>
<html>
<head>
    <title>Student Internship Records</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            color: #333;
            padding: 40px;
            max-width: 900px;
            margin: 0 auto;  
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        div {
            text-align: center;
            margin-bottom: 20px;
        }

 
        select {
            padding: 12px 24px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            background-color: #3498db; 
            border: none;
            border-radius: 6px;
            cursor: pointer;
            outline: none;
            text-align: center;
            transition: background-color 0.3s ease;  
        }

        select:hover, select:focus {
            background-color: #2980b9; 
        }

 
        option {
            background-color: white;
            color: #333;
            font-weight: normal;
        }

        #output {
            margin-top: 30px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border-bottom: 1px solid #eee;
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            color: #2c3e50;
            font-weight: bold;
        }

        tr:hover {
            background-color: #f1f5f9;
        }
    </style>

    <script>
        function mode(selectedMode) {
            fetch("connectivity.php?mode=" + selectedMode)
            .then(response => response.text())
            .then(data => {
                // Fixed typo: document.getElementById
                document.getElementById('output').innerHTML = data;
            });
        }

 
        window.onload = function() {
            mode('all');
        };
    </script>
</head>
<body>

    <h1>INTERNSHIP RECORDS</h1>

    <div>
        <select onchange="mode(this.value)">
            <option value="all">📋 All Students</option>
            <option value="online">📱 Online</option>
            <option value="onsite">🏢 Onsite</option>
            <option value="hybrid">🔄️ Hybrid</option>
        </select>
    </div>

    <div id="output"></div>

</body>
</html>