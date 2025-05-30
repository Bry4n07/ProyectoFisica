FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpq-dev \
    sqlite3 libsqlite3-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath gd

# Instalar Node.js y npm para compilar Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer carpeta de trabajo
WORKDIR /var/www

# Copiar todo el proyecto
COPY . .

# Instalar dependencias PHP
RUN composer install --optimize-autoloader --no-dev

# Instalar dependencias JS y compilar Vite
RUN npm install && npm run build

# Exponer puerto
EXPOSE 8000

# Comando de inicio de Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]