# create databases
CREATE DATABASE IF NOT EXISTS `sgc`;

# create local_developer user and grant rights
CREATE USER 'ogcuunasam'@'db' IDENTIFIED BY 'ogcuUserMysql2022';
GRANT ALL PRIVILEGES ON *.* TO 'ogcuunasam'@'%';

