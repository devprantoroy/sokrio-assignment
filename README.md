# Sokrio Assignment.
Developed this project using Laravel and MySQL.

## Table of Contents

- [Prerequisites](#prerequisites)
- [Getting Started](#getting-started)
- [Configuration](#configuration)
- [Development](#development)
- [License](#license)
- [Postman Collection](#postman-collection)

## Prerequisites

Before you begin, ensure you have met the following requirements:

- PHP >= 8.0 installed
- Composer installed ([Install Composer](https://getcomposer.org/download/))
- MySQL or another supported database server

## Getting Started

Follow these steps to get your project up and running:

1. Clone this repository:
   ```bash
   git clone https://github.com/devprantoroy/sokrio-assignment.git
2. Change into the project directory:
   ```bash
   cd sokrio-assignment
3. Install PHP dependencies:
   ```bash
   composer install
4. Create a copy of the .env.example file and rename it to .env. Update the .env file with your database credentials and other environment-specific settings:
   ```bash
   cp .env.example .env
5. Generate an application key:
   ```bash
   php artisan key:generate
6. Run database migrations
   ```bash
   php artisan migrate     
## Configuration
Configure your database settings in the .env file.
## Development
1. Start the development server:
   ```bash
   php artisan serve
## Postman Collection

We provide a Postman collection to simplify API testing. You can access and download the collection from the following link:

[Postman Collection](https://api.postman.com/collections/16831177-98c71e55-4c17-49b9-99f8-a55c02d92ba6?access_key=PMAT-01HAVDC39HZ0T7QRQY01Z2Y3XN)

### Instructions

1. Click on the "Postman Collection" link above to open it in Postman.
2. Click the "Run in Postman" button to import the collection into your Postman workspace.
3. You may need to adjust environment variables or configurations within Postman to match your local setup or target environment.
4. Start testing your API endpoints using the imported collection.

### Other Way
We provide Postman collections to simplify API testing. Follow these steps to use the collections:

1. Navigate to the `postman` folder in your project:
   ```bash
   cd sokrio-assignment/postman
2. There named `Sokrio.postman_collection.json` and `Sokrio.postman_environment.json`
4. Import these JSON to your POSTMAN.
4. Start testing your API endpoints using the imported collection.

## License
This project is licensed under the MIT License - see the LICENSE file for details.