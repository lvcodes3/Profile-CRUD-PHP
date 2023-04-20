-- create db
CREATE DATABASE profile_crud_php
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;

-- create table
CREATE TABLE users (
    pkey SERIAL NOT NULL PRIMARY KEY,
    email VARCHAR(320) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    color VARCHAR(10) NOT NULL
);
