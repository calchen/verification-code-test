var config = require('../.env');
var aliyunVerificationCode = require('../helper/AliyunVerificationCode');

/**
 * 获取测试页面
 *
 * @param req
 * @param res
 * @param next
 */
exports.index = function (req, res, next) {
    res.render('aliyun', {config: config});
};

/**
 * 二次验证
 *
 * @param req
 * @param res
 * @param next
 */
exports.validateCode = function (req, res, next) {
    var ipAddress;
    //判断是否有反向代理头信息
    var forwardedIpsStr = req.header('X-Forwarded-For');
    //如果有，则将头信息中第一个地址拿出，该地址就是真实的客户端IP；
    if (forwardedIpsStr) {
        var forwardedIps = forwardedIpsStr.split(',');
        ipAddress = forwardedIps[0];
    }
    if (!ipAddress) {//如果没有直接获取IP；
        ipAddress = req.connection.remoteAddress;
    }

    var scene = req.body.scene;
    var token = req.body.token;
    var sig = req.body.sig;
    var csessionid = req.body.csessionid;

    aliyunVerificationCode.check(scene, token, sig, csessionid, ipAddress, function (error, data) {
        if (error) {
            res.send({message: '请求阿里云接口出现错误'})
        } else {
            try {
                data.data = JSON.parse(data.data);
                var code = data.data.SigAuthenticateResult.Code;

                if (200 <= data.statusCode && data.statusCode < 300 && 100 <= code && code < 200) {
                    message = 'ok';
                } else {
                    var message = data.data.SigAuthenticateResult.Msg;
                }
                res.send({message: message})
            } catch ($e) {
                res.send({message: '请求阿里云接口出现错误'})
            }
        }
    });

};
