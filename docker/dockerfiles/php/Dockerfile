FROM php:7.2-fpm

ENV TZ=America/Sao_Paulo
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y libmcrypt-dev \
    libpq-dev \
    procps \
    wget \
    zip \
    git \
    libmcrypt-dev \
    build-essential \
    libxml2-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libfontconfig1 \
    libxrender1 \
    libxext6 \
    apt-transport-https \
    && docker-php-ext-install pdo pdo_pgsql zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ --with-pdo-pgsql \
    && pecl install mcrypt-1.0.1 && docker-php-ext-enable mcrypt.so \
    && apt-get clean

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN wget https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.4/wkhtmltox-0.12.4_linux-generic-amd64.tar.xz -O /tmp/wkhtmltopdf.tar.xz && \
    tar xf /tmp/wkhtmltopdf.tar.xz && \
    mv wkhtmltox/bin/* /usr/local/bin && \
    rm -rf wkhtmltopdf

RUN apt-get install -y gnupg2

RUN curl -sL https://deb.nodesource.com/setup_8.x -o nodesource_setup.sh && \
    bash nodesource_setup.sh && \
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
    apt-get update && apt-get install -y nodejs yarn

RUN docker-php-ext-install opcache

WORKDIR /var/www/html