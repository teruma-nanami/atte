# ベースイメージの指定
FROM php:7.4-fpm

# 必要なパッケージのインストール
RUN apt-get update
RUN apt-get install -y nginx libpng-dev libjpeg-dev libfreetype6-dev
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# php.iniファイルをコピー
COPY docker/php/php.ini /usr/local/etc/php/

# Nginxの設定ファイルをコピー
# COPY docker/nginx/default.conf /etc/nginx/nginx.conf
COPY docker/nginx/default.conf /etc/nginx/sites-available/default


# アプリケーションコードをコピー
COPY src /var/www/html

# 作業ディレクトリの設定
WORKDIR /var/www/html

# ポートの公開
EXPOSE 9000

# 環境変数の設定
ENV DB_CONNECTION=mysql
ENV DB_HOST=mysql
ENV DB_PORT=3306
ENV DB_DATABASE=laravel_db
ENV DB_USERNAME=laravel_user
ENV DB_PASSWORD=laravel_pass

# サービスの起動
CMD php-fpm && nginx -g 'daemon off;'
# CMD ["nginx", "-g", "daemon off;"]
