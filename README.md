# Atte（アット） 勤怠管理システム

## 環境構築

### Dockerビルド
1.git clone git@github.com:fukumamire/attendance.git

2.DockerDesktopアプリを立ち上げる

3.docker-compose up -d --build


### Laravel環境構築

1.docker-compose exec php bash

2.composer install

3.「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成

4.envに以下の環境変数を追加

DB_CONNECTION=mysql

DB_HOST=mysql

DB_PORT=3306

DB_DATABASE=laravel_db

DB_USERNAME=laravel_user

DB_PASSWORD=laravel_pass

5.アプリケーションキーの作成

php artisan key:generate


## 使用技術(実行環境)

・PHP7.4.9 

・mysql:8.0.26
