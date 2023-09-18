# moviedatabase

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

This is an application designed to access the OMDb Database using its provided API.
This application has two branches: One with the API-request in the client and one with the API-request on the server.

## Accessing the app online

A hosted production version is available at https://hedman.de/movie-database/

## Setting up locally for development

<!-- Create a `.env` file in the root directory with contents similar to the `.env.example` files.-->

> **Note**: If you clone the repo and run it on xampp or MAMP locally, you can start with the index.html in the root folder to take you to the client- or server-version.

Run the `Setup-SQL.sql` on your database. Make sure, that you create your own database first, before running the SQL-Script, that creates the tables `users` and `mymovies` on your local MySQL-Server.

The app will be available most likely at http://localhost:8888

## MIT License

Project: Copyright (c) 2023 Johan Hedman

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
