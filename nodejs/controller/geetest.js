var config = require('../.env');
var Geetest = require('geetest');

// 初始化
var captcha = new Geetest({
    geetest_id: config.GEETEST_CAPTCHA_ID,
    geetest_key: config.GEETEST_PRIVATE_KEY
});

/**
 * 获取测试页面
 *
 * @param req
 * @param res
 * @param next
 */
exports.index = function (req, res, next) {
    res.render('geetest', {config: config});
};

/**
 * 预处理接口
 *
 * @param req
 * @param res
 * @param next
 */
exports.getPreProcess = function (req, res, next) {
    captcha.register(function (data) {
        res.send(JSON.stringify({
            gt: captcha.geetest_id,
            challenge: data.challenge,
            success: data.success
        }));
    });
};

/**
 * 二次验证
 *
 * @param req
 * @param res
 * @param next
 */
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