-- Setup for development machine
-- Create pizzadb, or recreate it
-- Create a user for it
drop database if exists pizzadb; -- only for your server
create database pizzadb; -- only for your own server

GRANT SELECT, INSERT, DELETE, UPDATE
ON pratsdb.*
TO root@localhost
IDENTIFIED BY 'root';
