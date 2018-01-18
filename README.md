# Voucher Pool

### Stack:
- Built on LAMP stack with Laravel lumen micro-framework.

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

### Overview

There are three entities available. They are recepient, offer and voucher. The relationship between recepient to voucher and offer to voucher is One to Many.

There is migration script availabe for automated migration at /www/database/migrations/ folder. Process of migration is described above in setup section.

The tests are located at /www/tests/ folder. Test procedure is described at setup section above.

### API

For ease of testing you can also import the collection into your postman application.
[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/9ccce162350cc342c9ee)

##### Recepients
Get All
- **URL:** `http://localhost/api/recepients`
- **METHOD:** `GET`
- **Parameters**: `None`
- **Varables**: `None`

Get Single
- **URL:** `http://localhost/api/recepients/{id}`
- **METHOD:** `GET`
- **Parameters**: `id`
- **Varables**: `None`

Create
- **URL:** `http://localhost/api/recepients`
- **METHOD:** `PUT`
- **Parameters**: `None`
- **Varables**: `name, email`

Update
- **URL:** `http://localhost/api/recepients/{id}`
- **METHOD:** `POST`
- **Parameters**: `id`
- **Varables**: `name, email`

Delete
- **URL:** `http://localhost/api/recepients/{id}`
- **Parameters**: `id`
- **METHOD:** `DELETE`


#### Offers
Get All
- **URL:** `http://localhost/api/offers`
- **METHOD:** `GET`
- **Parameters**: `None`
- **Varables**: `None`

Get Single
- **URL:** `http://localhost/api/offers/{id}`
- **METHOD:** `GET`
- **Parameters**: `id`
- **Varables**: `None`

Create
- **URL:** `http://localhost/api/offers`
- **METHOD:** `PUT`
- **Parameters**: `None`
- **Varables**: `name, discount`

Update
- **URL:** `http://localhost/api/offers/{id}`
- **METHOD:** `POST`
- **Parameters**: `id`
- **Varables**: `name, discount`

Delete
- **URL:** `http://localhost/api/offers/{id}`
- **Parameters**: `id`
- **METHOD:** `DELETE`

#### Vouchers
Get All
- **URL:** `http://localhost/api/vouchers`
- **METHOD:** `GET`
- **Parameters**: `None`
- **Varables**: `None`

Create
- **URL:** `http://localhost/api/vouchers/{id}`
- **METHOD:** `PUT`
- **Parameters**: `Recepient Id`
- **Varables**: `recepient_id, offer_id`

Redeem
- **URL:** `http://localhost/api/vouchers/redeem/{id}`
- **METHOD:** `POST`
- **Parameters**: `Recepient Id`
- **Varables**: `email, code`


### Future Improvements:
For long running processes or to improve efficiency we can incorporate queues to be able to handle large concurrent requests.