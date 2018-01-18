# Voucher Pool

### Setup:
1. Make blank directory : `mkdir vouchers`
2. Get into vouchers directory : `cd vouchers`
2. Clone repository : `git clone https://github.com/thephpx/voucherpool .`
2. Make mysql directory (required for mounting db volume) `mkdir mysql`
3. Start initializing docker container : `docker-compose up -d`
4. Check if containers are running or not : `docker ps`
5. Get into docker application server container to initite migration : `docker exec -it vouchers_web_1 bash` by default the working directory is `/var/www/html`
5. Migration of database `php artisan migrate`
6. Browse `http://localhost/` to load front-end
7. To run tests execute while inside **vouchers_web_1 cotainer**: `vendor/bin/phpunit`