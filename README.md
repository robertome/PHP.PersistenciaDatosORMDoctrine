Aplicacion Web
------------------

> cd public
> php -S localhost:8080

Aplicacion Web utilizando FrontController, FastRoute (rutas), Controladores y Twig (motor de plantillas).

Basada en el tutorial https://github.com/PatrickLouys/no-framework-tutorial



--------------------
Comandos para User
--------------------

> php create_user.php <username> <email> <password> `[<enabled (true|false)>]` [--json]

> php update_user.php <userId> <username> <email> <password> `[<enabled (true|false)>]` [--json]

> php read_user.php <userId> [--json]

> php delete_user.php <userId> [--json]

> php list_users.php [--json]


--------------------
Comandos para Result
--------------------

> php create_result.php <result> <userId> `[<timestamp>]` [--json]

> php update_result.php <resultId> <result> `[<timestamp>]` [--json]

> php read_result.php <resultId> [--json]

> php delete_result.php <resultId> [--json]

> php list_results.php [--json]


---------------------------
Ejemplos y resultados
---------------------------

### create_user

> php create_user.php

Usage: create_user.php <username> <email> <password> [<enabled (true|false)>] [--json]

> php create_user.php username

Usage: create_user.php <username> <email> <password> [<enabled (true|false)>] [--json]

> php create_user.php username email

Usage: create_user.php <username> <email> <password> [<enabled (true|false)>] [--json]

> php create_user.php username1 email1@upm.es password1

Creado Usuario:
id: 15, username: username1, email: email1@upm.es, enabled: false, isAdmin: false

> php create_user.php username1 email1@upm.es password1

An exception occurred while executing 'INSERT INTO users (username, email, enabled, admin, password) VALUES (?, ?, ?, ?, ?)' with params ["username1", "email1@upm.es", 0, 0, "$2y$10$n2zEST14wUPrymc
vEzW7BeYIXerzyco3ZOt\/u2ZYCW4D1ksEWjbbi"]:
SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry 'username1' for key 'IDX_UNIQ_USER'

> php create_user.php username2 email2@upm.es password2 --json

Creado Usuario:
{
    "id": 16,
    "username": "username2",
    "email": "email2@upm.es",
    "enabled": false,
    "admin": false
}

> php create_user.php username3 email3@upm.es password3 true

Creado Usuario:
id: 17, username: username3, email: email3@upm.es, enabled: true, isAdmin: false

> php create_user.php username4 email4@upm.es password4 false --json

Creado Usuario:
{
    "id": 29,
    "username": "username4",
    "email": "email4@upm.es",
    "enabled": false,
    "admin": false
}

> php create_user.php --json username5 email5@upm.es password5 true

{
    "id": 30,
    "username": "username5",
    "email": "email5@upm.es",
    "enabled": false,
    "admin": false
}

> php create_user.php --json username5 email5@upm.es password5 true true

Usage: create_user.php <username> <email> <password> [<enabled (true|false)>] [--json]



### update_user

> php update_user.php 1

Usage: update_user.php <userId> <username> <email> <password> [<enabled (true|false)>] [--json]

> php update_user.php 1 username

Usage: update_user.php <userId> <username> <email> <password> [<enabled (true|false)>] [--json]

> php update_user.php 1 username email@ump.es

Usage: update_user.php <userId> <username> <email> <password> [<enabled (true|false)>] [--json]

> php update_user.php -15 username email@upm.es password

No existe Usuario con id: -15

> php update_user.php 15 username15 email15@upm.es password15

Actualizado Usuario:
id: 15, username: username15, email: email15@upm.es, enabled: false, isAdmin: false

> php update_user.php 15 username16 email16@upm.es password16 --json

Actualizado Usuario:
{
    "id": 15,
    "username": "username16",
    "email": "email16@upm.es",
    "enabled": false,
    "admin": false
}

> php update_user.php 15 username15 email15@upm.es password15 true --json

Actualizado Usuario:
{
    "id": 15,
    "username": "username15",
    "email": "email15@upm.es",
    "enabled": true,
    "admin": false
}

> php update_user.php 15 username15 email15@upm.es password15 false --json

Actualizado Usuario:
{
    "id": 15,
    "username": "username15",
    "email": "email15@upm.es",
    "enabled": false,
    "admin": false
}



## read_user

> php read_user.php

Usage: read_user.php <userId> [--json]

> php read_user.php -15

No existe Usuario con id: -15


> php read_user.php 15

id: 15, username: username15, email: email15@upm.es, enabled: false, isAdmin: false

> php read_user.php 15 --json

Usuario:
{
    "id": 15,
    "username": "username15",
    "email": "email15@upm.es",
    "enabled": false,
    "admin": false
}


### list_users

> php list_users.php

Id            Username                         Email   Enabled
15:           username15                 email15@upm.es   false
16:            username2                  email2@upm.es   false
17:            username3                  email3@upm.es    true
19:            username4                  email4@upm.es   false
20:            username5                  email5@upm.es   false
32:           username25                 email25@upm.es    true

Total: 6 users.

> php list_users.php --json

[
    {
        "id": 15,
        "username": "username15",
        "email": "email15@upm.es",
        "enabled": false,
        "admin": false
    },
    {
        "id": 16,
        "username": "username2",
        "email": "email2@upm.es",
        "enabled": false,
        "admin": false
    },
    {
        "id": 17,
        "username": "username3",
        "email": "email3@upm.es",
        "enabled": true,
        "admin": false
    },
    {
        "id": 19,
        "username": "username4",
        "email": "email4@upm.es",
        "enabled": false,
        "admin": false
    },
    {
        "id": 20,
        "username": "username5",
        "email": "email5@upm.es",
        "enabled": false,
        "admin": false
    },
    {
        "id": 32,
        "username": "username25",
        "email": "email25@upm.es",
        "enabled": true,
        "admin": false
    }
]


### delete_user

> php delete_user.php

Usage: delete_user.php <userId> [--json]

> php delete_user.php -32

No existe Usuario con id: -32

> php delete_user.php 32

Borrado Usuario:
id: , username: username25, email: email25@upm.es, enabled: true, isAdmin: false

> php delete_user.php 20 --json

Borrado Usuario:
{
    "id": null,
    "username": "username5",
    "email": "email5@upm.es",
    "enabled": false,
    "admin": false
}





### create_result

> php create_result.php 0

Usage: create_result.php <result> <userId> [<dateTime (YYYY-MM-DDTHH:mm:ss)>] [--json]

> php create_result.php 1 -99

Usuario -99 no encontrado

> php create_result.php 2 16

Creado Resultado:
id:   7 result:   2 time: 2018-12-13 01:19:40 user: [id: 16, username: username2, email: email2@upm.es, enabled: false, isAdmin: false]

> php create_result.php 2 15 2017xxyyzz

Formato del parametro <dateTime> inesperado: DateTime::__construct(): Failed to parse time string (2017xxyyzz) at position 4 (x): The timezone could not be found in the database

> php create_result.php 10 15 2017-12-12T23:59

Creado Resultado:
id:   6 result:  10 time: 2017-12-12 23:59:00 user: [id: 15, username: username15, email: email15@upm.es, enabled: false, isAdmin: false]

> php create_result.php 10 16 2017-12-12T23:59 --json

Creado Resultado:
{
    "id": 8,
    "result": 10,
    "time": "2017-12-12 23:59:00",
    "user": {
        "id": 16,
        "username": "username2",
        "email": "email2@upm.es",
        "enabled": false,
        "admin": false
    }
}



### update_result

> php update_result.php

Usage: update_result.php <resultId> <result> [<dateTime (YYYY-MM-DDTHH:mm:ss)>] [--json]

> php update_result.php -99 10

No existe Resultado con id: -99

> php update_result.php  7 10

Actualizado Resultado:
id:   7 result:  10 time: 2018-12-13 01:39:13 user: [id: 16, username: username2, email: email2@upm.es, enabled: false, isAdmin: false]

> php update_result.php 8 2 2018-12-13T01:40 --json

Actualizado Resultado:
{
    "id": 8,
    "result": 2,
    "time": "2018-12-13 01:40:00",
    "user": {
        "id": 16,
        "username": "username2",
        "email": "email2@upm.es",
        "enabled": false,
        "admin": false
    }
}

> php update_result.php 8 2 12-13-2018T01:40 --json

Formato del parametro <dateTime> inesperado: DateTime::__construct(): Failed to parse time string (12-13-2018T01:40) at position 0 (1): Unexpected character


### read_result

> php read_result.php

Usage: read_result.php <resultId> [--json]

> php read_result.php -99 --json

No existe Resultado con id: -99

> php read_result.php 6

Resultado:
id:   6 result:  10 time: 2017-12-12 23:59:00 user: [id: 15, username: username15, email: email15@upm.es, enabled: false, isAdmin: false]

> php read_result.php 8 --json

Resultado:
{
    "id": 8,
    "result": 2,
    "time": "2018-12-13 01:40:00",
    "user": {
        "id": 16,
        "username": "username2",
        "email": "email2@upm.es",
        "enabled": false,
        "admin": false
    }
}

### list_results

> php list_results.php

 Id - res - time -               username
  1 -  10 - 2017-12-12 23:59:00 - username15
  2 -  10 - 2018-12-13 01:01:54 - username15
  3 -  10 - 2017-12-12 23:59:00 - username15
  4 -  10 - 2017-12-12 23:59:00 - username15
  5 -  10 - 2017-12-12 23:59:00 - username15
  6 -  10 - 2017-12-12 23:59:00 - username15
  7 -  10 - 2018-12-13 01:39:13 - username2
  8 -   2 - 2018-12-13 01:40:00 - username2


> php list_results.php --json

[
    {
        "id": 1,
        "result": 10,
        "time": "2017-12-12 23:59:00",
        "user": {
            "id": 15,
            "username": "username15",
            "email": "email15@upm.es",
            "enabled": false,
            "admin": false
        }
    },
    {
        "id": 2,
        "result": 10,
        "time": "2018-12-13 01:01:54",
        "user": {
            "id": 15,
            "username": "username15",
            "email": "email15@upm.es",
            "enabled": false,
            "admin": false
        }
    },
    {
        "id": 3,
        "result": 10,
        "time": "2017-12-12 23:59:00",
        "user": {
            "id": 15,
            "username": "username15",
            "email": "email15@upm.es",
            "enabled": false,
            "admin": false
        }
    },
    {
        "id": 4,
        "result": 10,
        "time": "2017-12-12 23:59:00",
        "user": {
            "id": 15,
            "username": "username15",
            "email": "email15@upm.es",
            "enabled": false,
            "admin": false
        }
    },
    {
        "id": 5,
        "result": 10,
        "time": "2017-12-12 23:59:00",
        "user": {
            "id": 15,
            "username": "username15",
            "email": "email15@upm.es",
            "enabled": false,
            "admin": false
        }
    },
    {
        "id": 6,
        "result": 10,
        "time": "2017-12-12 23:59:00",
        "user": {
            "id": 15,
            "username": "username15",
            "email": "email15@upm.es",
            "enabled": false,
            "admin": false
        }
    },
    {
        "id": 7,
        "result": 10,
        "time": "2018-12-13 01:39:13",
        "user": {
            "id": 16,
            "username": "username2",
            "email": "email2@upm.es",
            "enabled": false,
            "admin": false
        }
    },
    {
        "id": 8,
        "result": 2,
        "time": "2018-12-13 01:40:00",
        "user": {
            "id": 16,
            "username": "username2",
            "email": "email2@upm.es",
            "enabled": false,
            "admin": false
        }
    }
]



### delete_result

> php delete_result.php

Usage: delete_result.php <resultId> [--json]

> php delete_result.php --99

No existe Resultado con id: 0

> php delete_result.php 4

Borrado Resultado:
id:   0 result:  10 time: 2017-12-12 23:59:00 user: [id: 15, username: username15, email: email15@upm.es, enabled: false, isAdmin: false]

> php delete_result.php 5 --json

Borrado Resultado:
{
    "id": null,
    "result": 10,
    "time": "2017-12-12 23:59:00",
    "user": {
        "id": 15,
        "username": "username15",
        "email": "email15@upm.es",
        "enabled": false,
        "admin": false
    }
}











