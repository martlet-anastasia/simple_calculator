<?php
if($_GET['action'] == "C") {
    $result = 0;
} elseif($_GET['action'] == "=") {
    $userInput = $_GET['hidden_field'] ?? "";
    $array = str_split($userInput);
    $array[] = "=";

    $result = 0;
    $firstValue = $secondValue = $operator = null;
    foreach ($array as $val) {
        if(is_numeric($val) && is_null($operator)) {
            $firstValue = $firstValue . $val;
        } elseif(is_numeric($val) && !is_null($operator)) {
            $secondValue = $secondValue . $val;
        } elseif(!is_numeric($val) && !is_null($secondValue)) {
            $expression = intval($firstValue).$operator.intval($secondValue);
            $result = eval("return $expression;");
            $firstValue = $result;
            $secondValue = null;
            $operator = $val;
        } elseif(!is_numeric($val) && !is_null($firstValue)) {
            $operator = $val;
        }
    }
}

?>

<meta charset="UTF-8">
<title>Calculator</title>
<link rel="stylesheet" href="style/style.css"/>
<form method="get">
    <input type="hidden" name="hidden_field" id="hidden_field" value="">
    <div class="calculator">
        <div class="calculator__display">
            <p><?php echo $result?></p>
        </div>
        <div class="calculator__main" id="main">
            <div class="calculator__button calculator__button--number">0</div>
            <div class="calculator__button calculator__button--number">1</div>
            <div class="calculator__button calculator__button--number">2</div>
            <div class="calculator__button calculator__button--number">3</div>
            <div class="calculator__button calculator__button--number">4</div>
            <div class="calculator__button calculator__button--number">5</div>
            <div class="calculator__button calculator__button--number">6</div>
            <div class="calculator__button calculator__button--number">7</div>
            <div class="calculator__button calculator__button--number">8</div>
            <div class="calculator__button calculator__button--number">9</div>
            <div class="calculator__button calculator__button--operator">+</div>
            <div class="calculator__button calculator__button--operator">-</div>
            <div class="calculator__button calculator__button--operator">*</div>
            <div class="calculator__button calculator__button--operator">/</div>
            <input type="submit" name="action" class="calculator__button calculator__button--operator" value="=">
            <input type="submit" name="action" class="calculator__button calculator__button--operator" value="C">
        </div>
    </div>
</form>

<script>
    let userInput = document.getElementById('hidden_field').value;
    document.getElementById('main').onclick = function () {
        // if(event.target.id === "reset") {
        //     userInput = ""
        //     document.getElementById('hidden_field').value = userInput
        //     return
        // }
        if(event.target.className.includes('calculator__button')) {
            userInput = userInput + event.target.textContent.toString()
            document.getElementById('hidden_field').value = userInput
        }
    }
</script>