const express = require('express');
const { getcomp } = require("../controller/getcomplaint");
const router = express.Router();


router('/get', getcomp);

module.exports = router;