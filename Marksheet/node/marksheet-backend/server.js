const express = require("express");
const cors = require("cors");
const bodyParser = require("body-parser");
const mysql = require("mysql2");

const app = express();

app.use(cors());
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: true }));

const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "!Swapnil1012",
  database: "marksheet",
});

connection.connect((err) => {
  if (err) {
    console.log("Error: " + err.message);
  }
  console.log("Connected to MySQL database.");
});

app.post("/data", (req, res) => {
  console.log("Received data: ", req.body);
  const { name, rollNo, m_cc, m_wt, m_daa, m_sdam, e_cc, e_wt, e_daa, e_sdam } =
    req.body;
  const totalMseMarks =
    parseInt(m_cc) + parseInt(m_wt) + parseInt(m_daa) + parseInt(m_sdam);
  const totalEseMarks =
    parseInt(e_cc) + parseInt(e_wt) + parseInt(e_daa) + parseInt(e_sdam);

  // Calculate percentage (70% from ESE + 30% from MSE)
  const percentage = (0.7 * totalEseMarks + 0.3 * totalMseMarks) / 4;

  const sql =
    "INSERT INTO student (name, rollNo, m_cc, m_wt, m_daa, m_sdam, e_cc, e_wt, e_daa, e_sdam, percentage) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  connection.query(
    sql,
    [
      name,
      rollNo,
      m_cc,
      m_wt,
      m_daa,
      m_sdam,
      e_cc,
      e_wt,
      e_daa,
      e_sdam,
      percentage,
    ],
    (err, results) => {
      if (err) {
        console.error("Failed to insert data: " + err.message);
        res.status(500).send({ message: "Failed to add data" });
        return;
      }
      res.json({ message: "Data added successfully" });
    }
  );
});

app.get("/data/:id", (req, res) => {
  const { id } = req.params;
  console.log("id: " + id);
  const sql = "SELECT * FROM student WHERE rollNo = ?";
  connection.query(sql, [id], (err, result) => {
    if (err) {
      res
        .status(500)
        .send({ message: "No data found for the given roll number" });
      return;
    }
    if (result.length === 0) {
      res.status(404).send({ message: "Failed to load data." });
      return;
    }
    console.log(result[0]);
    res.json(result[0]);
  });
});

app.listen(3001, (req, res) => {
  console.log("Server is running on 3001");
});
