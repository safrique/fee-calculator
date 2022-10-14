<!DOCTYPE html>
<html>
<head>
    <title>Loan Calculator</title>
</head>
<body>
<h1>Loan Calculator</h1>

<form action='../src/calculateLoan.php' method="post">
    <label for="amount">Amount<label>
    <input type="number" step=".01" min="1000" max="20000" name="amount" placeholder="1000" value="1000" id="amount">
    <label for="term">Term<label>
    <select name="term" id="term">
        <option value="12">12</option>
        <option value="24">24</option>
    </select>
    <input type="submit" value="Submit">
</form>
</body>
</html>