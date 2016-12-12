<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>

<style>
    .calculator {
        margin-top: 100px;
    }

    .input-group-addon {
        width: 175px;
    }
</style>

<?php

    $evalRequest = isset($_POST['eval_request']) ? $_POST['eval_request'] : '';

    function validateArgumentInput($postInput, &$validation) {
        $inputValue = isset($_POST[$postInput]) ? $_POST[$postInput] : '';

        if (preg_match('/^(\-){0,1}[\d]+(\.){0,1}[\d]*$/', $inputValue)) {
            $validation = true;
            return floatval($inputValue);
        } else {
            $validation = false;
            return $inputValue;
        }
    }

    $firstArg = validateArgumentInput('first_arg', $firstArgValidation);
    $secondArg = validateArgumentInput('second_arg', $secondArgValidation);

    $operation = isset($_POST['operation']) ? $_POST['operation'] : '';
    $result = isset($_POST['result']) ? $_POST['result'] : '';
    $resultCalculated = false;

    $operationValidation = preg_match('/^[\+\-\*\/]{1}$/', $operation);

    if ($firstArgValidation && $secondArgValidation && $operationValidation) {
        switch ($operation) {
            case '+':
                $result = $firstArg + $secondArg;
                $resultCalculated = true;
                break;
            case '-':
                $result = $firstArg - $secondArg;
                $resultCalculated = true;
                break;
            case '*':
                $result = $firstArg * $secondArg;
                $resultCalculated = true;
                break;
            case '/':
                $result = $firstArg / $secondArg;
                $resultCalculated = true;
                break;
            default:
                break;
        }
    }

?>

<div class="container calculator">
   <h1 class="text-center">Calculator</h1>
    <form class="form-horizontal" method="post">
        <div class="form-group<?php echo !$firstArgValidation && $evalRequest ? ' has-error' : '' ?>">
            <label class="control-label sr-only" for="first_arg">First Argument</label>
            <div class="input-group col-xs-6 col-xs-offset-3">
              <div class="input-group-addon">First Argument</div>
              <input type="text" class="form-control" id="first_arg" placeholder="First Argument" name="first_arg" value="<?php echo $firstArg ?>">
            </div>
        </div>
        <div class="form-group<?php echo !$secondArgValidation && $evalRequest ? ' has-error' : '' ?>">
            <label class="control-label sr-only" for="second_arg">Second Argument</label>
            <div class="input-group col-xs-6 col-xs-offset-3">
              <div class="input-group-addon">Second Argument</div>
              <input type="text" class="form-control" id="second_arg" placeholder="Second Argument" name="second_arg" value="<?php echo $secondArg ?>">
            </div>
        </div>
        <div class="form-group<?php echo !$operationValidation && $evalRequest ? ' has-error' : '' ?>">
            <label class="control-label sr-only" for="operation">Operation</label>
            <div class="input-group col-xs-6 col-xs-offset-3">
              <div class="input-group-addon">Operation</div>
              <input type="text" class="form-control" id="operation" placeholder="Operation" name="operation" value="<?php echo $operation ?>">
            </div>
        </div>
        <div class="form-group<?php echo $resultCalculated ? ' has-success' : '' ?>">
            <label class="control-label sr-only" for="result">Result</label>
            <div class="input-group col-xs-6 col-xs-offset-3">
              <div class="input-group-addon">Result</div>
              <input type="text" readonly class="form-control" id="result" placeholder="Result" name="result" value="<?php echo $result ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group col-xs-6 col-xs-offset-3">
                <button type="submit" class="btn btn-primary col-xs-12">Eval</button>
            </div>
        </div>
        <input type="hidden" name="eval_request" value="true">
    </form>
</div>

</body>
</html>
