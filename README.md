
# Microservices Architecture for Logging and Authentication

## Overview

This project is a microservices-based architecture that consists of two main services:

1. **Login Service**: Handles user authentication and communicates with the Log Service to fetch recent login logs.
2. **Log Service**: Stores and retrieves logs related to various services.

These services are built with Laravel and Docker, with RabbitMQ facilitating communication between them. Each service is isolated within its own Docker network and has access to its own database.

## Table of Contents

- [Microservices Architecture for Logging and Authentication](#microservices-architecture-for-logging-and-authentication)
  - [Overview](#overview)
  - [Table of Contents](#table-of-contents)
  - [Architecture](#architecture)
  - [Technologies Used](#technologies-used)
  - [Services](#services)
    - [Login Service](#login-service)
    - [Log Service](#log-service)
  - [Installation and Setup](#installation-and-setup)
    - [Prerequisites](#prerequisites)
    - [Steps](#steps)
  - [Running the Services](#running-the-services)
  - [Environment Variables](#environment-variables)
    - [Login Service](#login-service-1)
    - [Log Service](#log-service-1)
  - [API Documentation](#api-documentation)
  - [Troubleshooting](#troubleshooting)
  - [Contributing](#contributing)
  - [License](#license)

## Architecture

- **Login Service**: Handles user authentication and retrieves logs related to user actions.
- **Log Service**: Collects and stores logs for various microservices. It provides APIs to query logs based on service names and filters.
- **RabbitMQ**: Facilitates asynchronous communication between services.
- **MySQL**: Each service has its own MySQL database, ensuring data isolation.

## Technologies Used

- **Laravel**: PHP framework used for building both services.
- **Docker**: Containerization of services for easy deployment and management.
- **RabbitMQ**: Message broker used for asynchronous communication.
- **MySQL**: Relational database for persistent data storage.
- **Postman**: For API documentation and testing.

## Services

### Login Service

- **URL**: `http://localhost:8000`
- **Responsibilities**:
  - User authentication.
  - Fetching recent login logs from the Log Service.
  
- **Key Endpoints**:
  - `POST /api/login`: Authenticate a user.
  - `GET /api/logs`: Retrieve recent login logs (requires authentication).

### Log Service

- **Responsibilities**:
  - Storing and retrieving logs for various services.
  - Providing filtered log data based on service name, identifier, type, etc.
  
- **Key Endpoints**:
  - `GET /api/logs`: Retrieve logs based on filters.

## Installation and Setup

### Prerequisites

- **Docker**: Ensure Docker is installed on your system.
- **Docker Compose**: Make sure Docker Compose is available.

### Steps

1. **Clone the Repository**:

    ```bash
    git clone https://github.com/winkersco/laravel-microservices
    cd https://github.com/winkersco/laravel-microservices
    ```

2. **Build and Start the Services**:

    ```bash
    docker-compose up --build -d
    ```

3. **Run Migrations**:

    Run the following commands inside the `login-service` and `log-service` containers to set up the databases:

    ```bash
    docker exec -it login-service php artisan migrate
    docker exec -it log-service php artisan migrate
    ```

4. **(Optional) Seed the Database**:

    ```bash
    docker exec -it login-service php artisan db:seed
    ```

## Running the Services

- **Login Service**: Accessible at `http://localhost:8000`
- **Log Service**: Is not accessible by public

Both services are running inside Docker containers, and you can interact with them using the provided endpoints.

## Environment Variables

Each service has its own `.env` file. The most critical variables are:

### Login Service

```env
DB_CONNECTION=mysql
DB_HOST=login-db
DB_PORT=3306
DB_DATABASE=login_db
DB_USERNAME=login
DB_PASSWORD=secret

RABBITMQ_HOST=rabbitmq
RABBITMQ_PORT=5672
```

### Log Service

```env
DB_CONNECTION=mysql
DB_HOST=log-db
DB_PORT=3306
DB_DATABASE=log_db
DB_USERNAME=log
DB_PASSWORD=secret 

RABBITMQ_HOST=rabbitmq
RABBITMQ_PORT=5672
```

## API Documentation

Detailed API documentation is available via Postman. You can view the documentation at the following link:

[View API Documentation](https://documenter.getpostman.com/view/37527411/2sA3s7i8Pv)

You can also download the Postman collection directly from the repository:

[Download Postman Collection](docs/Login.postman_collection.json)

This documentation includes all available endpoints, request/response examples, and necessary authentication details. The Postman collection provides a comprehensive guide to interacting with the APIs for both the Login Service and the Log Service, including examples for authentication, logging actions, and querying logs.

## Troubleshooting

- **Database Connection Issues**: Ensure that each service's `.env` file points to the correct database container.
- **RabbitMQ Communication Issues**: Ensure that both services are connected to the `microservices` network and that RabbitMQ is running.

## Contributing

Contributions are welcome! Please fork the repository and submit a pull request.

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.

