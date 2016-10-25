/**
 * 阿里云验证码服务 Node.js 接入
 */
var crypto = require('crypto');

var config = require('../.env');
var http = require('./httpHelper');

module.exports = {
    check: function (scene, token, sig, csessionid, ip, cb) {
        // 获取公共参数
        var params = getPublicParams();
        // 获取接口参数
        params['Action'] = 'Authenticate';
        params['RegionId'] = 'cn-hangzhou';

        params['AppKey'] = config.ALIYUN_SAF_APPKEY;
        params['SessionId'] = csessionid;
        params['Token'] = token;
        params['Serno'] = getSerno(token, sig);
        params['RemoteIp'] = ip;
        params['Sig'] = sig;
        params['SceneId'] = scene;

        // 加签
        var signatureStr = signature(params);
        params['Signature'] = encodeURIComponent(signatureStr);
        params['Signature'] = signatureStr;

        http.request('GET', 'https://cf.aliyuncs.com', params, null, null, 'aliyun', function (data) {
            cb(null, data);
        }, function (error) {
            cb(error, null);
        })
    }
};

/**
 * 获取公共参数
 *
 * @returns {{Format: string, Version: string, AccessKeyId: (string|string), SignatureMethod: string, Timestamp: string, SignatureVersion: string, SignatureNonce: Number}}
 */
function getPublicParams() {
    return {
        Format: 'json',
        Version: '2015-11-27',
        AccessKeyId: config.ALIYUN_ACCESS_KEY_ID,
        SignatureMethod: 'HMAC-SHA1',
        Timestamp: (new Date()).toISOString(),
        SignatureVersion: '1.0',
        SignatureNonce: parseInt(Math.random() * 10000000)
    }
}

/**
 * 参数签名
 *
 * @param token
 * @param sig
 * @returns {*}
 */
function getSerno(token, sig) {
    var hash = crypto.createHash('md5');
    var str = config.ALIYUN_SAF_APPKEY + config.ALIYUN_SAF_AK + token + sig;
    hash.update(str);
    return hash.digest('hex');
}

/**
 * 加签
 *
 * @param params
 * @returns {string|*}
 */
function signature(params) {
    var canonicalizedQueryString = '';
    Object.keys(params).sort().forEach(function (key) {
        canonicalizedQueryString += '&' + percentEncode(key) + '=' + percentEncode(params[key])
    });
    var stringToSign = 'GET&%2F&' + percentEncode(canonicalizedQueryString.substr(1));
    // hamc的key
    var key = config.ALIYUN_ACCESS_KEY_SECRET + '&';
    // 计算hamc
    var hmac = crypto.createHmac('sha1', key);
    hmac.update(stringToSign);
    // 这里只能返回buffer 二进制，不能返回十六进制字符串
    var sign = hmac.digest();
    return sign.toString('base64');
}

/**
 * 将*替换成 %2A
 *
 * @param str
 * @returns {string}
 */
function percentEncode(str) {
    var res = encodeURIComponent(str);
    res = res.replace(/\*/g, '%2A');
    return res
}