var express = require('express');
var router = express.Router();
var geetestController = require('../controller/geetest');
var touclickController = require('../controller/touclick');

router.get('/geetest', geetestController.index);
router.get('/geetest/preProcess', geetestController.getPreProcess);
router.post('/geetest/validate', geetestController.validateCode);

router.get('/touclick', touclickController.index);
router.get('/touclick/:type', touclickController.getPage);
router.post('/touclick/validate', touclickController.validateCode);

module.exports = router;
