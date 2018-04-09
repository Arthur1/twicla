# twicla
授業の出欠管理ができそうなやつ

![](https://img.shields.io/badge/PHP-%3E=7.0.0-blue.svg)
![](https://img.shields.io/badge/Laravel-5.5.*-orange.svg)
![](https://img.shields.io/badge/Vue-^2.5.7-green.svg)

## Requirements
- PHP >=7.0.0
- Laravel 5.5.*
- Composer
- vue ^2.5.7
- vue-router ^3.0.1

## Description
- E-mailとPasswordでログイン
- マイページ画面で講義前後にボタンを押すと、出席/遅刻が記録される
- Twitterアカウントと連携している場合は、自動で投稿される
- ブラウザ通知対応端末には、授業開始10分前に通知が来る
- 基本的にVueを利用したSPA。PWAにも対応予定
