var config = require('../.env');
var Geetest = require('geetest');

var captcha = new Geetest({
    geetest_id: config.GEETEST_CAPTCHA_ID,
    geetest_key: config.GEETEST_PRIVATE_KEY
});

exports.index = function (req, res, next) {
    res.render('geetest');
};

exports.getPreProcess = function (req, res, next) {
    captcha.register(function (data) {
        res.send(JSON.stringify({
            gt: captcha.geetest_id,
            challenge: data.challenge,
            success: data.success
        }));
    });
};

exports.validateCode = function (req, res, next) {
    var challenge = req.body.geetestChallenge;
    var validate = req.body.geetestValidate;
    var seccode = req.body.geetestSeccode;
    captcha.validate({
        challenge: challenge,
        validate: validate,
        seccode: seccode
    }, function (err, success) {
        var result = null;
        if (success) {
            result = {
                message: '成功',
                serverStatus: '未知'
            };
        } else {
            result = {
                message: '失败',
                serverStatus: '未知'
            };
        }
        res.send(JSON.stringify(result));
    });
};