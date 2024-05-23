require('../server');

const getcomp = (req, res) => {
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
};

module.exports = getcomp;
