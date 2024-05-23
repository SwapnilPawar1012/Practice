const express = require("express");
const cors = require("cors");
const mysql = require("mysql2");
const bodyParser = require("body-parser");
const PORT = 8080;

const app = express();

app.use(cors());
app.use(express.json());

const connection = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "!Swapnil1012",
  database: "bookstore",
});

connection.connect((err) => {
  if (err) {
    console.log("Error: " + err.stack);
    return;
  }
  console.log("MySQL connected successfully.");
});

app.post("/register", (req, res) => {
  const { username, password } = req.body;
  console.log(username + " " + password);
  const sql = "INSERT INTO users (username, password) VALUES (?, ?)";
  connection.query(sql, [username, password], (err, result) => {
    if (err) {
      console.error("connection error: " + err.stack);
      return res.status(500).send("connection error");
    }
    console.log("data added successfully");
    res.send(result);
  });
});

app.post("/login", (req, res) => {
  const { username, password } = req.body;
  const sql = "SELECT * FROM users WHERE username=? AND password=?";
  connection.query(sql, [username, password], (err, result) => {
    if (err) {
      console.error("Connection error: " + err.stack);
      return res.status(500).send("connection error");
    }

    if (result.length > 0) {
      console.log("login successfull. " + result);
      res.send(result);
    } else {
      console.log("user not found");
      res.status(404).send("User not found");
    }
  });
});

app.post("/addBook", (req, res) => {
  const { title, author, quantity, price } = req.body;
  const sql =
    "INSERT INTO books (title, author, quantity, price) VALUES (?, ?, ?, ?)";
  connection.query(sql, [title, author, quantity, price], (err, result) => {
    if (err) {
      console.error("connection error: " + err.stack);
      return res.status(500).send("connection failed");
    }
    console.log("book added successfully.");
    res.send(result);
  });
});

app.get("/getAllBooks", (req, res) => {
  const sql = "SELECT * FROM books";
  connection.query(sql, (err, result) => {
    if (err) {
      console.error("connection error: " + err.stack);
      return res.status(500).send("connection failed");
    }
    if (result.length > 0) {
      res.send(result);
    } else {
      console.log("data not found");
      res.status(404).send("data not found");
    }
  });
});

app.listen(PORT, (req, res) => {
  console.log("Server is running on PORT " + PORT);
});
