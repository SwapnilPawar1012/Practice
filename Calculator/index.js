const btnElement = document.querySelectorAll("button");
const display = document.querySelector("input");

btnElement.forEach((button) => {
  button.addEventListener("click", function () {
    const value = button.value;
    console.log(display.value);

    if (value === "CE") {
      display.value = "";
    } else if (value === "DEL") {
      display.value = display.value.toString().slice(0, -1);
    } else if (value === "=") {
      let result = eval(display.value);
      display.value = result;
    } else {
      display.value += value;
    }
  });
});

// const btnElement = document.querySelectorAll("button");
// const inputElement = document.querySelector("input");

// let firstOperand = "";
// let currentInput = "";
// let operator = "";

// btnElement.forEach((button) => {
//   button.addEventListener("click", function () {
//     const value = button.value;
//     console.log(inputElement.value);

//     if (value === "CE") {
//       inputElement.value = "";
//       firstOperand = "";
//       currentInput = "";
//       operator = "";
//     } else if (value === "=") {
//       inputElement.value = calculate(firstOperand, currentInput, operator);
//       currentInput = inputElement.value;
//       firstOperand = "";
//       operator = "";
//     } else if (value === "DEL") {
//       inputElement.value = inputElement.value.slice(0, -1);
//       currentInput = inputElement.value;
//     } else if (["+", "-", "*", "/", "%"].includes(value)) {
//       if (currentInput) {
//         firstOperand = currentInput;
//         operator = value;
//         currentInput = "";
//         inputElement.value += value;
//       }
//     } else {
//       currentInput += value;
//       inputElement.value += value;
//     }
//   });
// });

// function calculate(first, second, op) {
//   first = parseFloat(first);
//   second = parseFloat(second);

//   if (op === "+") {
//     return first + second;
//   } else if (op === "-") {
//     return first - second;
//   } else if (op === "/") {
//     return first / second;
//   } else if (op === "*") {
//     return first * second;
//   } else if (op === "%") {
//     return first % second;
//   } else {
//     alert("Invalid Input!");
//     return "";
//   }
// }
