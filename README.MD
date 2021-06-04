# bikepark.rabenspass.de SIGNUP System
[![GitHub license](https://img.shields.io/github/license/rabenspass/bikepark-signup)](https://github.com/rabenspass/bikepark-signup/blob/main/LICENSE)
[![GitHub forks](https://img.shields.io/github/forks/rabenspass/bikepark-signup)](https://github.com/rabenspass/bikepark-signup/network)
[![GitHub issues](https://img.shields.io/github/issues/rabenspass/bikepark-signup)](https://github.com/rabenspass/bikepark-signup/issues)


Whitelist Management for Rabenspass Bikepark

## Setup:

### Dependencies:
- webserver (tested with nginx)
- php 8.0
- mariad


1. Clone this repo
2. Create a database
3. Create a user and grant access to database
4. Change "db.inc.php"
5. Have fun!

## Features:

- Whitelist management
- User management
- Block User
- Allow User
- Self activation
- Admin Rights

### Needs implementation:

- Add API for AMP Server
- More Frontend
- More Game Integration



### Thanks for flying penguin stack overflow stealing! <3

### Database Setup:

`````
# mysql -u root -p
```````
in the mysql shell do the following:

``````
CREATE DATABASE usertable;
CREATE USER 'usertable'@'localhost' IDENTIFIED WITH mysql_native_password BY 'password';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, INDEX, DROP, ALTER, CREATE TEMPORARY TABLES, LOCK TABLES ON usertable.* TO 'usertable'@'localhost';
FLUSH PRIVILEGES;
exit
``````
Test if you were successfull with:
`````
# mysql -u usertable -p
```````
Import the empty database like this:
`````
# mysql -u usertable --password=password usertable < usertable.sql
```````
