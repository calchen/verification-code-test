var config = require('../.env');
var touclickSdk = require('touclick-nodejs-sdk');

/**
 * 获取测试页面
 *
 * @param req
 * @param res
 * @param next
 */
exports.index = function (req, res, next) {
    res.render('touclick', {config: config});
};

/**
 * 二次验证
 *
 * @param req
 * @param res
 * @param next
 */
exports.validateCode = function (req, res, next) {
    var sid = req.body.sid;
    var checkAddress = req.body.checkAddress;
    var token = req.body.token;
    var type = req.body.type;

    touclickSdk.init(config['TOUCLICK_PUBLIC_KEY' + type], config['TOUCLICK_PRIVATE_KEY' + type]);

    touclickSdk.check(token, checkAddress, sid, function (result, ckCode) {
        res.send({
            code: result.code,
            message: result.message,
            checkCode: ckCode
        });
    });
};

/**
 * 获取每种方法的页面
 *
 * @param req
 * @param res
 * @param next
 * @returns {*}
 */
exports.getPage = function (req, res, next) {
    var type = req.params.type;
    switch (type) {
        case '1':
        case '2':
        case '3':
            break;
        default:
            res.redirect(config.URL_PREFIX + '/touclick')
    }
    var data = {
        publicKey: config['TOUCLICK_PUBLIC_KEY' + type],
        privateKey: config['TOUCLICK_PRIVATE_KEY' + type],
        type: type,
        config: config
    };
    // res.send(data);
    res.render('touclickPage', data);
};