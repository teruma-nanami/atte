# ベースイメージの指定
FROM php:7.4-fpm

# 必要なパッケージのインストール
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# php.iniファイルをコピー
COPY docker/php/php.ini /usr/local/etc/php/

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
CMD ["php-fpm"]
