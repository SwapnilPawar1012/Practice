const PORT = 4000;
const express = require("express");
const mysql = require("mysql2");
const cors = require("cors");

const app = express();

app.use(cors());
app.use(express.json()); // Middleware to parse JSON bodies

const db = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "!Swapnil1012",
  database: "crud",
});

app.get("/", (req, res) => {
  const sql = "SELECT * FROM student";
  db.query(sql, (error, data) => {
    if (error) {
      console.error("Error executing query:", error);
      res.status(500).json({ message: "Internal server error" });
    } else {
      res.json(data.length > 0 ? data : { message: "No students found" });
    }
  });
});

app.post("/create", (req, res) => {
  if (!req.body.user || !req.body.user.name || !req.body.user.email) {
    return res.status(400).json({ error: "Missing user data in request" });
  }

  const { name, email } = req.body.user;
  const sql = "INSERT INTO student (Name, Email) VALUES (?, ?)"; // Correct SQL syntax and direct parameter insertion
  const values = [name, email];

  db.query(sql, values, (err, data) => {
    if (err) {
      console.error("Error during database query:", err);
      return res.status(500).json({ error: "Internal server error" }); // Generic error message to client
    } else {
      return res
        .status(201)
        .json({ data, message: "User added successfully!" });
    }
  });
});

app.put("/update/:id", (req, res) => {
  if (!req.body.user || !req.body.user.name || !req.body.user.email) {
    return res.status(400).json({ error: "Missing user data in request" });
  }
  const { name, email } = req.body.user;
  const id = req.params.id;

  const sql = "update student set `Name` = ?, `Email` = ? where ID = ?";
  const values = [name, email];

  db.query(sql, [...values, id], (err, data) => {
    if (err) {
      console.error("Error during database query: " + err);
      return res.status(500).json({ error: "Internal Server Error" });
    } else {
      return res
        .status(201)
        .json({ data, message: "User Data Updated Successfully!" });
    }
  });
});

app.delete("/delete/:id", (req, res) => {
  const sql = "DELETE FROM student WHERE ID = ?";
  const id = req.params.id;

  db.query(sql, [id], (err, data) => {
    if (err) {
      return res.json("Error: " + err);
    } else {
      return res.json(data);
    }
  });
});

app.listen(PORT, () => {
  console.log(`Server is running on Port no ${PORT}`);
});
