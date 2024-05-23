import React, { useState } from "react";
import axios from "axios";

const ElectricityBillForm = () => {
  const [units, setUnits] = useState();
  const [amount, setAmount] = useState(null);

  const handleOnSubmit = async (e) => {
    e.preventDefault();
    try {
      const result = await axios.post("http://localhost:8080/calculate", {
        units: parseInt(units),
      });
      setAmount(result.data.amount);
    } catch (error) {
      console.log("Error: " + error);
    }
  };

  return (
    <div className="main-container">
      <div className="electricity-bill-form">
        <label>Enter Total Units</label>
        <input
          type="number"
          id="units"
          value={units}
          onChange={(e) => setUnits(e.target.value)}
        />
        <button className="btn btn-primary" onClick={handleOnSubmit}>
          Calculate
        </button>
      </div>
      <div className="electricity-bill">
        <div>
          <p>Units</p>
          <p>{units}</p>
        </div>
        <div>
          <p>Total Amount</p>
          <p>{amount}</p>
        </div>
      </div>
    </div>
  );
};

export default ElectricityBillForm;
