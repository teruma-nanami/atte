# ベースイメージの指定
# FROM php:7.4-fpm

# 必要なパッケージのインストール
# RUN apt-get update
# RUN apt-get install -y nginx libpng-dev libjpeg-dev libfreetype6-dev
# RUN docker-php-ext-configure gd --with-freetype --with-jpeg
# RUN docker-php-ext-install gd






# 作業ディレクトリの設定
# WORKDIR /var/www/html






FROM richarvey/nginx-php-fpm:2.1.2

# アプリケーションコードをコピー
COPY src /var/www/html

# php.iniファイルをコピー
COPY docker/php/php.ini /usr/local/etc/php/

# Nginxの設定ファイルをコピー
# COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/nginx.conf /etc/nginx/sites-available/default

# 環境変数の設定
ENV DB_CONNECTION=mysql
ENV DB_HOST=mysql
ENV DB_PORT=3306
ENV DB_DATABASE=laravel_db
ENV DB_USERNAME=laravel_user
ENV DB_PASSWORD=laravel_pass

# Composerのインストールとキャッシュの設定
RUN composer install --no-dev --working-dir=/var/www/html
RUN php artisan config:cache
RUN php artisan route:cache
RUN php artisan migrate --force

# ポートの公開
EXPOSE 80

# サービスの起動
CMD php-fpm && nginx -g 'daemon off;'
# CMD ["nginx", "-g", "daemon off;"]