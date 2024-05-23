const express = require("express");
const mysql = require("mysql2");
const cors = require("cors");
const bodyParser = require("body-parser");
// const getcomproute = require('./Route/getcomroute');
const PORT = 3001;

const app = express();

app.use(cors());
app.use(bodyParser.json());
// app.use('/api/student', getcomproute);
const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "!Swapnil1012",
  database: "complaint",
});

connection.connect((err) => {
  if (err) {
    console.error("Connection Failed: " + err);
    return;
  }
  console.log("Connected to mysql2!");
});

app.post("/register", (req, res) => {
  const { role, name, email, password } = req.body;
  const sql =
    "INSERT INTO users (role, name, email, password) VALUES (?,?,?,?)";
  connection.query(sql, [role, name, email, password], (err, result) => {
    if (err) {
      console.error("Connection Failed: " + err);
      res.status(500).send("Registration Failed.");
      return;
    }
    console.log("Register Successfull.");
    res.send(result);
  });
});

app.post("/login", (req, res) => {
  const { role, email, password } = req.body;
  const sql = "SELECT * FROM users WHERE role=? AND email=? AND password=?";
  connection.query(sql, [role, email, password], (err, result) => {
    if (err) {
      console.error("Connection Failed: " + err);
      res.status(500).send("Login Failed.");
      return;
    }
    if (result.length > 0) {
      console.log("Login Successfull.");
      res.send(result);
    } else {
      res.status(500).send("Login Failed.");
    }
  });
});

app.get("/complaintlist", (req, res) => {
  const sql = "SELECT * FROM complaints";
  connection.query(sql, (err, result) => {
    if (err) {
      console.error("Connection Failed: " + err);
      res.status(500).send("Complaints Fetch Failed.");
      return;
    }
    if (result.length > 0) {
      console.log("Complaints Fetch Successfull. " + result);
      res.json(result);
    } else {
      res.status(500).send("Complaints Fetch Failed.");
    }
  });
});

app.post("/complaint", (req, res) => {
  const { user, complaint } = req.body;
  console.log(user + " " + complaint);
  const sql = "INSERT INTO complaints (email, description) VALUES (?,?)";
  connection.query(sql, [user, complaint], (err, result) => {
    if (err) {
      console.error("Connection Failed: " + err);
      res.status(500).send("Complaint Failed.");
      return;
    }
    console.log("Complaint Successfull.");
    res.send(result);
  });
});

app.listen(PORT, (req, res) => {
  console.log("Server is running on PORT: " + PORT);
});
