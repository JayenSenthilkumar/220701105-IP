<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $country = isset($_POST['country']) ? strtolower(trim($_POST['country'])) : '';
    $year = isset($_POST['year']) ? $_POST['year'] : '';

    // Write the input data to a file directly in htdocs
    $input_data = json_encode(['country' => $country, 'year' => $year]);
    $file_path = __DIR__ . '/input.txt';
    
    if (file_put_contents($file_path, $input_data)) {
        echo "<pre>File successfully written: $file_path</pre>";
    } else {
        echo "<pre>Failed to write file: $file_path</pre>";
    }

    // Use the full path to python.exe
    $python_path = "C:/Content/python.exe"; // Replace with the actual path from 'where python'
    $command = "$python_path " . __DIR__ . "/your_model_script.py";
    $output = shell_exec($command . ' 2>&1');

    echo "<pre>Command: $command\nOutput: $output</pre>";

    $ratings = json_decode($output, true);
    if ($ratings) {
        echo "<h2>Ratings for $country in $year</h2>
        <p>Voice & Accountability: {$ratings['voice']}</p>
        <p>Government Effectiveness: {$ratings['ge']}</p>
        <p>Control of Corruption: {$ratings['coc']}</p>
        <p>Political Stability: {$ratings['pol']}</p>
        <p>Rule of Law: {$ratings['rol']}</p>
        <p>Regulatory Quality: {$ratings['rq']}</p>";
    } else {
        echo "<p>Error processing the ratings.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Government Rating System</title>
</head>
<body>
    <h1>Government Rating System</h1>
    <p>This website allows you to rate the government based on six indicators: Voice & Accountability, Political Stability, Government Effectiveness, Regulatory Quality, Rule of Law, and Control of Corruption. Enter the country and select the year to get the ratings.</p>
    <form method="post" action="index.php">
        <label for="country">Country:</label>
        <input type="text" name="country" id="country" required>
        <br><br>
        <label for="year">Year:</label>
        <select name="year" id="year" required>
            <option value="">Select a Year</option>
            <?php
            $years = range(1996, 2022);
            foreach ($years as $year) {
                echo "<option value='$year'>$year</option>";
            }
            ?>
        </select>
        <br><br>
        <input type="submit" value="Get Rating">
    </form>
</body>
</html>
