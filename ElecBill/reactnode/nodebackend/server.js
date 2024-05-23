const express = require("express");
const cors = require("cors");
const bodyparser = require("body-parser");

const app = express();

app.use(cors());
app.use(bodyparser.json());
app.use(bodyparser.urlencoded({ extended: true }));

app.post("/calculate", (req, res) => {
  const units = req.body.units;
  const amount = calculateElectricityBill(units);
  res.json({ amount });
});

function calculateElectricityBill(units) {
  if (units < 100) {
    return 100 * 1.2;
  } else if (units < 150) {
    return 100 * 1.2 + (units - 100) * 1.5;
  } else if (units < 200) {
    return 100 * 1.2 + 50 * 1.5 + (units - 150) * 1.75;
  } else {
    return 100 * 1.2 + 50 * 1.5 + 50 * 1.75 + (units - 200) * 2;
  }
}

app.listen(3001, (req, res) => {
  console.log("Server is running on 3001");
});
