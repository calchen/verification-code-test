/**
 * Copyright (C) 2016 上海沃去信息科技有限公司 版权所有。
 *
 * 文件名:
 * 功能描述:
 *
 * 创 建 人: 陈恺垣
 * 创建日期: 2016/07/22 11:37
 *
 */

var http = require("http-https");
var url = require('url');
var queryString = require('querystring');
var _ = require('underscore');

module.exports = {
    /**
     *
     *
     * @param type
     * @param api
     * @param params
     * @param body
     * @param headers
     * @param supplier
     * @param successCb(data) 正常回调，即使http code不是200也会触发这个回调
     *              data:{
     *                       statusCode: statusCode,        //int 状态码
     *                       statusMessage: statusMessage,  //string 对于上面状态码的描述
     *                       data: result                   //string 接口返回的结果
     *                   }
     * @param errorCb 错误回调，当请求发生异常的时候，比如服务器断开，会触发这个问题
     */
    request: function (type, api, params, body, headers, supplier, successCb, errorCb) {
        switch (type.toUpperCase()) {
            case 'GET':
            case 'POST':
            case 'PUT':
            case 'DELETE':
                break;
            default:
                throw new error('type error');
        }
        if (_.isUndefined(api) || _.isNull(api)) {
            throw new error('api is error');
        }
        if (_.isUndefined(params) || _.isNull(params)) {
            params = {};
        }
        if (_.isUndefined(body) || _.isNull(body)) {
            body = {};
        }
        if (_.isUndefined(headers) || _.isNull(headers)) {
            headers = {
                'Content-Type': 'application/json',
                'Cache-Control': 'no-cache',
                'Connection': 'keep-alive'
            };
        }
        if (!_.isFunction(successCb)) {
            successCb = this.defaultSuccessCb;
        }
        if (!_.isFunction(errorCb)) {
            errorCb = this.defaultErrorCb;
        }

        api = url.parse(api);
        if (api.port == null) {
            if (api.protocol == 'https:') {
                api.port = 443;
            } else {
                api.port = 80;
            }
        }

        var paramsStr = '';
        _.each(params, function (value, key, list) {
            paramsStr += key + '=' + value + '&'
        });
        paramsStr = paramsStr.substr(0, paramsStr.length - 1);

        var bodyString = '';
        for (var key in headers) {
            if (key == 'Content-Type') {
                var value = headers[key];
                if (value == 'application/json') {
                    bodyString = JSON.stringify(body);
                } else if (value == 'application/x-www-form-urlencoded') {
                    bodyString = queryString.stringify(body);
                } else if (value.indexOf('multipart/form-data') >= 0) {
                    bodyString = body;
                }

                break;
            }
        }

        var options = {
            protocol: api.protocol,
            hostname: api.host,
            method: type,
            path: api.path + "?" + paramsStr,
            headers: headers
        };
        var req = http.request(options, function (res) {
            var statusCode = res.statusCode;
            var statusMessage = res.statusMessage;

            var result = "";
            // res.setEncoding('utf8');
            res.on("data", function (data) {
                result += data;
            });
            // 处理传输中出错
            res.on('error', errorCb);
            res.on('end', function () {
                successCb({
                    statusCode: statusCode,
                    statusMessage: statusMessage,
                    data: result
                });
            });
        });
        req.on('error', errorCb);
        req.write(bodyString);
        req.end();
    },
    defaultSuccessCb: function (data) {
        console.info('get success', data);
    },
    defaultErrorCb: function (err) {
        console.info('get success', err);
    }
};