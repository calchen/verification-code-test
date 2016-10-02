#!/usr/bin/env bash
git pull

cd ./nodejs

pm2 restart bin/www --name "verificationCodeTest"

cd ../