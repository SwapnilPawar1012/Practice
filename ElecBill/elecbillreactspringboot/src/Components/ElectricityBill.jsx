import React, { useEffect } from "react";
import axios from "axios";

const ElectricityBill = () => {
  const handleElectricityBill = async () => {
    const result = await axios
      .get("http://localhost:8080/getBill")
      .then((response) => response.data)
      .catch((err) => console.log(err));
    console.log(result.data);
  };

  useEffect(() => {
    handleElectricityBill();
  }, []);

  return (
    <div className="electricity-bill">
      <p>
        <span>Units</span>
        {/* <span>${units}</span> */}
      </p>
      <p>
        <span>Total Amount</span>
        {/* <span>${amount}</span> */}
      </p>
    </div>
  );
};

export default ElectricityBill;
