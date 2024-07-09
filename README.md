# atte
従業員の勤怠管理システム

## 作成した目的
模擬案件を通して実践に近い開発経験をつむ

## アプリケーションURL


## 機能一覧
- ログイン機能
- 新規会員登録機能
- Remember Me機能
- メール認証
- パスワード再設定機能
- 勤怠管理アプリ
- 日別勤務時間画面
- ユーザー一覧画面
- ユーザー別勤務時間画面

## 使用技術(実行環境)

- php 7.4.9
- Laravel 8.83
- MySQL 8.0

## テーブル設計

## ER図


## 環境構築

### Dockerビルド

1. git clone git@github.com:teruma-nanami/ability-test
1. docker-compose up -d --build

### Laravel環境構築

1. docker-composer exec php bash
1. composer install
1. .env.example ファイルから.envを作成し、環境変数を変更
1. php artisan key:generate
1. php artisan migrate
1. php artisan db:seed