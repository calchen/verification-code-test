var express = require('express');
var router = express.Router();
var geetestController = require('../controller/geetest');

router.get('/geetest', geetestController.index);
router.get('/geetest/preProcess', geetestController.getPreProcess);
router.post('/geetest/validate', geetestController.validateCode);


module.exports = router;
